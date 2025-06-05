@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1 class="text-white text-center mb-4">
            REACH YOUR LIMITS<br>
            AND GET TO THE<br>
            NEXT LEVEL
        </h1>
        <p class="text-white text-center mb-5">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.
        </p>
        <div class="text-center">
            <a href="/learn-more" class="btn btn-outline-light me-3">LEARN MORE</a>
            <a href="/join-now" class="btn btn-warning">JOIN NOW</a>
        </div>
    </div>
    <div class="hero-slider">
        <div class="slider-dots">
            <span class="dot active">01</span>
            <span class="dot">02</span>
            <span class="dot">03</span>
            <span class="dot">04</span>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-dumbbell fa-3x mb-3"></i>
                    <h3>Modern Equipment</h3>
                    <p>State-of-the-art fitness equipment for optimal training results.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h3>Expert Trainers</h3>
                    <p>Professional trainers to guide you through your fitness journey.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                    <h3>Flexible Schedule</h3>
                    <p>Wide range of class schedules to fit your busy lifestyle.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 