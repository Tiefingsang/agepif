@extends('admin.layouts.app')

@section('title', 'Ajouter une demande')
@section('header', 'Ajouter une demande de contact')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.inquiries.index') }}">Demandes</a></li>
    <li class="breadcrumb-item active">Ajouter</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.inquiries.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nom complet *</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Téléphone *</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}" required>
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="property_id">Bien immobilier (optionnel)</label>
                        <select name="property_id" id="property_id" class="form-control @error('property_id') is-invalid @enderror">
                            <option value="">Sélectionner un bien</option>
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                    {{ $property->title }} - {{ number_format($property->price, 0, '', ' ') }} FCFA
                                </option>
                            @endforeach
                        </select>
                        @error('property_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="subject">Sujet</label>
                <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror"
                       value="{{ old('subject', 'Demande de contact') }}">
                @error('subject')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="message">Message *</label>
                <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror"
                          rows="5" required>{{ old('message') }}</textarea>
                @error('message')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Statut</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="contacted" {{ old('status') == 'contacted' ? 'selected' : '' }}>Contacté</option>
                            <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Traité</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="source">Source</label>
                        <select name="source" id="source" class="form-control @error('source') is-invalid @enderror">
                            <option value="website" {{ old('source') == 'website' ? 'selected' : '' }}>Site web</option>
                            <option value="whatsapp" {{ old('source') == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                            <option value="phone" {{ old('source') == 'phone' ? 'selected' : '' }}>Téléphone</option>
                            <option value="admin" {{ old('source') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                        </select>
                        @error('source')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer la demande
                </button>
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
