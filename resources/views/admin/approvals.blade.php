@extends('layouts.app')
@section('title', 'User Approvals')
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">User Approvals</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prestataires as $prestataire)
                <tr>
                    <td>{{ $prestataire->name }}</td>
                    <td>{{ $prestataire->email }}</td>
                    <td>{{ $prestataire->role }}</td>
                    <td>
                        <!-- Dropdown to assign category -->
                        <select class="form-control category-dropdown" data-role="{{ $prestataire->role }}">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" data-type="{{ $category->type }}"
                                    {{ $prestataire->id_categorie == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_categorie }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('approvals.show', $prestataire->id) }}" class="btn btn-info btn-sm">View</a>

                        <!-- Button to trigger the modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $prestataire->id }}">
                            Reject
                        </button>

                        <!-- Modal for confirmation -->
                        <div class="modal fade" id="rejectModal{{ $prestataire->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $prestataire->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rejectModalLabel{{ $prestataire->id }}">Confirm Rejection</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>You are about to reject <strong>{{ $prestataire->name }}</strong> (<em>{{ $prestataire->email }}</em>). Are you sure?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                        <!-- Form to submit the rejection -->
                                        <form action="{{ route('approvals.reject', $prestataire->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // Filter categories based on the prestataire's role
    document.querySelectorAll('.category-dropdown').forEach(dropdown => {
        const role = dropdown.getAttribute('data-role');
        const options = dropdown.options;

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