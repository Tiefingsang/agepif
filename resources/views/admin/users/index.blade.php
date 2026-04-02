@extends('admin.layouts.app')

@section('title', 'Gestion des utilisateurs')
@section('header', 'Utilisateurs')
@section('breadcrumb')
    <li class="breadcrumb-item active">Utilisateurs</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des utilisateurs</h3>
        <div class="card-tools">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Ajouter un utilisateur
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-check"></i> {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                32
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                    <th>Date d'inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? 'N/A' }}</td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge badge-primary">Administrateur</span>
                        @else
                            <span class="badge badge-secondary">Utilisateur</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun utilisateur trouvé</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
