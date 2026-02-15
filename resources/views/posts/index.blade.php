@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between mb-3">
            <h3>Posts</h3>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                Create Post
            </a>
        </div>

        @foreach ($posts as $post)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">

                    <div class="d-flex align-items-center mb-2">
                        @if ($post->user->profile && $post->user->profile->image)
                            <img src="{{ asset('storage/' . $post->user->profile->image) }}" width="40" height="40"
                                class="rounded-circle me-2">
                        @endif
                        <div>
                            <strong>{{ $post->user->name }}</strong><br>
                            <small class="text-muted">
                                {{ $post->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>

                    <p>{{ $post->content }}</p>

                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-2">
                    @endif

                    <div class="mb-2">
                        <a href="{{ route('posts.likes', $post->id) }}" class="text-decoration-none">
                            ❤️ {{ $post->likes->count() }}
                        </a>
                        💬 {{ $post->comments->count() }}
                    </div>

                    {{-- Like --}}
                    <form action="{{ route('posts.like', $post->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger">
                            Like
                        </button>
                    </form>

                    {{-- Edit/Delete --}}
                    @if (auth()->id() == $post->user_id)
                        <div class="mt-2">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif

                    {{-- Comments --}}
                    @include('posts.partials.comments')

                </div>
            </div>
        @endforeach

        {{ $posts->links() }}

    </div>
@endsection
