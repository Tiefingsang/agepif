{{-- @extends('admin.layouts.app')

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
 --}}


 @extends('admin.layouts.app')

@section('title', 'Gestion des biens immobiliers')
@section('header', 'Biens immobiliers')
@section('breadcrumb')
    <li class="breadcrumb-item active">Biens</li>
@endsection

@section('content')
<style>
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        color: white;
        transition: transform 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .stat-card .stat-number {
        font-size: 32px;
        font-weight: bold;
    }
    .stat-card .stat-label {
        font-size: 14px;
        opacity: 0.9;
    }
    .stat-card .stat-icon {
        font-size: 40px;
        opacity: 0.3;
        position: absolute;
        right: 20px;
        top: 20px;
    }
    .property-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s;
        background: white;
        margin-bottom: 20px;
    }
    .property-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
    }
    .property-image {
        height: 200px;
        background-size: cover;
        background-position: center;
        border-radius: 12px 12px 0 0;
        position: relative;
    }
    .property-badge {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .property-price {
        font-size: 22px;
        font-weight: bold;
        color: #28a745;
    }
    .property-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    .property-info {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 5px;
    }
    .property-info i {
        width: 20px;
        color: #007bff;
    }
    .action-buttons {
        display: flex;
        gap: 5px;
        margin-top: 10px;
    }
    .btn-action {
        flex: 1;
        padding: 5px;
        font-size: 12px;
    }
    .filter-section {
        background: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .pagination-wrapper {
        background: white;
        padding: 15px;
        border-radius: 12px;
        margin-top: 20px;
    }
    .table-responsive {
        overflow-x: auto;
    }
    @media (max-width: 768px) {
        .property-card {
            margin-bottom: 15px;
        }
    }
</style>

<!-- Statistiques -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="stat-number">{{ $totalProperties ?? $properties->total() }}</div>
            <div class="stat-label">Total biens</div>
            <i class="fas fa-building stat-icon"></i>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
            <div class="stat-number">{{ $publishedCount ?? \App\Models\Property::where('status', 'published')->count() }}</div>
            <div class="stat-label">Biens publiés</div>
            <i class="fas fa-check-circle stat-icon"></i>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="stat-number">{{ $featuredCount ?? \App\Models\Property::where('is_featured', true)->count() }}</div>
            <div class="stat-label">En vedette</div>
            <i class="fas fa-star stat-icon"></i>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="stat-number">{{ $totalValue ?? number_format(\App\Models\Property::sum('price'), 0, '', ' ') }}</div>
            <div class="stat-label">Valeur totale</div>
            <i class="fas fa-chart-line stat-icon"></i>
        </div>
    </div>
</div>

<!-- Filtres -->
<div class="filter-section">
    <form method="GET" id="filterForm">
        <div class="row align-items-end">
            <div class="col-md-3">
                <div class="form-group">
                    <label><i class="fas fa-search"></i> Recherche</label>
                    <input type="text" name="search" class="form-control" placeholder="Titre, ville, adresse..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label><i class="fas fa-tag"></i> Statut</label>
                    <select name="status" class="form-control">
                        <option value="">Tous</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>✅ Publié</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>📝 Brouillon</option>
                        <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>❌ Vendu</option>
                        <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>🔑 Loué</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label><i class="fas fa-exchange-alt"></i> Transaction</label>
                    <select name="transaction_type" class="form-control">
                        <option value="">Tous</option>
                        <option value="sale" {{ request('transaction_type') == 'sale' ? 'selected' : '' }}>💰 Vente</option>
                        <option value="rent" {{ request('transaction_type') == 'rent' ? 'selected' : '' }}>📅 Location</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label><i class="fas fa-city"></i> Type</label>
                    <select name="type" class="form-control">
                        <option value="">Tous</option>
                        <option value="house" {{ request('type') == 'house' ? 'selected' : '' }}>🏠 Maison</option>
                        <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>🏢 Appartement</option>
                        <option value="land" {{ request('type') == 'land' ? 'selected' : '' }}>🌍 Terrain</option>
                        <option value="commercial" {{ request('type') == 'commercial' ? 'selected' : '' }}>🏪 Commercial</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filtrer
                        </button>
                        <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Réinitialiser
                        </a>
                        <a href="{{ route('admin.properties.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Nouveau bien
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Liste des biens -->
<div class="row">
    @forelse($properties as $property)
    <div class="col-lg-4 col-md-6">
        <div class="property-card">
            @php
                $images = is_array($property->images) ? $property->images : json_decode($property->images, true);
                $mainImage = ($images && count($images) > 0) ? Storage::url($images[0]) : asset('images/default-property.jpg');
            @endphp
            <div class="property-image" style="background-image: url('{{ $mainImage }}');">
                <div class="property-badge">
                    @if($property->is_featured)
                        <span class="badge badge-warning"><i class="fas fa-star"></i> Vedette</span>
                    @endif
                    @if($property->status == 'published')
                        <span class="badge badge-success">Publié</span>
                    @elseif($property->status == 'draft')
                        <span class="badge badge-warning">Brouillon</span>
                    @elseif($property->status == 'sold')
                        <span class="badge badge-danger">Vendu</span>
                    @else
                        <span class="badge badge-info">Loué</span>
                    @endif
                </div>
            </div>
            <div class="p-3">
                <div class="property-price">
                    {{ number_format($property->price, 0, '', ' ') }} FCFA
                    @if($property->transaction_type == 'rent')
                        <small class="text-muted">/mois</small>
                    @endif
                </div>
                <div class="property-title">
                    {{ Str::limit($property->title, 60) }}
                </div>
                <div class="property-info">
                    <i class="fas fa-map-marker-alt"></i> {{ $property->city }}, {{ $property->neighborhood ?? 'N/A' }}
                </div>
                <div class="property-info">
                    <i class="fas fa-ruler-combined"></i> {{ $property->surface }} m²
                    @if($property->type != 'land')
                        | <i class="fas fa-bed"></i> {{ $property->bedrooms }} ch
                        | <i class="fas fa-bath"></i> {{ $property->bathrooms }} sdb
                    @endif
                </div>
                <div class="property-info">
                    <i class="fas fa-folder"></i> {{ $property->category->name ?? 'Non catégorisé' }}
                </div>
                <div class="action-buttons">
                    <a href="{{ route('admin.properties.show', $property) }}" class="btn btn-sm btn-info btn-action" title="Voir détails">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn-sm btn-primary btn-action" title="Modifier">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.properties.toggle-featured', $property) }}" class="btn btn-sm {{ $property->is_featured ? 'btn-warning' : 'btn-secondary' }} btn-action" title="{{ $property->is_featured ? 'Retirer la vedette' : 'Mettre en vedette' }}">
                        <i class="fas fa-star"></i>
                    </a>
                    <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="d-inline" style="flex:1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bien ?')" title="Supprimer">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center py-5">
            <i class="fas fa-building fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">Aucun bien immobilier trouvé</h5>
            <p class="text-muted">Commencez par ajouter votre premier bien</p>
            <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter un bien
            </a>
        </div>
    </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="pagination-wrapper">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="mb-2 mb-md-0">
            <small class="text-muted">
                Affichage de {{ $properties->firstItem() ?? 0 }} à {{ $properties->lastItem() ?? 0 }} sur {{ $properties->total() }} biens
            </small>
        </div>
        <div>
            {{ $properties->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<script>
// Auto-submit du formulaire lors du changement de filtre
document.querySelectorAll('#filterForm select').forEach(select => {
    select.addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
});

// Recherche avec délai
let searchTimeout;
document.querySelector('input[name="search"]').addEventListener('keyup', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        document.getElementById('filterForm').submit();
    }, 500);
});
</script>
@endsection
