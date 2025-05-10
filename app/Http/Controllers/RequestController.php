<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Request as ServiceRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function create($service_id)
    {
        $service = Service::findOrFail($service_id);
        return view('requests.create', compact('service'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
            'service_id' => 'required|exists:services,id',
        ]);
        
        ServiceRequest::create($validated);
        
        return redirect()->route('home')->with('success', 'Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.');
    }
}