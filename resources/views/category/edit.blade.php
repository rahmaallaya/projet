@extends('layouts.app')
@section('title', 'Edit Category')
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit {{ $category->name_categorie }}</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name_categorie" class="form-label">Category Name</label>
                            <input type="text" class="form-control" 
                                   id="name_categorie" name="name_categorie" 
                                   value="{{ $category->name_categorie }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" 
                                      name="description" rows="4">{{ $category->description }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="entreprise" {{ $category->type === 'entreprise' ? 'selected' : '' }}>
                                    Corporate
                                </option>
                                <option value="individu" {{ $category->type === 'individu' ? 'selected' : '' }}>
                                    Individual
                                </option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" >
                            @if($category->image)
                                <div class="mt-2">
                                <img src="{{ asset('images/' . $category->image) }}"  alt="{{ $category->name_categorie }}" class="card-img-top img-fluid mx-auto d-block" style="max-width: 300px;">
                                    <small class="d-block mt-1 text-muted">Current image</small>
                                </div>
                            @endif
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection