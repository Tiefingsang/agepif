@extends('admin.layouts.app')

@section('title', 'Gestion des paiements')
@section('header', 'Paiements')
@section('breadcrumb')
    <li class="breadcrumb-item active">Paiements</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Statistiques -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ \App\Models\Payment::where('status', 'paid')->sum('amount') ?? 0 }} FCFA</h3>
                        <p>Total payé</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ \App\Models\Payment::where('status', 'pending')->sum('amount') ?? 0 }} FCFA</h3>
                        <p>En attente</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ \App\Models\Payment::where('status', 'overdue')->sum('amount') ?? 0 }} FCFA</h3>
                        <p>En retard</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ \App\Models\Payment::count() }}</h3>
                        <p>Transactions</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-credit-card"></i> Historique des paiements
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.payments.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Nouveau paiement
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Facture</th>
                                <th>Client</th>
                                <th>Bien</th>
                                <th>Montant</th>
                                <th>Type</th>
                                <th>Date paiement</th>
                                <th>Échéance</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                            <tr>
                                <td>{{ $payment->invoice_number }}</td>
                                <td>{{ $payment->client->full_name ?? 'N/A' }}</td>
                                <td>{{ Str::limit($payment->rental->property->title ?? 'N/A', 30) }}</td>
                                <td>{{ number_format($payment->amount, 0, '', ' ') }} FCFA</td>
                                <td>{{ $payment->type_label }}</td>
                                <td>{{ $payment->payment_date->format('d/m/Y') }}</td>
                                <td>{{ $payment->due_date->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge badge-{{ $payment->status_color }}">
                                        {{ $payment->status_label }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($payment->status == 'pending')
                                            <button onclick="sendReminder({{ $payment->id }})" class="btn btn-sm btn-warning">
                                                <i class="fas fa-bell"></i>
                                            </button>
                                            <button onclick="markAsPaid({{ $payment->id }})" class="btn btn-sm btn-success">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    <div class="py-5">
                                        <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Aucun paiement enregistré</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function sendReminder(paymentId) {
    if (confirm('Envoyer un rappel de paiement au client ?')) {
        fetch('/admin/payments/' + paymentId + '/send-reminder', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => {
            if(response.ok) {
                alert('Rappel envoyé avec succès');
            }
        });
    }
}

function markAsPaid(paymentId) {
    if (confirm('Marquer ce paiement comme payé ?')) {
        fetch('/admin/payments/' + paymentId + '/mark-as-paid', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => {
            if(response.ok) {
                location.reload();
            }
        });
    }
}
</script>
@endsection
