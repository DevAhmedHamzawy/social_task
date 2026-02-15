@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-body">

                @if ($user->profile?->image)
                    <img src="{{ asset('storage/' . $user->profile->image) }}" width="120" class="rounded-circle mb-3">
                @else
                    <img src="https://via.placeholder.com/120" class="rounded-circle mb-3">
                @endif

                <h3>{{ $user->name }}</h3>
                <p class="text-muted">{{ $user->email }}</p>

                <hr>

                <h5>Bio</h5>
                <p>
                    {{ $user->profile?->bio ?? 'No bio available' }}
                </p>

                <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">
                    Back
                </a>

            </div>
        </div>
    </div>
@endsection
