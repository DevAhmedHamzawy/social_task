@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Users List</div>

            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($user->profile?->image)
                                        <img src="{{ asset('storage/' . $user->profile->image) }}" width="50"
                                            class="rounded-circle">
                                    @else
                                        <img src="https://via.placeholder.com/50" class="rounded-circle">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary">
                                        View
                                    </a>

                                    @if (auth()->id() != $user->id)
                                        @if (auth()->user()->friends->contains($user->id))
                                            <button class="btn btn-success btn-sm" disabled>Friend</button>
                                        @elseif(auth()->user()->sentFriendRequests->contains('receiver_id', $user->id))
                                            <button class="btn btn-warning btn-sm" disabled>Pending</button>
                                        @else
                                            <form method="POST" action="{{ route('friend.send', $user->id) }}"
                                                class="d-inline">
                                                @csrf
                                                <button class="btn btn-outline-success btn-sm">Add Friend</button>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No Users Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
