@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" 
               class="form-control" 
               id="email" 
               name="email" 
               value="{{ old('email') }}" 
               required
               autocomplete="off"> <!-- Désactive l'autocomplétion -->
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" 
               class="form-control" 
               id="password" 
               name="password" 
               required
               autocomplete="new-password"> <!-- Empêche le remplissage automatique -->
    </div>
    <button type="submit" class="btn btn-primary">Connexion</button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection