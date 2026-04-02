@extends('admin.layouts.app')

@section('title', 'Gestion des locations')
@section('header', 'Contrats de location')
@section('breadcrumb')
    <li class="breadcrumb-item active">Locations</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Statistiques -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ \App\Models\Rental::count() }}</h3>
                        <p>Total contrats</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-contract"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ \App\Models\Rental::where('status', 'active')->count() }}</h3>
                        <p>Contrats actifs</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ \App\Models\Rental::where('status', 'expired')->count() }}</h3>
                        <p>Expirés</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ \App\Models\Rental::where('status', 'terminated')->count() }}</h3>
                        <p>Résiliés</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-ban"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list"></i> Liste des contrats
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.rentals.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Nouveau contrat
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Bien immobilier</th>
                                <th>Période</th>
                                <th>Loyer mensuel</th>
                                <th>Statut</th>
                                <th>Paiements</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rentals as $rental)
                            <tr>
                                <td>#{{ $rental->id }}</td>
                                <td>
                                    <strong>{{ $rental->client->full_name ?? 'N/A' }}</strong><br>
                                    <small>{{ $rental->client->email ?? '' }}</small>
                                </td>
                                <td>
                                    {{ Str::limit($rental->property->title ?? 'N/A', 40) }}<br>
                                    <small>{{ $rental->property->city ?? '' }}</small>
                                </td>
                                <td>
                                    {{ $rental->start_date->format('d/m/Y') }}<br>
                                    <small>au {{ $rental->end_date->format('d/m/Y') }}</small>
                                </td>
                                <td>{{ number_format($rental->monthly_rent, 0, '', ' ') }} FCFA</td>
                                <td>
                                    <span class="badge badge-{{ $rental->status_color }}">
                                        {{ $rental->status_label }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $rental->payments->where('status', 'paid')->count() }} payés</span>
                                    @if($rental->is_payment_late)
                                        <span class="badge badge-danger">⚠️ Retard</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.rentals.show', $rental) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.rentals.edit', $rental) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.payments.create', ['rental' => $rental->id]) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-money-bill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="py-5">
                                        <i class="fas fa-file-contract fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Aucun contrat de location trouvé</p>
                                        <a href="{{ route('admin.rentals.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Créer un contrat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{ $rentals->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
