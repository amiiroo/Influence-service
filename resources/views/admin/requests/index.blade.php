@extends('layouts.admin')

@section('title', 'Управление заявками')

@section('header', 'Управление заявками')

@section('content')
    <div class="card">
        <div class="card-body">
            @if(count($requests) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Услуга</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Телефон</th>
                                <th>Статус</th>
                                <th>Дата создания</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->service->title }}</td>
                                    <td>{{ $request->name }}</td>
                                    <td>{{ $request->email }}</td>
                                    <td>{{ $request->phone ?? '—' }}</td>
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
                                            <i class="fas fa-eye"></i> Просмотр
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <p>Заявок пока нет.</p>
                </div>
            @endif
        </div>
    </div>
@endsection