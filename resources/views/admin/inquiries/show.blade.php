@extends('admin.layouts.app')

@section('title', 'Détail de la demande')
@section('header', 'Détail de la demande')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informations du client</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Nom complet</th>
                        <td>{{ $inquiry->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $inquiry->email }}</td>
                    </tr>
                    <tr>
                        <th>Téléphone</th>
                        <td>{{ $inquiry->phone }}</td>
                    </tr>
                    <tr>
                        <th>Sujet</th>
                        <td>{{ $inquiry->subject ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td>{{ $inquiry->message }}</td>
                    </tr>
                    <tr>
                        <th>Source</th>
                        <td>{{ $inquiry->source }}</td>
                    </tr>
                    <tr>
                        <th>IP Address</th>
                        <td>{{ $inquiry->ip_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Date de création</th>
                        <td>{{ $inquiry->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Actions</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.inquiries.update', $inquiry) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Statut</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ $inquiry->status == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="contacted" {{ $inquiry->status == 'contacted' ? 'selected' : '' }}>Contacté</option>
                            <option value="closed" {{ $inquiry->status == 'closed' ? 'selected' : '' }}>Traité</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="notes" class="form-control" rows="4">{{ $inquiry->notes }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                </form>

                <hr>

                <a href="mailto:{{ $inquiry->email }}" class="btn btn-info btn-block">
                    <i class="fas fa-envelope"></i> Envoyer un email
                </a>

                <a href="https://wa.me/{{ $inquiry->phone }}" target="_blank" class="btn btn-success btn-block mt-2">
                    <i class="fab fa-whatsapp"></i> Contacter WhatsApp
                </a>

                @if($inquiry->property)
                    <hr>
                    <a href="{{ route('admin.properties.edit', $inquiry->property) }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-building"></i> Voir le bien
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
