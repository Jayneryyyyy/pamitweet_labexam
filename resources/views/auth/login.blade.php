@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0 split-screen">
        
        <div class="col-lg-6 split-left">
            <div style="max-width: 400px; margin: 0 auto; width: 100%;">
                <div class="mb-5">
                    <h2 class="fw-bold display-6">Welcome back</h2>
                    <p class="text-muted">Please enter your details to sign in.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase text-muted">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-lg" required autofocus>
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase text-muted">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label text-muted" for="remember_me">Remember for 30 days</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-decoration-none small fw-bold text-brand">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 mb-3">Sign in</button>
                    
                    <div class="text-center">
                        <span class="text-muted">Don't have an account?</span>
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-brand ms-1">Create account</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-6 split-right">
            <div class="text-center px-5">
                <i class="bi bi-chat-square-quote-fill display-1 mb-4" style="opacity: 0.8;"></i>
                <h2 class="display-5 fw-bold mb-3">"The social network that respects your time."</h2>
                <p class="lead opacity-75">Join thousands of users connecting authentically on Pamitweet.</p>
            </div>
        </div>

    </div>
</div>
@endsection