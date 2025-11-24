@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Edit Post</div>
                <div class="card-body">
                    <form action="{{ route('posts.update', $tweet->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <textarea name="content" class="form-control border-0 bg-light" rows="4" 
                                maxlength="280" required>{{ old('content', $tweet->content) }}</textarea>
                            @error('content')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
