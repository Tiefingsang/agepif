@extends('admin.layouts.app')

@section('title', 'Demandes de contact')
@section('header', 'Demandes de contact')
@section('breadcrumb')
    <li class="breadcrumb-item active">Demandes</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Statistiques -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalInquiries ?? $inquiries->total() }}</h3>
                        <p>Total demandes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $pendingCount ?? \App\Models\Inquiry::where('status', 'pending')->count() }}</h3>
                        <p>En attente</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $contactedCount ?? \App\Models\Inquiry::where('status', 'contacted')->count() }}</h3>
                        <p>Contactés</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $closedCount ?? \App\Models\Inquiry::where('status', 'closed')->count() }}</h3>
                        <p>Traités</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres et recherche -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list"></i> Liste des demandes
                </h3>
                <div class="card-tools">
                    <!-- Bouton Ajouter une demande -->
                    <a href="{{ route('admin.inquiries.create') }}" class="btn btn-primary btn-sm mr-2">
                        <i class="fas fa-plus"></i> Ajouter une demande
                    </a>
                    <div class="input-group input-group-sm" style="width: 300px; display: inline-flex;">
                        <input type="text" id="searchInput" class="form-control float-right" placeholder="Rechercher par nom, email...">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-default" id="searchBtn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="row mb-3 p-3">
                    <div class="col-md-3">
                        <label>Filtrer par statut</label>
                        <select name="status_filter" id="statusFilter" class="form-control">
                            <option value="{{ route('admin.inquiries.index') }}">Tous</option>
                            <option value="{{ route('admin.inquiries.index', ['status' => 'pending']) }}" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="{{ route('admin.inquiries.index', ['status' => 'contacted']) }}" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contactés</option>
                            <option value="{{ route('admin.inquiries.index', ['status' => 'closed']) }}" {{ request('status') == 'closed' ? 'selected' : '' }}>Traités</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Filtrer par date</label>
                        <select id="dateFilter" class="form-control">
                            <option value="all">Toutes les dates</option>
                            <option value="today">Aujourd'hui</option>
                            <option value="week">Cette semaine</option>
                            <option value="month">Ce mois</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Actions rapides</label>
                        <div>
                            <button class="btn btn-sm btn-success" id="exportExcel">
                                <i class="fas fa-file-excel"></i> Exporter Excel
                            </button>
                            <button class="btn btn-sm btn-danger" id="exportPDF">
                                <i class="fas fa-file-pdf"></i> Exporter PDF
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="50">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Contact</th>
                                <th>Bien immobilier</th>
                                <th>Message</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="inquiriesTable">
                            @forelse($inquiries as $inquiry)
                            <tr data-status="{{ $inquiry->status }}" data-date="{{ $inquiry->created_at->format('Y-m-d') }}">
                                <td>
                                    <input type="checkbox" class="inquiry-checkbox" value="{{ $inquiry->id }}">
                                </td>
                                <td>#{{ $inquiry->id }}</td>
                                <td>
                                    <strong>{{ $inquiry->name }}</strong>
                                </td>
                                <td>
                                    <div><i class="fas fa-envelope"></i> {{ $inquiry->email }}</div>
                                    <div><i class="fas fa-phone"></i> {{ $inquiry->phone }}</div>
                                </td>
                                <td>
                                    @if($inquiry->property)
                                        <a href="{{ route('admin.properties.edit', $inquiry->property) }}" class="text-primary">
                                            <i class="fas fa-building"></i> {{ Str::limit($inquiry->property->title, 30) }}
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-link view-message" data-message="{{ $inquiry->message }}">
                                        <i class="fas fa-comment-dots"></i> Voir
                                    </button>
                                </td>
                                <td>
                                    <form action="{{ route('admin.inquiries.update', $inquiry) }}" method="POST" class="status-form">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-control form-control-sm status-select" style="width: 120px;">
                                            <option value="pending" {{ $inquiry->status == 'pending' ? 'selected' : '' }}>⏳ En attente</option>
                                            <option value="contacted" {{ $inquiry->status == 'contacted' ? 'selected' : '' }}>📞 Contacté</option>
                                            <option value="closed" {{ $inquiry->status == 'closed' ? 'selected' : '' }}>✅ Traité</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div>{{ $inquiry->created_at->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $inquiry->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-info" title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="mailto:{{ $inquiry->email }}" class="btn btn-sm btn-secondary" title="Envoyer email">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}" target="_blank" class="btn btn-sm btn-success" title="WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Supprimer cette demande ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    <div class="py-5">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Aucune demande de contact trouvée</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-danger" id="bulkDelete" disabled>
                                    <i class="fas fa-trash"></i> Supprimer sélection
                                </button>
                                <button class="btn btn-sm btn-primary" id="bulkContacted" disabled>
                                    <i class="fas fa-phone"></i> Marquer comme contacté
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                {{ $inquiries->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour voir le message -->
<div class="modal fade" id="messageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message du client</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="messageContent">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Changement de statut automatique
    $('.status-select').on('change', function() {
        $(this).closest('form').submit();
    });

    // Voir le message
    $('.view-message').on('click', function() {
        var message = $(this).data('message');
        $('#messageContent').html('<p>' + message + '</p>');
        $('#messageModal').modal('show');
    });

    // Filtrer par statut
    $('#statusFilter').on('change', function() {
        window.location.href = $(this).val();
    });

    // Filtrer par date
    $('#dateFilter').on('change', function() {
        var filter = $(this).val();
        var today = new Date();
        var currentDate = new Date();

        $('#inquiriesTable tr').each(function() {
            var rowDate = $(this).data('date');
            if (!rowDate) return;

            var show = false;
            var rowDateObj = new Date(rowDate);

            switch(filter) {
                case 'today':
                    show = rowDate === currentDate.toISOString().split('T')[0];
                    break;
                case 'week':
                    var weekAgo = new Date();
                    weekAgo.setDate(weekAgo.getDate() - 7);
                    show = rowDateObj >= weekAgo;
                    break;
                case 'month':
                    var monthAgo = new Date();
                    monthAgo.setMonth(monthAgo.getMonth() - 1);
                    show = rowDateObj >= monthAgo;
                    break;
                default:
                    show = true;
            }

            $(this).toggle(show);
        });
    });

    // Recherche
    $('#searchBtn, #searchInput').on('click keyup', function(e) {
        if (e.type === 'keyup' && e.keyCode !== 13) return;

        var search = $('#searchInput').val().toLowerCase();

        $('#inquiriesTable tr').each(function() {
            var text = $(this).text().toLowerCase();
            $(this).toggle(text.indexOf(search) > -1);
        });
    });

    // Sélectionner tout
    $('#selectAll').on('change', function() {
        $('.inquiry-checkbox').prop('checked', $(this).prop('checked'));
        updateBulkButtons();
    });

    $('.inquiry-checkbox').on('change', function() {
        updateBulkButtons();
    });

    function updateBulkButtons() {
        var checked = $('.inquiry-checkbox:checked').length;
        $('#bulkDelete, #bulkContacted').prop('disabled', checked === 0);
    }

    // Suppression en masse
    $('#bulkDelete').on('click', function() {
        if (!confirm('Supprimer les demandes sélectionnées ?')) return;

        var ids = [];
        $('.inquiry-checkbox:checked').each(function() {
            ids.push($(this).val());
        });

        $.ajax({
            url: '{{ route("admin.inquiries.bulk-delete") }}',
            method: 'POST',
            data: {
                ids: ids,
                _token: '{{ csrf_token() }}'
            },
            success: function() {
                location.reload();
            }
        });
    });

    // Marquer comme contacté en masse
    $('#bulkContacted').on('click', function() {
        if (!confirm('Marquer les demandes sélectionnées comme contactées ?')) return;

        var ids = [];
        $('.inquiry-checkbox:checked').each(function() {
            ids.push($(this).val());
        });

        $.ajax({
            url: '{{ route("admin.inquiries.bulk-contacted") }}',
            method: 'POST',
            data: {
                ids: ids,
                _token: '{{ csrf_token() }}'
            },
            success: function() {
                location.reload();
            }
        });
    });

    // Exporter Excel
    $('#exportExcel').on('click', function() {
        window.location.href = '{{ route("admin.inquiries.export-excel") }}' + window.location.search;
    });

    // Exporter PDF
    $('#exportPDF').on('click', function() {
        window.location.href = '{{ route("admin.inquiries.export-pdf") }}' + window.location.search;
    });
});
</script>
@endpush
