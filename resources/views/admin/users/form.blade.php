@extends('admin.layouts.app')

@section('title', $user->exists ? 'Modifier l\'utilisateur' : 'Ajouter un utilisateur')
@section('header', $user->exists ? 'Modifier l\'utilisateur' : 'Ajouter un utilisateur')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
    <li class="breadcrumb-item active">{{ $user->exists ? 'Modifier' : 'Ajouter' }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}"
              method="POST">
            @csrf
            @if($user->exists)
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nom complet *</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">
                            Mot de passe
                            @if($user->exists)
                                <small class="text-muted">(Laisser vide pour ne pas modifier)</small>
                            @else
                                *
                            @endif
                        </label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                               {{ $user->exists ? '' : 'required' }}>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="role">Rôle *</label>
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Utilisateur</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrateur</option>
                        </select>
                        @error('role')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ $user->exists ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
