@extends('admin.layouts.app')

@section('title', 'Gestion des biens')
@section('header', 'Biens immobiliers')
@section('breadcrumb')
    <li class="breadcrumb-item active">Biens</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des biens immobiliers</h3>
        <div class="card-tools">
            <a href="{{ route('admin.properties.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Ajouter un bien
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <form method="GET" class="form-inline">
                <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                <select name="status" class="form-control ml-2">
                    <option value="">Tous les statuts</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publié</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Vendu</option>
                </select>
                <button type="submit" class="btn btn-primary ml-2">Filtrer</button>
            </form>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                    <th>Ville</th>
                    <th>Statut</th>
                    <th>Vedette</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                <tr>
                    <td>{{ $property->id }}</td>
                    <td>{{ Str::limit($property->title, 50) }}</td>
                    <td>{{ $property->category ? $property->category->name : 'N/A' }}</td>
                    <td>{{ number_format($property->price, 0, '', ' ') }} FCFA</td>
                    <td>{{ $property->city }}</td>
                    <td>
                        @if($property->status == 'published')
                            <span class="badge badge-success">Publié</span>
                        @elseif($property->status == 'draft')
                            <span class="badge badge-warning">Brouillon</span>
                        @else
                            <span class="badge badge-danger">Vendu</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.properties.toggle-featured', $property) }}"
                           class="btn btn-sm {{ $property->is_featured ? 'btn-warning' : 'btn-secondary' }}">
                            <i class="fas fa-star"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Aucun bien trouvé</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $properties->links() }}
        </div>
    </div>
</div>
@endsection
