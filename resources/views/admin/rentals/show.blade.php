@extends('admin.layouts.app')

@section('title', 'Détail du contrat')
@section('header', 'Détail du contrat de location')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informations client</h3>
            </div>
            <div class="card-body">
                <h5>{{ $rental->client->full_name }}</h5>
                <hr>
                <p><i class="fas fa-envelope"></i> {{ $rental->client->email }}</p>
                <p><i class="fas fa-phone"></i> {{ $rental->client->phone ?? 'N/A' }}</p>
                <p><i class="fas fa-map-marker-alt"></i> {{ $rental->client->city ?? 'N/A' }}</p>
                <a href="{{ route('admin.clients.show', $rental->client) }}" class="btn btn-info btn-block">
                    <i class="fas fa-user"></i> Voir la fiche client
                </a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Informations du bien</h3>
            </div>
            <div class="card-body">
                <h5>{{ $rental->property->title }}</h5>
                <p><i class="fas fa-map-marker-alt"></i> {{ $rental->property->address }}</p>
                <p><i class="fas fa-city"></i> {{ $rental->property->city }}</p>
                <p><i class="fas fa-money-bill"></i> Loyer: {{ number_format($rental->monthly_rent, 0, '', ' ') }} FCFA/mois</p>
                <a href="{{ route('admin.properties.edit', $rental->property) }}" class="btn btn-info btn-block">
                    <i class="fas fa-building"></i> Voir le bien
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Détails du contrat</h3>
                <div class="card-tools">
                    <span class="badge badge-{{ $rental->status_color }}">{{ $rental->status_label }}</span>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th>Date de début</th><td>{{ $rental->start_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Date de fin</th><td>{{ $rental->end_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Loyer mensuel</th><td>{{ number_format($rental->monthly_rent, 0, '', ' ') }} FCFA</td></tr>
                    <tr><th>Caution</th><td>{{ $rental->deposit ? number_format($rental->deposit, 0, '', ' ') . ' FCFA' : 'N/A' }}</td></tr>
                    <tr><th>Durée</th><td>{{ $rental->start_date->diffInMonths($rental->end_date) }} mois</td></tr>
                    <tr><th>Statut paiement</th>
                        <td>
                            @if($rental->is_payment_late)
                                <span class="badge badge-danger">⚠️ Paiement en retard</span>
                            @elseif($rental->has_paid_current_month)
                                <span class="badge badge-success">✅ Payé ce mois</span>
                            @else
                                <span class="badge badge-warning">⏳ En attente</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Historique des paiements</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.payments.create', ['rental' => $rental->id]) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Nouveau paiement
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Facture</th>
                            <th>Montant</th>
                            <th>Date paiement</th>
                            <th>Échéance</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rental->payments as $payment)
                        <tr>
                            <td>{{ $payment->invoice_number }}</td>
                            <td>{{ number_format($payment->amount, 0, '', ' ') }} FCFA</td>
                            <td>{{ $payment->payment_date->format('d/m/Y') }}</td>
                            <td>{{ $payment->due_date->format('d/m/Y') }}</td>
                            <td><span class="badge badge-{{ $payment->status_color }}">{{ $payment->status_label }}</span></td>
                            <td>
                                <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($payment->status == 'pending')
                                    <button onclick="sendReminder({{ $payment->id }})" class="btn btn-sm btn-warning">
                                        <i class="fas fa-bell"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">Aucun paiement enregistré</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function sendReminder(paymentId) {
    if (confirm('Envoyer un rappel de paiement au client ?')) {
        window.location.href = '/admin/payments/' + paymentId + '/send-reminder';
    }
}
</script>
@endsection
