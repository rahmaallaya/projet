@extends('layouts.app')

@section('title', 'Gestion des Demandes')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h3 class="mb-0">
                @if(session('type') === 'user')
                    Mes Demandes Envoyées
                @else
                    Demandes Reçues
                @endif
            </h3>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            @if(session('type') === 'user')
                                <th>Prestataire</th>
                                <th>Statut</th>
                            @else
                                <th>Client</th>
                                <th>Contact</th>
                            @endif
                            <th>Description</th>
                            <th>Localisation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                        <tr class="@if($request->status === 'accepted') table-success @endif">
                            <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                            
                            @if(session('type') === 'user')
                                <td>{{ $request->prestataire->name }}</td>
                                <td>
                                    <span class="badge rounded-pill 
                                        {{ $request->status === 'pending' ? 'bg-warning' : 
                                           ($request->status === 'accepted' ? 'bg-success' : 'bg-danger') }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                            @else
                                <td>{{ $request->user->name }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>{{ $request->telephone }}</span>
                                        <small class="text-muted">{{ $request->user->email }}</small>
                                    </div>
                                </td>
                            @endif
                            
                            <td>{{ Str::limit($request->description, 50) }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span>{{ $request->ville }}</span>
                                    <small class="text-muted">{{ $request->gouvernorat }}</small>
                                </div>
                            </td>
                            
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Bouton Voir -->
                                    <a href="{{ route('requests.show', $request) }}" 
                                       class="btn btn-sm btn-info"
                                       data-bs-toggle="tooltip" 
                                       title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    @if(session('type') !== 'user')
                                        @if($request->status === 'pending')
                                            <!-- Boutons Accepter/Refuser -->
                                            <form method="POST" action="{{ route('requests.update', $request) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" 
                                                        name="status" 
                                                        value="accepted"
                                                        class="btn btn-sm btn-success"
                                                        data-bs-toggle="tooltip"
                                                        title="Accepter la demande">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                                <button type="submit" 
                                                        name="status" 
                                                        value="rejected"
                                                        class="btn btn-sm btn-danger"
                                                        data-bs-toggle="tooltip"
                                                        title="Refuser la demande">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endif

                                    <!-- Bouton Supprimer (Admin) -->
                                    @if(session('type') === 'super_admin')
                                        <button type="button" 
                                                class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $request->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Suppression -->
                        <div class="modal fade" id="deleteModal{{ $request->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Confirmer la suppression</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer définitivement cette demande ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <form action="{{ route('requests.destroy', $request) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <h4 class="text-muted">Aucune demande trouvée</h4>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($requests->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $requests->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script>
   
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
@endsection
@endsection