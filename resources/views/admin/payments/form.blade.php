@extends('admin.layouts.app')

@section('title', $payment->exists ? 'Modifier le paiement' : 'Nouveau paiement')
@section('header', $payment->exists ? 'Modifier le paiement' : 'Nouveau paiement')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.payments.index') }}">Paiements</a></li>
    <li class="breadcrumb-item active">{{ $payment->exists ? 'Modifier' : 'Ajouter' }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ $payment->exists ? route('admin.payments.update', $payment) : route('admin.payments.store') }}"
              method="POST">
            @csrf
            @if($payment->exists)
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Client *</label>
                        <select name="client_id" class="form-control" required>
                            <option value="">Sélectionner un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id', $payment->client_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->full_name }} - {{ $client->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Contrat de location *</label>
                        <select name="rental_id" class="form-control" required>
                            <option value="">Sélectionner un contrat</option>
                            @foreach($rentals ?? [] as $rentalItem)
                                <option value="{{ $rentalItem->id }}" {{ old('rental_id', $payment->rental_id ?? ($rental->id ?? '')) == $rentalItem->id ? 'selected' : '' }}>
                                    {{ $rentalItem->client->full_name }} - {{ $rentalItem->property->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Montant (FCFA) *</label>
                        <input type="number" name="amount" class="form-control" value="{{ old('amount', $payment->amount) }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Type de paiement *</label>
                        <select name="type" class="form-control" required>
                            <option value="rent" {{ old('type', $payment->type) == 'rent' ? 'selected' : '' }}>🏠 Loyer</option>
                            <option value="deposit" {{ old('type', $payment->type) == 'deposit' ? 'selected' : '' }}>💰 Caution</option>
                            <option value="penalty" {{ old('type', $payment->type) == 'penalty' ? 'selected' : '' }}>⚠️ Pénalité</option>
                            <option value="other" {{ old('type', $payment->type) == 'other' ? 'selected' : '' }}>📋 Autre</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Statut *</label>
                        <select name="status" class="form-control" required>
                            <option value="paid" {{ old('status', $payment->status) == 'paid' ? 'selected' : '' }}>✅ Payé</option>
                            <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>⏳ En attente</option>
                            <option value="overdue" {{ old('status', $payment->status) == 'overdue' ? 'selected' : '' }}>🔴 En retard</option>
                            <option value="cancelled" {{ old('status', $payment->status) == 'cancelled' ? 'selected' : '' }}>❌ Annulé</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date de paiement *</label>
                        <input type="date" name="payment_date" class="form-control" value="{{ old('payment_date', $payment->payment_date ?? date('Y-m-d')) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date d'échéance *</label>
                        <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $payment->due_date ?? date('Y-m-d')) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mode de paiement</label>
                        <select name="payment_method" class="form-control">
                            <option value="">Sélectionner</option>
                            <option value="cash" {{ old('payment_method', $payment->payment_method) == 'cash' ? 'selected' : '' }}>💰 Espèces</option>
                            <option value="bank_transfer" {{ old('payment_method', $payment->payment_method) == 'bank_transfer' ? 'selected' : '' }}>🏦 Virement bancaire</option>
                            <option value="mobile_money" {{ old('payment_method', $payment->payment_method) == 'mobile_money' ? 'selected' : '' }}>📱 Mobile Money</option>
                            <option value="check" {{ old('payment_method', $payment->payment_method) == 'check' ? 'selected' : '' }}>📝 Chèque</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>ID Transaction</label>
                        <input type="text" name="transaction_id" class="form-control" value="{{ old('transaction_id', $payment->transaction_id) }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Notes</label>
                <textarea name="notes" class="form-control" rows="3">{{ old('notes', $payment->notes) }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ $payment->exists ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection

