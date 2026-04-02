@extends('admin.layouts.app')

@section('title', 'Détail client - ' . $client->full_name)
@section('header', 'Détail du client')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">Clients</a></li>
    <li class="breadcrumb-item active">{{ $client->full_name }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informations client</h3>
            </div>
            <div class="card-body">
                <h5>{{ $client->full_name }}</h5>
                <hr>
                <p><i class="fas fa-envelope"></i> {{ $client->email }}</p>
                <p><i class="fas fa-phone"></i> {{ $client->phone ?? 'N/A' }}</p>
                @if($client->whatsapp)
                    <p><i class="fab fa-whatsapp"></i> {{ $client->whatsapp }}</p>
                @endif
                <p><i class="fas fa-briefcase"></i> {{ $client->profession ?? 'N/A' }}</p>
                <p><i class="fas fa-map-marker-alt"></i> {{ $client->city ?? 'N/A' }}, {{ $client->country }}</p>
                <hr>
                <p><strong>Statut:</strong> <span class="badge badge-{{ $client->status_badge }}">{{ $client->status_text }}</span></p>
                <p><strong>Source:</strong> {{ $client->source }}</p>
                <p><strong>Inscrit le:</strong> {{ $client->created_at->format('d/m/Y H:i') }}</p>

                <div class="btn-group w-100">
                    <a href="mailto:{{ $client->email }}" class="btn btn-info">
                        <i class="fas fa-envelope"></i> Email
                    </a>
                    <a href="https://wa.me/{{ $client->whatsapp ?? $client->phone }}" target="_blank" class="btn btn-success">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Statistiques</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 text-center">
                        <h4>{{ $interactionsCount ?? 0 }}</h4>
                        <small>Interactions</small>
                    </div>
                    <div class="col-6 text-center">
                        <h4>{{ $pendingInteractions ?? 0 }}</h4>
                        <small>En attente</small>
                    </div>
                    <div class="col-6 text-center mt-3">
                        <h4>{{ $totalInquiries ?? 0 }}</h4>
                        <small>Demandes</small>
                    </div>
                    <div class="col-6 text-center mt-3">
                        <h4>{{ $totalRentalRequests ?? 0 }}</h4>
                        <small>Locations</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <!-- Locations actives -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-home"></i> Locations en cours
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.rentals.create', ['client_id' => $client->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Nouvelle location
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @if($client->activeRentals && $client->activeRentals->count() > 0)
                    @foreach($client->activeRentals as $rental)
                        <div class="rental-item p-3 border-bottom">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>{{ $rental->property->title ?? 'N/A' }}</strong><br>
                                    <small class="text-muted">{{ $rental->property->address ?? '' }}, {{ $rental->property->city ?? '' }}</small>
                                </div>
                                <div class="col-md-3">
                                    <i class="fas fa-calendar"></i> {{ $rental->start_date->format('d/m/Y') }}<br>
                                    <small>au {{ $rental->end_date->format('d/m/Y') }}</small>
                                </div>
                                <div class="col-md-2">
                                    <i class="fas fa-money-bill"></i> {{ number_format($rental->monthly_rent, 0, '', ' ') }} FCFA/mois
                                </div>
                                <div class="col-md-3">
                                    @php
                                        $hasPaid = $rental->has_paid_current_month ?? false;
                                        $isLate = $rental->is_payment_late ?? false;
                                    @endphp
                                    @if($isLate)
                                        <span class="badge badge-danger">⚠️ Paiement en retard</span>
                                    @elseif($hasPaid)
                                        <span class="badge badge-success">✅ Payé ce mois</span>
                                    @else
                                        <span class="badge badge-warning">⏳ En attente de paiement</span>
                                    @endif
                                    <div class="mt-1">
                                        <a href="{{ route('admin.rentals.show', $rental) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Détails
                                        </a>
                                        <a href="{{ route('admin.payments.create', ['rental' => $rental->id]) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus"></i> Paiement
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center p-4">
                        <p class="text-muted">Aucune location en cours</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Historique des paiements -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-credit-card"></i> Historique des paiements
                </h3>
            </div>
            <div class="card-body p-0">
                @if($client->payments && $client->payments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Facture</th>
                                    <th>Bien</th>
                                    <th>Montant</th>
                                    <th>Date paiement</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($client->payments->take(10) as $payment)
                                <tr>
                                    <td>{{ $payment->invoice_number }}</td>
                                    <td>{{ Str::limit($payment->rental->property->title ?? 'N/A', 30) }}</td>
                                    <td>{{ number_format($payment->amount, 0, '', ' ') }} FCFA</td>
                                    <td>{{ $payment->payment_date->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $payment->status_color ?? 'secondary' }}">
                                            {{ $payment->status_label ?? $payment->status }}
                                        </span>
                                    </td>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center p-4">
                        <p class="text-muted">Aucun paiement enregistré</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Ajouter une interaction -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Ajouter une interaction</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.clients.add-interaction', $client) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <select name="type" class="form-control" required>
                                <option value="call">📞 Appel</option>
                                <option value="email">✉️ Email</option>
                                <option value="whatsapp">💬 WhatsApp</option>
                                <option value="meeting">🤝 Rendez-vous</option>
                                <option value="visit">🏠 Visite</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="datetime-local" name="scheduled_at" class="form-control" placeholder="Date prévue">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-plus"></i> Ajouter
                            </button>
                        </div>
                    </div>
                    <div class="mt-2">
                        <textarea name="description" class="form-control" placeholder="Description..." required></textarea>
                    </div>
                </form>
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
                location.reload();
            }
        });
    }
}
</script>
@endsection
