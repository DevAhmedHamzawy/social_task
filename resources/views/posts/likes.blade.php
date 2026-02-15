@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card shadow-sm">
            <div class="card-body">

                <h4 class="mb-3">
                    People who liked this post
                </h4>

                @forelse($post->likes as $like)
                    <div class="d-flex align-items-center mb-3">

                        @if ($like->user->profile && $like->user->profile->image)
                            <img src="{{ asset('storage/' . $like->user->profile->image) }}" width="40" height="40"
                                class="rounded-circle me-2">
                        @endif

                        <div>
                            <strong>{{ $like->user->name }}</strong>
                        </div>

                    </div>
                @empty
                    <p class="text-muted">No likes yet.</p>
                @endforelse

                <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">
                    Back
                </a>

            </div>
        </div>

    </div>
@endsection
