@extends('layouts.app')

@section('content')
<div class="container mt-5">
<h1 class="text-center mb-4">{{ $category->name_categorie }}</h1>

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
                    <p class="card-text"><strong>Description:</strong> {{ $category->description ?? 'No description' }}</p>
                    <p class="card-text"><strong>Type:</strong> Individual</p>
                    
                    <h4 class="mt-4">Providers</h4>
                    @if($prestataires->isEmpty())
                        <p class="text-muted">No providers in this category</p>
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
                        <a href="{{ route('services.individual.list') }}" class="btn btn-secondary">Back</a>
                        <a href="{{ route('services.individual.list') }}" class="btn btn-primary">List of Individual</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection