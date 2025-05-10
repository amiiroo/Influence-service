@extends('layouts.admin')

@section('title', 'Панель управления')

@section('header', 'Панель управления')

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-0">Услуги</h6>
                            <h3 class="mb-0">{{ $services_count }}</h3>
                        </div>
                        <div class="bg-light p-3 rounded">
                            <i class="fas fa-briefcase text-primary"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.services') }}" class="btn btn-sm btn-outline-primary mt-3">Просмотреть</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-0">Новые заявки</h6>
                            <h3 class="mb-0">{{ $requests_count }}</h3>
                        </div>
                        <div class="bg-light p-3 rounded">
                            <i class="fas fa-file-alt text-primary"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.requests') }}" class="btn btn-sm btn-outline-primary mt-3">Просмотреть</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Последние заявки</h5>
                </div>
                <div class="card-body">
                    @php
                        $latest_requests = \App\Models\Request::with('service')->orderBy('created_at', 'desc')->limit(5)->get();
                    @endphp
                    
                    @if(count($latest_requests) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Услуга</th>
                                        <th>Имя</th>
                                        <th>Email</th>
                                        <th>Статус</th>
                                        <th>Дата</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latest_requests as $request)
                                        <tr>
                                            <td>{{ $request->id }}</td>
                                            <td>{{ $request->service->title }}</td>
                                            <td>{{ $request->name }}</td>
                                            <td>{{ $request->email }}</td>
                                            <td>
                                                @if($request->status == 'new')
                                                    <span class="badge bg-info">Новая</span>
                                                @elseif($request->status == 'processing')
                                                    <span class="badge bg-warning">В обработке</span>
                                                @elseif($request->status == 'completed')
                                                    <span class="badge bg-success">Завершена</span>
                                                @elseif($request->status == 'rejected')
                                                    <span class="badge bg-danger">Отклонена</span>
                                                @endif
                                            </td>
                                            <td>{{ $request->created_at->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.requests.show', $request->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">Заявок пока нет.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection