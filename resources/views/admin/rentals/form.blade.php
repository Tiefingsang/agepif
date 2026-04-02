@extends('admin.layouts.app')

@section('title', $rental->exists ? 'Modifier le contrat' : 'Nouveau contrat')
@section('header', $rental->exists ? 'Modifier le contrat' : 'Nouveau contrat')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.rentals.index') }}">Locations</a></li>
    <li class="breadcrumb-item active">{{ $rental->exists ? 'Modifier' : 'Ajouter' }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ $rental->exists ? route('admin.rentals.update', $rental) : route('admin.rentals.store') }}"
              method="POST">
            @csrf
            @if($rental->exists)
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Client *</label>
                        <select name="client_id" class="form-control" required>
                            <option value="">Sélectionner un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id', $rental->client_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->full_name }} - {{ $client->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Bien immobilier *</label>
                        <select name="property_id" class="form-control" required>
                            <option value="">Sélectionner un bien</option>
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}" {{ old('property_id', $rental->property_id) == $property->id ? 'selected' : '' }}>
                                    {{ $property->title }} - {{ number_format($property->price, 0, '', ' ') }} FCFA/mois
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date de début *</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $rental->start_date) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date de fin *</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $rental->end_date) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Loyer mensuel (FCFA) *</label>
                        <input type="number" name="monthly_rent" class="form-control" value="{{ old('monthly_rent', $rental->monthly_rent) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Caution (FCFA)</label>
                        <input type="number" name="deposit" class="form-control" value="{{ old('deposit', $rental->deposit) }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Statut</label>
                        <select name="status" class="form-control">
                            <option value="active" {{ old('status', $rental->status) == 'active' ? 'selected' : '' }}>Actif</option>
                            <option value="expired" {{ old('status', $rental->status) == 'expired' ? 'selected' : '' }}>Expiré</option>
                            <option value="terminated" {{ old('status', $rental->status) == 'terminated' ? 'selected' : '' }}>Résilié</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Notes du contrat</label>
                <textarea name="contract_notes" class="form-control" rows="3">{{ old('contract_notes', $rental->contract_notes) }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ $rental->exists ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
                <a href="{{ route('admin.rentals.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
