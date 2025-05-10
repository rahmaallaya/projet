@extends('layouts.app')
@section('title', 'Prestataires')
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Prestataires - {{ $category->name_categorie }}</h1>
    <div class="row">
    @foreach($prestataires as $prestataire)
<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <h5>{{ $prestataire->name }}</h5>
            <p>{{ $prestataire->description }}</p>
            <div class="d-flex gap-2">
                <!-- Bouton View -->
                <button class="btn btn-info btn-sm" data-bs-toggle="modal" 
                    data-bs-target="#viewModal{{ $prestataire->id }}">
                    View
                </button>
                
                <!-- Bouton Contacter -->
               
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                    data-bs-target="#contactModal{{ $prestataire->id }}">
                    Contacter
                </button>
               
                
            </div>
        </div>
    </div>
</div>

<!-- Modal Contact -->
<div class="modal fade" id="contactModal{{ $prestataire->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('requests.store', $prestataire) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Contacter {{ $prestataire->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nom complet</label>
                        <input type="text" class="form-control" 
       value="{{ auth()->user() ? auth()->user()->name : '' }}" 
       disabled>
                    </div>
                    <div class="mb-3">
                        <label>Description du problème *</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Ville *</label>
                        <input type="text" name="ville" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Gouvernorat *</label>
                        <input type="text" name="gouvernorat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Téléphone *</label>
                        <input type="text" name="telephone" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach
    </div>
</div>
@endsection