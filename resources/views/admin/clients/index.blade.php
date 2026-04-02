@extends('admin.layouts.app')

@section('title', 'Gestion des clients')
@section('header', 'Clients')
@section('breadcrumb')
    <li class="breadcrumb-item active">Clients</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Statistiques -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ \App\Models\Client::count() }}</h3>
                        <p>Total clients</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ \App\Models\Client::where('status', 'active')->count() }}</h3>
                        <p>Clients actifs</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ \App\Models\ClientInteraction::where('status', 'pending')->count() }}</h3>
                        <p>Interactions en attente</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ \App\Models\Client::where('source', 'website')->count() }}</h3>
                        <p>Via site web</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-globe"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list"></i> Liste des clients
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Ajouter un client
                    </a>
                    <div class="input-group input-group-sm d-inline-flex ml-2" style="width: 200px;">
                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                        <div class="input-group-append">
                            <button class="btn btn-default" id="searchBtn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Contact</th>
                                <th>Profession</th>
                                <th>Ville</th>
                                <th>Statut</th>
                                <th>Date ajout</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                            <tr>
                                <td>#{{ $client->id }}</td>
                                <td>
                                    <strong>{{ $client->full_name }}</strong><br>
                                    <small class="text-muted">Inscrit le {{ $client->created_at->format('d/m/Y') }}</small>
                                </td>
                                <td>
                                    <div><i class="fas fa-envelope"></i> {{ $client->email }}</div>
                                    <div><i class="fas fa-phone"></i> {{ $client->phone ?? 'N/A' }}</div>
                                    @if($client->whatsapp)
                                        <div><i class="fab fa-whatsapp"></i> {{ $client->whatsapp }}</div>
                                    @endif
                                </td>
                                <td>{{ $client->profession ?? 'N/A' }}</td>
                                <td>{{ $client->city ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $client->status_badge }}">{{ $client->status_text }}</span>
                                </td>
                                <td>{{ $client->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.clients.show', $client) }}" class="btn btn-sm btn-info" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-success" title="WhatsApp" onclick="window.open('https://wa.me/{{ $client->whatsapp ?? $client->phone }}', '_blank')">
                                            <i class="fab fa-whatsapp"></i>
                                        </button>
                                        <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Supprimer ce client ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="py-5">
                                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Aucun client trouvé</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$('#searchBtn, #searchInput').on('click keyup', function(e) {
    if (e.type === 'keyup' && e.keyCode !== 13) return;
    var search = $('#searchInput').val();
    window.location.href = '{{ route("admin.clients.index") }}?search=' + search;
});
</script>
@endsection
