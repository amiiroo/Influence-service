@extends('layouts.app')

@section('title', $service->title)

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Услуги</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
            </ol>
        </nav>
        
        <div class="row mt-4">
            <div class="col-lg-5 mb-4 mb-lg-0">
                @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid rounded" alt="{{ $service->title }}">
                @else
                    <img src="https://via.placeholder.com/600x400?text=Service" class="img-fluid rounded" alt="{{ $service->title }}">
                @endif
            </div>
            
            <div class="col-lg-7">
                <h1>{{ $service->title }}</h1>
                
                <div class="mb-4 mt-3">
                    <h4 class="text-primary">{{ number_format($service->price, 0, ',', ' ') }} ₽</h4>
                </div>
                
                <div class="mb-4">
                    <h5>Описание</h5>
                    <p>{!! nl2br(e($service->description)) !!}</p>
                </div>
                
                <a href="{{ route('requests.create', $service->id) }}" class="btn btn-primary btn-lg">Оставить заявку</a>
                <a href="{{ route('services.index') }}" class="btn btn-outline-secondary">Назад к услугам</a>
            </div>
        </div>
    </div>
@endsection