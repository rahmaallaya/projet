@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Edit Profile</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name', $user->name ?? $prestataire->name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="{{ old('email', $user->email ?? $prestataire->email ?? '') }}" required>
                </div>

                @if(auth()->user()->isProvider())
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $prestataire->description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Profile Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($prestataire->image ?? false)
                        <div class="mt-2">
                            <img src="{{ asset('images/'.$prestataire->image) }}" 
                                 alt="Current Image" 
                                 class="img-thumbnail" 
                                 style="max-width: 200px;">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image">
                                <label class="form-check-label" for="remove_image">
                                    Remove current image
                                </label>
                            </div>
                        </div>
                    @endif
                </div>
                @endif

                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small class="text-muted">Leave blank to keep current password</small>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection