@extends('admin.layouts.app')

@section('title', 'Gestion des slides')
@section('header', 'Slides du carrousel')
@section('breadcrumb')
    <li class="breadcrumb-item active">Slides</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des slides</h3>
        <div class="card-tools">
            <a href="{{ route('admin.slides.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Ajouter un slide
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
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Sous-titre</th>
                    <th>Ordre</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($slides as $slide)
                <tr>
                    <td>{{ $slide->id }}</td>
                    <td>
                        @if($slide->image)
                            <img src="{{ Storage::url($slide->image) }}" style="height: 50px; width: 80px; object-fit: cover;">
                        @else
                            <span class="text-muted">Aucune image</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($slide->title, 50) }}</td>
                    <td>{{ Str::limit($slide->subtitle, 50) }}</td>
                    <td>{{ $slide->order }}</td>
                    <td>
                        @if($slide->is_active)
                            <span class="badge badge-success">Actif</span>
                        @else
                            <span class="badge badge-danger">Inactif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.slides.edit', $slide) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce slide ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun slide trouvé</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $slides->links() }}
        </div>
    </div>
</div>
@endsection
