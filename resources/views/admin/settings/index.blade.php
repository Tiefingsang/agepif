@extends('admin.layouts.app')

@section('title', 'Paramètres')
@section('header', 'Paramètres du site')
@section('breadcrumb')
    <li class="breadcrumb-item active">Paramètres</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <h4 class="mb-3">Informations générales</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="site_name">Nom du site</label>
                        <input type="text" name="site_name" id="site_name" class="form-control"
                               value="{{ old('site_name', $settings['site_name']) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="site_description">Description du site</label>
                        <input type="text" name="site_description" id="site_description" class="form-control"
                               value="{{ old('site_description', $settings['site_description']) }}">
                    </div>
                </div>
            </div>

            <h4 class="mb-3 mt-4">Informations de contact</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_email">Email de contact</label>
                        <input type="email" name="contact_email" id="contact_email" class="form-control"
                               value="{{ old('contact_email', $settings['contact_email']) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_phone">Téléphone</label>
                        <input type="text" name="contact_phone" id="contact_phone" class="form-control"
                               value="{{ old('contact_phone', $settings['contact_phone']) }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_whatsapp">WhatsApp (numéro sans +)</label>
                        <input type="text" name="contact_whatsapp" id="contact_whatsapp" class="form-control"
                               value="{{ old('contact_whatsapp', $settings['contact_whatsapp']) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Adresse</label>
                        <input type="text" name="address" id="address" class="form-control"
                               value="{{ old('address', $settings['address']) }}">
                    </div>
                </div>
            </div>

            <h4 class="mb-3 mt-4">Réseaux sociaux</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="facebook_url">Facebook</label>
                        <input type="url" name="facebook_url" id="facebook_url" class="form-control"
                               value="{{ old('facebook_url', $settings['facebook_url']) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="twitter_url">Twitter</label>
                        <input type="url" name="twitter_url" id="twitter_url" class="form-control"
                               value="{{ old('twitter_url', $settings['twitter_url']) }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="instagram_url">Instagram</label>
                        <input type="url" name="instagram_url" id="instagram_url" class="form-control"
                               value="{{ old('instagram_url', $settings['instagram_url']) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="linkedin_url">LinkedIn</label>
                        <input type="url" name="linkedin_url" id="linkedin_url" class="form-control"
                               value="{{ old('linkedin_url', $settings['linkedin_url']) }}">
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer les paramètres
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
