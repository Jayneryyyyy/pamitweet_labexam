@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0 split-screen">
        
        <div class="col-lg-6 split-left">
            <div style="max-width: 400px; margin: 0 auto; width: 100%;">
                <div class="mb-5">
                    <h2 class="fw-bold display-6">Create account</h2>
                    <p class="text-muted">Start your journey with Pamitweet today.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase text-muted">Full Name</label>
                        <input type="text" name="name" class="form-control form-control-lg" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase text-muted">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase text-muted">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase text-muted">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control form-control-lg" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 mb-3">Get Started</button>
                    
                    <div class="text-center">
                        <span class="text-muted">Already have an account?</span>
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-brand ms-1">Log in</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-6 split-right">
            <div class="text-center px-5">
                <i class="bi bi-people-fill display-1 mb-4" style="opacity: 0.8;"></i>
                <h2 class="display-5 fw-bold mb-3">Build your community.</h2>
                <p class="lead opacity-75">Safe, fast, and designed for you. See what everyone is talking about.</p>
            </div>
        </div>

    </div>
</div>
@endsection