@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="mb-4">
                    <span class="badge bg-light text-brand border px-3 py-2 rounded-pill mb-3 fw-bold">
                        <i class="bi bi-stars me-1"></i> Beta Release
                    </span>
                </div>
                <h1 class="display-3 text-dark mb-4" style="line-height: 1.1;">
                    Connect without the <br> <span class="text-brand">noise.</span>
                </h1>
                <p class="lead text-muted mb-5 mx-auto fs-5" style="max-width: 550px;">
                    Pamitweet brings you back to what matters: authentic conversations, zero clutter, and a community built on connection.
                </p>
                
                <div class="d-flex justify-content-center">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3">Join Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection