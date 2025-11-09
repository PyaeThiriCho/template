@extends('template.layout')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Role List</h4>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle me-1"></i> Add New Role Name
                    </a>
                </div>

                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th width="80">ID</th>
                                    <th>NAME</th>
                                    <th width="180" class="text-center">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td><strong>{{ $role->id }}</strong></td>
                                        <td><code>{{ $role->name }}</code></td>
                                        <td class="text-center">
                                            <a href="{{ route('roles.edit', $role->id) }}" 
                                               class="btn btn-sm btn-outline-warning me-2">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>

                                            <form action="{{ route('roles.destroy', $role->id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure you want to delete this permission?')">
                                                    <i class="fas fa-trash-alt me-1"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <p class="mb-0">No roles found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
