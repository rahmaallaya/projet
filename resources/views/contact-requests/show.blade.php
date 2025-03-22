@extends('layouts.app')
@section('title', 'Contact Request Details')
@section('content')
<div class="container mt-5">
    <div class="contact-card">
        <h3>Contact Request Details</h3>
        <p><strong>Name:</strong> {{ $request->name }}</p>
        <p><strong>Email:</strong> {{ $request->email }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $request->message }}</p>
        <p><strong>Sent At:</strong> {{ $request->created_at->format('d M Y, H:i') }}</p>
        
        <!-- Boutons d'action -->
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('contact-requests.index') }}" class="btn btn-secondary">Back</a>
            
            @if(session('type') === 'super_admin')
                <!-- Bouton Response -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#responseModal{{ $request->id }}">
                    <i class="bi bi-reply"></i> Response
                </button>

                <!-- Bouton Delete -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $request->id }}">
                    <i class="bi bi-trash"></i> Delete
                </button>
            @endif
        </div>
    </div>
</div>

@if(session('type') === 'super_admin')
    <!-- Modale de réponse -->
    <div class="modal fade" id="responseModal{{ $request->id }}" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="responseModalLabel">Respond to {{ $request->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('contact-requests.response', $request->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="responseMessage" class="form-label">Your Response</label>
                            <textarea class="form-control" id="responseMessage" name="message" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Send Response</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modale de suppression -->
    <div class="modal fade" id="deleteModal{{ $request->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this request from <strong>{{ $request->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('contact-requests.destroy', $request->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection