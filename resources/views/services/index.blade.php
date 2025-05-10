@extends('layouts.app')

@section('title', 'Услуги')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-5">Наши услуги</h1>
        
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-md-6 col-lg-4">
                    <div class="card service-card h-100">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->title }}">
                        @else
                            <img src="https://via.placeholder.com/350x200?text=Service" class="card-img-top" alt="{{ $service->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($service->description, 150) }}</p>
                            <p class="text-primary fw-bold">{{ number_format($service->price, 0, ',', ' ') }} ₽</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <a href="{{ route('services.show', $service->id) }}" class="btn btn-primary">Подробнее</a>
                            <a href="{{ route('requests.create', $service->id) }}" class="btn btn-accent">Оставить заявку</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if(count($services) == 0)
            <div class="alert alert-info text-center">
                <p class="mb-0">В настоящее время услуги не доступны. Пожалуйста, проверьте позже.</p>
            </div>
        @endif
    </div>
@endsection