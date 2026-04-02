@extends('admin.layouts.app')

@section('title', 'Détail du paiement')
@section('header', 'Détail du paiement')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informations du paiement</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th>N° Facture</th><td>{{ $payment->invoice_number }}</td></tr>
                    <tr><th>Montant</th><td>{{ number_format($payment->amount, 0, '', ' ') }} FCFA</td></tr>
                    <tr><th>Type</th><td>{{ $payment->type_label }}</td></tr>
                    <tr><th>Statut</th>
                        <td><span class="badge badge-{{ $payment->status_color }}">{{ $payment->status_label }}</span></td>
                    </tr>
                    <tr><th>Date de paiement</th><td>{{ $payment->payment_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Date d'échéance</th><td>{{ $payment->due_date->format('d/m/Y') }}</td></tr>
                    <tr><th>Mode de paiement</th><td>{{ $payment->payment_method ?? 'N/A' }}</td></tr>
                    <tr><th>ID Transaction</th><td>{{ $payment->transaction_id ?? 'N/A' }}</td></tr>
                    <tr><th>Notes</th><td>{{ $payment->notes ?? 'N/A' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Client</h3>
            </div>
            <div class="card-body">
                <h5>{{ $payment->client->full_name }}</h5>
                <p><i class="fas fa-envelope"></i> {{ $payment->client->email }}</p>
                <p><i class="fas fa-phone"></i> {{ $payment->client->phone ?? 'N/A' }}</p>
                <a href="{{ route('admin.clients.show', $payment->client) }}" class="btn btn-info">
                    <i class="fas fa-user"></i> Voir le client
                </a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Contrat de location</h3>
            </div>
            <div class="card-body">
                <p><strong>Bien:</strong> {{ $payment->rental->property->title }}</p>
                <p><strong>Client:</strong> {{ $payment->rental->client->full_name }}</p>
                <p><strong>Période:</strong> {{ $payment->rental->start_date->format('d/m/Y') }} au {{ $payment->rental->end_date->format('d/m/Y') }}</p>
                <a href="{{ route('admin.rentals.show', $payment->rental) }}" class="btn btn-info">
                    <i class="fas fa-file-contract"></i> Voir le contrat
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Actions</h3>
            </div>
            <div class="card-body">
                <div class="btn-group">
                    <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    @if($payment->status == 'pending')
                        <button onclick="markAsPaid()" class="btn btn-success">
                            <i class="fas fa-check"></i> Marquer comme payé
                        </button>
                        <button onclick="sendReminder()" class="btn btn-warning">
                            <i class="fas fa-bell"></i> Envoyer rappel
                        </button>
                    @endif
                    <button onclick="sendInvoice()" class="btn btn-info">
                        <i class="fas fa-file-invoice"></i> Envoyer facture
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function sendReminder() {
    if (confirm('Envoyer un rappel de paiement au client ?')) {
        fetch('{{ route("admin.payments.send-reminder", $payment) }}', {
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

function markAsPaid() {
    if (confirm('Marquer ce paiement comme payé ?')) {
        fetch('{{ route("admin.payments.mark-as-paid", $payment) }}', {
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

function sendInvoice() {
    fetch('{{ route("admin.payments.send-invoice", $payment) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }).then(response => {
        if(response.ok) {
            alert('Facture envoyée avec succès');
        }
    });
}
</script>
@endsection
