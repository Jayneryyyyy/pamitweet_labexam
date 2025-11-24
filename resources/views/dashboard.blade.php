@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-3 d-none d-md-block sidebar-profile">
            <div class="card text-center p-3">
                <div class="mb-2">
                    <div class="avatar avatar-md">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                </div>
                <h6 class="fw-bold mb-0">{{ Auth::user()->name }}</h6>
                <small class="text-muted">Joined {{ Auth::user()->created_at->format('M Y') }}</small>
            </div>
        </div>

        <div class="col-md-7 feed-container">
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px; font-size: 1.2rem; font-weight: bold;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </div>
                            
                            <div class="w-100">
                                <textarea 
                                    name="content" 
                                    id="tweet-content" 
                                    class="form-control border-0 bg-light mb-2" 
                                    rows="2" 
                                    placeholder="What's happening?" 
                                    maxlength="280" 
                                    required
                                    oninput="updateCounter(this)"></textarea>
                                
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="text-muted fw-bold" style="font-size: 0.85rem;">
                                        <span id="char-count" class="text-primary">0</span>/280
                                    </small>

                                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                                        Post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @foreach($posts as $post)
            <div class="card-tweet shadow-sm bg-white">
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <a href="{{ route('users.show', $post->user->id) }}" class="text-decoration-none flex-shrink-0">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px; font-size: 1.2rem; font-weight: bold;">
                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                            </div>
                        </a>

                        <div class="w-100">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex align-items-center flex-wrap">
                                    <a href="{{ route('users.show', $post->user->id) }}" class="fw-bold text-dark text-decoration-none fs-5 me-1">
                                        {{ $post->user->name }}
                                    </a>
                                    
                                    <small class="text-muted">&bull; {{ $post->created_at->diffForHumans() }}</small>
                                    
                                    @if(Auth::id() === $post->user_id)
                                        <span class="badge-author">You</span>
                                    @endif

                                    @if($post->created_at != $post->updated_at)
                                        <small class="text-muted fst-italic ms-2" style="font-size: 0.8rem;">(edited)</small>
                                    @endif
                                </div>
                                
                                @if(Auth::id() === $post->user_id)
                                    <div class="dropdown">
                                        <button class="btn btn-link text-muted p-1" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i> </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                            <li>
                                                <a class="dropdown-item py-2 fw-bold" href="{{ route('posts.edit', $post->id) }}">
                                                    <i class="bi bi-pencil-square me-2 text-primary"></i> Edit Post
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post? This cannot be undone.');">
                                                    @csrf @method('DELETE')
                                                    <button class="dropdown-item py-2 fw-bold text-danger">
                                                        <i class="bi bi-trash me-2"></i> Delete Post
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <p class="mt-2 mb-3 text-dark" style="font-size: 1.05rem; line-height: 1.6;">
                                {{ $post->content }}
                            </p>

                            <div class="d-flex align-items-center gap-4 border-top pt-3 mt-3">
                                <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn p-0 border-0 d-flex align-items-center gap-2 {{ $post->isLikedBy(Auth::user()) ? 'text-danger' : 'text-secondary' }}">
                                        <i class="bi {{ $post->isLikedBy(Auth::user()) ? 'bi-heart-fill' : 'bi-heart' }} fs-5"></i>
                                        <span class="fw-bold">{{ $post->likes->count() }}</span>
                                    </button>
                                </form>
                                
                                <button class="btn p-0 border-0 d-flex align-items-center gap-2 text-secondary">
                                    <i class="bi bi-chat fs-5"></i>
                                    <span class="fw-bold">0</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @if($posts->isEmpty())
                <div class="text-center py-5 text-muted">
                    <p>No posts yet. Be the first to share something!</p>
                </div>
            @endif

        </div>
    </div>
</div>
<script>
    function updateCounter(field) {
        const count = field.value.length;
        const counter = document.getElementById('char-count');
        counter.innerText = count;
        // Visual feedback if near limit
        if (count >= 260) {
            counter.classList.remove('text-primary');
            counter.classList.add('text-danger');
        } else {
            counter.classList.remove('text-danger');
            counter.classList.add('text-primary');
        }
    }
</script>
@endsection