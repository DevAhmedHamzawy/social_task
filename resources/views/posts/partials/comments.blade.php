<hr>

@foreach ($post->comments as $comment)
    <div class="bg-light p-2 mb-2 rounded">
        <strong>{{ $comment->user->name }}</strong>
        <small class="text-muted">
            {{ $comment->created_at->diffForHumans() }}
        </small>
        <p class="mb-1">{{ $comment->content }}</p>

        @if (auth()->id() == $comment->user_id)
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">
                    Delete
                </button>
            </form>
        @endif
    </div>
@endforeach

<form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
    @csrf
    <input type="text" name="content" class="form-control" placeholder="Write a comment..." required>
</form>
