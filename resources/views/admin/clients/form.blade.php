@extends('admin.layouts.app')

@section('title', $client->exists ? 'Modifier le client' : 'Ajouter un client')
@section('header', $client->exists ? 'Modifier le client' : 'Ajouter un client')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ $client->exists ? route('admin.clients.update', $client) : route('admin.clients.store') }}"
              method="POST">
            @csrf
            @if($client->exists)
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Prénom *</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $client->first_name) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nom *</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $client->last_name) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $client->phone) }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $client->whatsapp) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Profession</label>
                        <input type="text" name="profession" class="form-control" value="{{ old('profession', $client->profession) }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date de naissance</label>
                        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $client->birth_date) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nationalité</label>
                        <input type="text" name="nationality" class="form-control" value="{{ old('nationality', $client->nationality) }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ville</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city', $client->city) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pays</label>
                        <input type="text" name="country" class="form-control" value="{{ old('country', $client->country) }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Adresse</label>
                <textarea name="address" class="form-control" rows="2">{{ old('address', $client->address) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Carte d'identité</label>
                        <input type="text" name="identity_card" class="form-control" value="{{ old('identity_card', $client->identity_card) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Source</label>
                        <select name="source" class="form-control">
                            <option value="website" {{ old('source', $client->source) == 'website' ? 'selected' : '' }}>Site web</option>
                            <option value="direct" {{ old('source', $client->source) == 'direct' ? 'selected' : '' }}>Direct</option>
                            <option value="recommendation" {{ old('source', $client->source) == 'recommendation' ? 'selected' : '' }}>Recommandation</option>
                            <option value="social_media" {{ old('source', $client->source) == 'social_media' ? 'selected' : '' }}>Réseaux sociaux</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Statut</label>
                        <select name="status" class="form-control">
                            <option value="active" {{ old('status', $client->status) == 'active' ? 'selected' : '' }}>Actif</option>
                            <option value="inactive" {{ old('status', $client->status) == 'inactive' ? 'selected' : '' }}>Inactif</option>
                            <option value="blocked" {{ old('status', $client->status) == 'blocked' ? 'selected' : '' }}>Bloqué</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Notes</label>
                <textarea name="notes" class="form-control" rows="3">{{ old('notes', $client->notes) }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ $client->exists ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
                <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
