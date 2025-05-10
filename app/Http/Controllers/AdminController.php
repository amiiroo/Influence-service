<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Request as ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dashboard()
    {
        $services_count = Service::count();
        $requests_count = ServiceRequest::where('status', 'new')->count();
        return view('admin.dashboard', compact('services_count', 'requests_count'));
    }
    
    // Services
    public function services()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }
    
    public function createService()
    {
        return view('admin.services.create');
    }
    
    public function storeService(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $validated['image'] = $path;
        }
        
        Service::create($validated);
        
        return redirect()->route('admin.services')->with('success', 'Услуга успешно добавлена');
    }
    
    public function editService($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }
    
    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            
            $path = $request->file('image')->store('services', 'public');
            $validated['image'] = $path;
        }
        
        $service->update($validated);
        
        return redirect()->route('admin.services')->with('success', 'Услуга успешно обновлена');
    }
    
    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        
        // Delete image
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        
        $service->delete();
        
        return redirect()->route('admin.services')->with('success', 'Услуга успешно удалена');
    }
    
    // Requests
    public function requests()
    {
        $requests = ServiceRequest::with('service')->orderBy('created_at', 'desc')->get();
        return view('admin.requests.index', compact('requests'));
    }
    
    public function showRequest($id)
    {
        $request = ServiceRequest::with('service')->findOrFail($id);
        return view('admin.requests.show', compact('request'));
    }
    
    public function updateRequestStatus(Request $request, $id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:new,processing,completed,rejected',
        ]);
        
        $serviceRequest->update($validated);
        
        return redirect()->route('admin.requests')->with('success', 'Статус заявки обновлен');
    }
}