@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4>Edit Post</h4>

                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <textarea name="content" class="form-control" rows="4" required>{{ $post->content }}</textarea>
                    </div>

                    @if ($post->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded">
                        </div>
                    @endif

                    <div class="mb-3">
                        <input type="file" name="image" class="form-control">
                    </div>

                    <button class="btn btn-primary">
                        Update
                    </button>

                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </form>

            </div>
        </div>
    </div>
@endsection
