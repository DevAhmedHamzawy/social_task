@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4>Create Post</h4>

                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">
                        <textarea name="content" class="form-control" rows="4" placeholder="What's on your mind?" required></textarea>
                    </div>

                    <div class="mb-3">
                        <input type="file" name="image" class="form-control">
                    </div>

                    <button class="btn btn-primary">
                        Post
                    </button>

                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </form>

            </div>
        </div>
    </div>
@endsection
