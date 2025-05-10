@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold">Продвигайте свой бизнес с помощью инфлюенсеров</h1>
                    <p class="lead mb-4">Найдите идеальных инфлюенсеров для вашего бренда. Мы предлагаем проверенных специалистов для эффективного маркетинга в социальных сетях.</p>
                    <a href="{{ route('services.index') }}" class="btn btn-light btn-lg px-4 me-2">Наши услуги</a>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('storage/services/influencer.jpeg') }}" alt="Influencer Marketing" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="container py-5">
        <h2 class="text-center mb-5">Наши услуги</h2>
        
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
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($service->description, 100) }}</p>
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
        
        @if(count($services) > 6)
            <div class="text-center mt-4">
                <a href="{{ route('services.index') }}" class="btn btn-primary">Смотреть все услуги</a>
            </div>
        @endif
    </section>

    <!-- Benefits Section -->
    <section class="container py-5">
        <h2 class="text-center mb-5">Преимущества работы с нами</h2>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-check-circle text-primary fa-3x"></i>
                    </div>
                    <h5>Проверенные инфлюенсеры</h5>
                    <p>Мы тщательно отбираем каждого инфлюенсера для гарантии качества и эффективности контента.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-chart-line text-primary fa-3x"></i>
                    </div>
                    <h5>Измеримые результаты</h5>
                    <p>Получайте подробную статистику и аналитику по каждой рекламной кампании.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-hand-holding-usd text-primary fa-3x"></i>
                    </div>
                    <h5>Выгодные условия</h5>
                    <p>Прозрачное ценообразование и гибкие условия сотрудничества без скрытых платежей.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works Section -->
    <section class="container py-5">
        <h2 class="text-center mb-5">Как это работает?</h2>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card h-100 text-center p-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                <span class="h5 mb-0">1</span>
                            </div>
                            <h5>Выберите услугу</h5>
                            <p>Просмотрите наш каталог и выберите подходящую услугу</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card h-100 text-center p-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                <span class="h5 mb-0">2</span>
                            </div>
                            <h5>Оставьте заявку</h5>
                            <p>Заполните форму с описанием вашего проекта</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card h-100 text-center p-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                <span class="h5 mb-0">3</span>
                            </div>
                            <h5>Получите предложение</h5>
                            <p>Мы свяжемся с вами и предложим подходящих инфлюенсеров</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card h-100 text-center p-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                <span class="h5 mb-0">4</span>
                            </div>
                            <h5>Запустите кампанию</h5>
                            <p>Наслаждайтесь результатами успешной рекламной кампании</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('services.index') }}" class="btn btn-primary btn-lg">Начать сейчас</a>
        </div>
    </section>
@endsection



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