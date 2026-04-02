@extends('admin.layouts.app')

@section('title', 'Gestion des catégories')
@section('header', 'Catégories')
@section('breadcrumb')
    <li class="breadcrumb-item active">Catégories</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des catégories</h3>
        <div class="card-tools">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Ajouter une catégorie
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

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-ban"></i> {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                32
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Icône</th>
                    <th>Ordre</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td><i class="{{ $category->icon }}"></i> {{ $category->icon }}</td>
                    <td>{{ $category->order }}</td>
                    <td>
                        @if($category->is_active)
                            <span class="badge badge-success">Actif</span>
                        @else
                            <span class="badge badge-danger">Inactif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Aucune catégorie trouvée</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
