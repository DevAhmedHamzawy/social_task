@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Pending Friend Requests</h3>

        @foreach ($requests as $req)
            <div class="card mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <span>{{ $req->sender->name }}</span>
                    <div>
                        <form method="POST" action="{{ route('friend.accept', $req->id) }}" class="d-inline">@csrf
                            <button class="btn btn-success btn-sm">Accept</button>
                        </form>
                        <form method="POST" action="{{ route('friend.reject', $req->id) }}" class="d-inline">@csrf
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
