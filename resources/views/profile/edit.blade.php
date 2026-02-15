@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">Edit Profile</div>

                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Image --}}
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Profile Image</label>

                                <div class="col-md-6">
                                    @if (auth()->user()->profile->image)
                                        <img src="{{ asset('storage/' . auth()->user()->profile->image) }}"
                                            class="mb-2 rounded-circle" width="100">
                                    @endif

                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image">

                                    @error('image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Name --}}
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', auth()->user()->name) }}" required>

                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', auth()->user()->email) }}" required>

                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- bio --}}
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">bio</label>

                                <div class="col-md-6">
                                    <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="4">{{ old('bio', auth()->user()->profile->bio) }}</textarea>

                                    @error('bio')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Button --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Profile
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
