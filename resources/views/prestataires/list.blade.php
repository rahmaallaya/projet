@extends('layouts.app')

@section('title', 'Prestataires')

@section('content')
<div class="container mt-5">
    <!-- Debug Session -->
    @if(session('debug'))
    <div class="alert alert-info">
        <strong>Session Debug:</strong><br>
        User ID: {{ session('user_id') ?? 'null' }}<br>
        User Type: {{ session('user_type') ?? 'null' }}<br>
        Logged In: {{ session('logged_in') ? 'true' : 'false' }}
    </div>
    @endif

    <h1 class="text-center mb-4">Prestataires - {{ $category->name_categorie }}</h1>

    <div class="row">
        @foreach($prestataires as $prestataire)
            @if($prestataire)
                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $prestataire->name }}
                                @if($prestataire->role === 'entreprise')
                                    <span class="badge bg-success ms-2">Entreprise</span>
                                @else
                                    <span class="badge bg-primary ms-2">Indépendant</span>
                                @endif
                            </h5>

                            <!-- Section Contact -->
                            <div class="mt-3">
                                @if(session('logged_in') && session('user_type') === 'user')
                                    <button type="button" 
                                            class="btn btn-primary w-100" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#contactModal{{ $prestataire->id }}">
                                        <i class="bi bi-envelope me-2"></i>Contacter
                                    </button>
                                @else
                                    <div class="alert alert-warning mb-0">
                                        @if(session('user_type') === 'individu' || session('user_type') === 'entreprise')
                                            <i class="bi bi-exclamation-triangle me-2"></i>
                                            Connecté en tant que prestataire.<br>
                                            <a href="{{ route('logout') }}" class="text-danger">Déconnexion nécessaire</a>
                                        @else
                                            <a href="{{ route('login.form') }}" class="btn btn-outline-primary w-100">
                                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                                Connexion requise
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                @if(session('logged_in') && session('user_type') === 'user')
                <div class="modal fade" id="contactModal{{ $prestataire->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('requests.store', $prestataire->id) }}">
                                @csrf
                                
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">
                                        <i class="bi bi-send me-2"></i>
                                        Demande de service à {{ $prestataire->name }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach($errors->all() as $error)
                                                <p class="mb-0">{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label">Votre nom complet</label>
                                        <input type="text" 
                                               class="form-control" 
                                               value="{{ session('user_name') }}" 
                                               readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description du service *</label>
                                        <textarea name="description" 
                                                  class="form-control" 
                                                  rows="4"
                                                  placeholder="Décrivez précisément votre besoin..."
                                                  required>{{ old('description') }}</textarea>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Ville *</label>
                                            <input type="text" 
                                                   name="ville" 
                                                   class="form-control" 
                                                   value="{{ old('ville') }}"
                                                   required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Gouvernorat *</label>
                                            <input type="text" 
                                                   name="gouvernorat" 
                                                   class="form-control" 
                                                   value="{{ old('gouvernorat') }}"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Téléphone *</label>
                                        <input type="tel" 
                                               name="telephone" 
                                               class="form-control" 
                                               pattern="[0-9]{8}"
                                               placeholder="12345678"
                                               value="{{ old('telephone') }}"
                                               required>
                                        <small class="form-text text-muted">8 chiffres sans espaces</small>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" 
                                            class="btn btn-secondary" 
                                            data-bs-dismiss="modal">
                                        Annuler
                                    </button>
                                    <button type="submit" 
                                            class="btn btn-primary">
                                        <i class="bi bi-send-check me-2"></i>Envoyer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            @endif
        @endforeach
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection