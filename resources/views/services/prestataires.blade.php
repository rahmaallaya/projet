@extends('layouts.app')

@section('title', 'Prestataires')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Prestataires - {{ $category->name_categorie }}</h1>
    
    <div class="row">
        @foreach($prestataires as $prestataire)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <img src="{{ asset('images/' . $prestataire->image) }}" 
                     class="card-img-top" 
                     alt="{{ $prestataire->name }}"
                     style="height: 200px; object-fit: cover;">
                
                <div class="card-body">
                    <h5 class="card-title">{{ $prestataire->name }}</h5>
                    <p class="card-text">{{ $prestataire->description }}</p>
                </div>
                
                <div class="card-footer bg-white">
                    @if(auth()->check() && auth()->user()->isUser())
                    <button class="btn btn-primary btn-sm w-100" 
                            data-bs-toggle="modal" 
                            data-bs-target="#requestModal{{ $prestataire->id }}">
                        <i class="fas fa-paper-plane"></i> Envoyer demande
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@if(auth()->check() && auth()->user()->isUser())
@foreach($prestataires as $prestataire)
<!-- Modal -->
<div class="modal fade" id="requestModal{{ $prestataire->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('requests.store', $prestataire) }}">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Demande à {{ $prestataire->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Votre demande</label>
                        <textarea class="form-control" name="description" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endif

@endsection