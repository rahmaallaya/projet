@extends('layouts.app')
@section('title', 'Provider Details')
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Provider Details</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $prestataire->name }}</p>
            <p><strong>Email:</strong> {{ $prestataire->email }}</p>
            <p><strong>Role:</strong> {{ $prestataire->role }}</p>
            <p><strong>Description:</strong> {{ $prestataire->description }}</p>
            @if ($prestataire->image)
                <p><strong>Image:</strong></p>
                <img src="{{ asset('images/' . $prestataire->image) }}" alt="Image" style="max-width: 300px;">
            @endif
            <form method="POST" action="{{ route('approvals.approve', $prestataire->id) }}">
                @csrf
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" data-type="{{ $category->type }}" {{ $prestataire->id_categorie == $category->id ? 'selected' : '' }}>
                                {{ $category->name_categorie }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-between align-items-center " style="background-color: rgba(var(--bs-body-color-rgb), 0.03);">
    <div class="d-flex gap-3">
        <button type="submit" class="btn btn-success">Approve</button>
        <a href="{{ route('approvals.index') }}" class="btn btn-secondary">Back</a>
    </div>
    <div> 
        <a href="{{ route('category.create') }}" class="btn btn-primary">Create New Category</a>
    </div>
</div>
               
            </form>
        </div>
    </div>
</div>

<script>
    // Filter categories based on the prestataire's role
    document.addEventListener('DOMContentLoaded', function () {
        const role = "{{ $prestataire->role }}"; // Get the prestataire's role
        const categorySelect = document.getElementById('category');
        const options = categorySelect.options;

        for (let i = 0; i < options.length; i++) {
            const optionType = options[i].getAttribute('data-type');
            if (optionType) {
                options[i].style.display =
                    (role === 'individu' && optionType === 'individu') ||
                    (role === 'entreprise' && optionType === 'entreprise')
                    ? 'block'
                    : 'none';
            } else {
                options[i].style.display = 'block'; // Show "Select a category"
            }
        }
    });
</script>

@endsection