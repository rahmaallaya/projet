@extends('layouts.app')

@section('content')
<div class="container mt-5">
<h1 class="text-center mb-4 pt-5">{{ $category->name_categorie }}</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($category->image)
                <img src="{{ asset('images/' . $category->image) }}" 
                     alt="{{ $category->name_categorie }}" 
                     class="card-img-top img-fluid mx-auto d-block"
                     style="max-width: 300px;">
                @endif
                
                <div class="card-body">
                    <p class="card-text"><strong>Description:</strong> {{ $category->description ?? 'Aucune description' }}</p>
                    <p class="card-text"><strong>Type:</strong> Corporate</p>
                    
                    <h4 class="mt-4">Prestataires</h4>
                    @if($prestataires->isEmpty())
                        <p class="text-muted">Aucun prestataire dans cette catégorie</p>
                    @else
                        @foreach($prestataires as $prestataire)
                            <div class="card-text">
                                {{ $prestataire->name }} - {{ $prestataire->email }}
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('services.corporate.list') }}" class="btn btn-secondary">Retour</a>
                        <a href="{{ route('services.corporate.list') }}" class="btn btn-primary">Liste des Corporates</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>