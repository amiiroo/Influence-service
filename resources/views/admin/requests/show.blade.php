@extends('layouts.admin')

@section('title', 'Просмотр заявки')

@section('header', 'Просмотр заявки #' . $request->id)

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Информация о заявке</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 200px;">ID заявки:</th>
                                    <td>{{ $request->id }}</td>
                                </tr>
                                <tr>
                                    <th>Услуга:</th>
                                    <td>
                                        <a href="{{ route('services.show', $request->service->id) }}" target="_blank">
                                            {{ $request->service->title }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Статус:</th>
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
                                </tr>
                                <tr>
                                    <th>Дата создания:</th>
                                    <td>{{ $request->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Дата обновления:</th>
                                    <td>{{ $request->updated_at->format('d.m.Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Информация о клиенте</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 200px;">Имя:</th>
                                    <td>{{ $request->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>
                                        <a href="mailto:{{ $request->email }}">{{ $request->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Телефон:</th>
                                    <td>
                                        @if($request->phone)
                                            <a href="tel:{{ $request->phone }}">{{ $request->phone }}</a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Сообщение</h5>
                </div>
                <div class="card-body">
                    @if($request->message)
                        <p>{!! nl2br(e($request->message)) !!}</p>
                    @else
                        <p class="text-muted">Сообщение отсутствует.</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Изменить статус</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.requests.update.status', $request->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Статус</label>
                            <select class="form-select" id="status" name="status">
                                <option value="new" {{ $request->status == 'new' ? 'selected' : '' }}>Новая</option>
                                <option value="processing" {{ $request->status == 'processing' ? 'selected' : '' }}>В обработке</option>
                                <option value="completed" {{ $request->status == 'completed' ? 'selected' : '' }}>Завершена</option>
                                <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>Отклонена</option>
                            </select>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Действия</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="mailto:{{ $request->email }}?subject=Заявка №{{ $request->id }} на сайте {{ config('app.name') }}" class="btn btn-outline-primary">
                            <i class="fas fa-envelope"></i> Написать клиенту
                        </a>
                        @if($request->phone)
                            <a href="tel:{{ $request->phone }}" class="btn btn-outline-primary">
                                <i class="fas fa-phone"></i> Позвонить клиенту
                            </a>
                        @endif
                        <a href="{{ route('admin.requests') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Назад к списку
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection