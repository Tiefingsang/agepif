@extends('front.layouts.app')

@section('title', 'Contact - AGEPIF Immobilier')

@section('content')
<!-- Inner page heading start -->
<section id="at-inner-title-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="at-inner-title-box">
                    <h2>Contactez-nous</h2>
                    <p><a href="{{ route('home') }}">Accueil</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="#">Contact</a>
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <img src="{{ asset('assets/images/title.png') }}" alt="AGEPIF">
            </div>
        </div>
    </div>
</section>
<!-- Inner page heading end -->

<!-- Contact Start from here -->
<section class="at-contact-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="at-contact-form at-col-default-mar">

                    <!-- Messages d'alerte -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #d4edda; border-left: 4px solid #28a745;">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check-circle fa-2x text-success me-3"></i>
                                <div>
                                    <strong class="text-success">Succès !</strong><br>
                                    {{ session('success') }}
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: #f8d7da; border-left: 4px solid #dc3545;">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-exclamation-circle fa-2x text-danger me-3"></i>
                                <div>
                                    <strong class="text-danger">Erreur !</strong><br>
                                    {{ session('error') }}
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: #f8d7da; border-left: 4px solid #dc3545;">
                            <div class="d-flex align-items-start">
                                <i class="fa fa-exclamation-triangle fa-2x text-danger me-3"></i>
                                <div>
                                    <strong class="text-danger">Veuillez corriger les erreurs suivantes :</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li><i class="fa fa-times-circle text-danger"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Formulaire de contact -->
                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Votre nom" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Votre email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" placeholder="Sujet" value="{{ old('subject', 'Demande de contact') }}" required>
                        @error('subject')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Votre téléphone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="5" placeholder="Votre message" required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        <button class="btn btn-default hvr-bounce-to-right" type="submit" id="submitBtn">
                            <i class="fa fa-paper-plane"></i> Envoyer le message
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="at-info-box at-col-default-mar">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <p>contact@agepif.com</p>
                </div>
                <div class="at-info-box at-col-default-mar">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <p>+225 01 23 45 67</p>
                </div>
                <div class="at-info-box at-col-default-mar">
                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                    <p>+225 01 23 45 67</p>
                </div>
                <div class="at-info-box at-col-default-mar">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <p>Abidjan, Côte d'Ivoire</p>
                </div>
                <div class="at-info-box at-col-default-mar">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <p>Lundi - Vendredi: 8h00 - 18h00<br>Samedi: 9h00 - 13h00</p>
                </div>

                <!-- Carte Google Maps -->
                <div class="at-info-box at-col-default-mar">
                    <iframe
                        src="https://maps.google.com/maps?q=Abidjan,%20C%C3%B4te%20d'Ivoire&output=embed"
                        width="100%"
                        height="250"
                        style="border:0; border-radius: 8px;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact end -->
@endsection

@push('styles')
<style>
    .at-contact-form .form-control {
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #e0e0e0;
        padding: 12px 15px;
    }
    .at-contact-form .form-control:focus {
        border-color: #ffd700;
        box-shadow: none;
    }
    .at-contact-form .btn {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        font-weight: 600;
    }
    .at-info-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: center;
        transition: all 0.3s ease;
    }
    .at-info-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .at-info-box i {
        font-size: 40px;
        color: #ffd700;
        margin-bottom: 15px;
        display: block;
    }
    .at-info-box p {
        margin: 0;
        font-size: 16px;
        color: #333;
    }
    .alert {
        padding: 12px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }
    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }
    .invalid-feedback {
        display: block;
        font-size: 12px;
        color: #dc3545;
        margin-top: -10px;
        margin-bottom: 10px;
    }
    .close {
        float: right;
        font-size: 20px;
        font-weight: bold;
        line-height: 1;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        opacity: .5;
        background: none;
        border: none;
        cursor: pointer;
    }
    .close:hover {
        opacity: .75;
    }
    .me-3 {
        margin-right: 15px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Gestionnaire d'envoi du formulaire
        $('form').on('submit', function() {
            var btn = $('#submitBtn');
            var originalText = btn.html();

            // Désactiver le bouton et afficher le chargement
            btn.prop('disabled', true);
            btn.html('<i class="fa fa-spinner fa-spin"></i> Envoi en cours...');

            // Réactiver le bouton après 5 secondes (en cas de timeout)
            setTimeout(function() {
                btn.prop('disabled', false);
                btn.html(originalText);
            }, 5000);
        });

        // Auto-fermeture des alertes après 5 secondes
        if ($('.alert').length > 0) {
            setTimeout(function() {
                $('.alert').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 5000);
        }
    });
</script>
@endpush
