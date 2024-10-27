@extends('layouts.main')

@section('title', 'Login - User Management System')

@section('content')
<section id="app" class="auth__container">
    <auth-component></auth-component>
</section>

<div class="bg__wave-login">
    <div 
        class="wave__login" 
        style="height: 100%; overflow: hidden;" 
        bis_skin_checked="1"
    >
        <svg 
            viewBox="0 0 500 150" 
            preserveAspectRatio="none" 
            style="height: 100%; width: 100%;"
        >
            <path 
                d="M-1.41,152.47 C123.87,7.42 253.67,288.66 500.27,-0.47 L499.72,-0.47 L0.00,0.00 Z" 
                style="stroke: none; fill: #F5F5F5;"
            >
            </path>
        </svg>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/base/form.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/login/login.css') }}" />
@endpush

@push('vite')
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
@endpush