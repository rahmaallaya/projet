@extends('layouts.app')
@section('title', 'Individual Services')
@section('content')
<div class="container mt-5">
<h1 class="text-center mb-4">Individual Services</h1>
    <a href="{{ route('category.create') }}"  class="btn btn-primary mb-3">Create a Category</a>
    
    <div class="card shadow">
        <div class="card-body p-0">
            @foreach($categories as $category)
                <div class="border-bottom">
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h5 class="mb-0">{{ $category->name_categorie }}</h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('services.show', $category->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('services.individual.list') }}" class="btn btn-primary btn-sm">List of Individual</a>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center p-3" style="background-color:rgb(236, 241, 246);">
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection