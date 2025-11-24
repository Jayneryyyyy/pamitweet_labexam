<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Pamitweet') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
    
    <nav class="navbar navbar-expand-md navbar-light navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-brand fs-3 d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-chat-square-quote-fill me-2"></i> Pamitweet
            </a>
            
            <button class="navbar-toggler border-0 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    @auth
                        <li class="nav-item"><a class="nav-link fw-bold px-3" href="{{ route('dashboard') }}">Feed</a></li>
                        <li class="nav-item"><a class="nav-link fw-bold px-3" href="{{ route('users.show', Auth::id()) }}">Profile</a></li>
                        <li class="nav-item ms-md-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-primary text-white" href="{{ route('register') }}">Get Started</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1 bg-white pt-5">
        @yield('content')
    </main>

    <footer class="app-footer py-4 mt-auto">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <h5 class="fw-bold text-brand mb-1">Pamitweet</h5>
                    <p class="text-muted small mb-0">A fresh take on social connection.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-1 text-muted small">Designed & Developed by</p>
                    <a href="https://www.facebook.com/arjaypamittan.admin" target="_blank" class="text-decoration-none small fw-bold text-dark">
                        Arjay Pamittan <i class="bi bi-arrow-up-right small ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>