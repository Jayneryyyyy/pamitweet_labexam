@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            


            <div class="profile-header-card text-center bg-white">
                <div class="profile-cover"></div>
                
                <div class="position-relative d-flex justify-content-center">
                    <div class="profile-avatar-large">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>

                <div class="p-3 pt-2">
                    <h3 class="fw-bold mt-2 mb-1 text-dark">{{ $user->name }}</h3>
                    <p class="text-muted mb-3 small">
                        <i class="bi bi-calendar3 me-1"></i> Joined {{ $user->created_at->format('F Y') }}
                    </p>
                    
                    <div class="d-flex justify-content-center gap-5 border-top pt-3 mt-3">
                        <div class="text-center px-3">
                            <div class="stat-number">{{ $tweetCount }}</div>
                            <div class="stat-label">Posts</div>
                        </div>
                        <div class="text-center px-3">
                            <div class="stat-number">{{ $likesReceived }}</div>
                            <div class="stat-label">Likes</div>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="mb-4 ps-2 fw-bold text-secondary d-flex align-items-center">
                <i class="bi bi-clock-history me-2"></i> Recent Activity
            </h5>

            @foreach($posts as $post)
                <div class="card-tweet shadow-sm bg-white">
                    <div class="card-body">
                        <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px; font-size: 1.2rem; font-weight: bold;">
                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                </div>
                            </div>

                            <div class="w-100">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <span class="fw-bold text-dark fs-5">{{ $post->user->name }}</span>
                                        <small class="text-muted ms-2">&bull; {{ $post->created_at->diffForHumans() }}</small>
                                        
                                        @if($post->created_at != $post->updated_at)
                                            <small class="text-muted fst-italic ms-2" style="font-size: 0.8rem;">(edited)</small>
                                        @endif
                                    </div>

                                    @if(Auth::id() === $post->user_id)
                                        <div class="dropdown">
                                            <button class="btn btn-link text-muted p-1" data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if($posts->isEmpty())
                <div class="text-center py-5">
                    <div class="text-muted mb-3"><i class="bi bi-pencil-square display-1 opacity-25"></i></div>
                    <h5 class="text-muted fw-bold">No posts yet</h5>
                    <p class="text-muted">This user hasn't shared anything.</p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection