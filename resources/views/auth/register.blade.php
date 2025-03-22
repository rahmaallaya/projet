@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" onchange="toggleFields()">
                                <option value="">User</option>
                                <option value="individu">Individual</option>
                                <option value="entreprise">Corporate</option>
                            </select>
                        </div>
                        <div id="prestataire-fields" style="display: none;">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image/Icon</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category (required for prestataires)</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" data-type="{{ $category->type }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name_categorie }}
                                        </option>
                                    @endforeach
                                    <option value="NULL" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleFields() {
        const role = document.getElementById('role').value;
        const prestataireFields = document.getElementById('prestataire-fields');
        const categorySelect = document.getElementById('category');
        const options = categorySelect.options;

        // Afficher ou masquer les champs supplémentaires
        prestataireFields.style.display = role ? 'block' : 'none';

        // Filtrer les catégories en fonction du rôle sélectionné
        if (role) {
            for (let i = 0; i < options.length; i++) {
                const optionType = options[i].getAttribute('data-type');
                if (optionType) {
                    options[i].style.display =
                        (role === 'individu' && optionType === 'individu') ||
                        (role === 'entreprise' && optionType === 'entreprise')
                        ? 'block'
                        : 'none';
                } else {
                    options[i].style.display = 'block'; // Afficher "Select a category" et "Other"
                }
            }
        } else {
            // Réinitialiser la visibilité des options si aucun rôle n'est sélectionné
            for (let i = 0; i < options.length; i++) {
                options[i].style.display = 'block';
            }
        }
    }

    // Appeler toggleFields au chargement de la page pour initialiser l'état en fonction de la valeur précédente
    document.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endsection