@extends('front.layouts.app')

@section('title', 'Nos services - AGEPIF Immobilier')

@section('content')
<!-- Inner page heading start -->
<section id="at-inner-title-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="at-inner-title-box">
                    <h2>Nos Services</h2>
                    <p><a href="{{ route('home') }}">Accueil</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="#">Services</a>
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

<!-- Services start from here -->
<section class="at-service-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="at-service-content">
                    <h2>Des services immobiliers<br> <span>d'exception pour vous</span></h2>
                    <p>AGEPIF vous offre une gamme complète de services immobiliers adaptés à vos besoins. Que vous soyez acquéreur, vendeur ou investisseur, notre équipe d'experts vous accompagne à chaque étape de votre projet.</p>
                    <p>Notre engagement : vous offrir un service personnalisé, transparent et efficace. Nous mettons notre expertise et notre réseau à votre disposition pour concrétiser vos projets immobiliers dans les meilleures conditions.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="at-service-content">
                    <img src="{{ asset('assets/images/service.jpg') }}" alt="Services AGEPIF">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="icofont icofont-ui-home"></i>
                    </div>
                    <h4>Vente de biens immobiliers</h4>
                    <p>Nous vous accompagnons dans la vente de votre bien avec une estimation juste, une large diffusion et un suivi personnalisé jusqu'à la signature.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="icofont icofont-key"></i>
                    </div>
                    <h4>Location de biens</h4>
                    <p>Gestion locative complète : recherche de locataires, rédaction de baux, encaissement des loyers et suivi des paiements.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="icofont icofont-police-car-alt-1"></i>
                    </div>
                    <h4>Sécurité des transactions</h4>
                    <p>Transactions sécurisées et conformes à la législation. Nous garantissons une totale transparence et sécurité.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="icofont icofont-chart-line"></i>
                    </div>
                    <h4>Conseil en investissement</h4>
                    <p>Analyse du marché, étude de rentabilité et accompagnement pour vos investissements immobiliers.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="icofont icofont-lawyer-alt-2"></i>
                    </div>
                    <h4>Assistance juridique</h4>
                    <p>Accompagnement juridique complet pour vos transactions : vérification des titres, rédaction des contrats.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="icofont icofont-estate"></i>
                    </div>
                    <h4>Estimation gratuite</h4>
                    <p>Estimation gratuite et sans engagement de votre bien par nos experts immobiliers.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services End -->

<!-- Newsletter start from here -->
<section class="at-newsletter-sec jarallax at-over-layer-black">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-8">
                <h2>Newsletter <span>AGEPIF</span></h2>
                <p>Recevez nos dernières offres et actualités immobilières</p>
                <form class="input-group" action="#" method="POST">
                    @csrf
                    <input type="email" class="form-control" placeholder="Votre email" required>
                    <div class="input-group-append">
                        <span class="input-group-text at-sub-btn"><button type="submit" class="hvr-bounce-to-right" style="background: none; border: none; color: white;">S'ABONNER</button></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Newsletter end -->
@endsection

@push('styles')
<style>
    .at-service-sec {
        padding: 60px 0;
    }
    .at-service-content {
        margin-bottom: 30px;
    }
    .at-service-content h2 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #1a2a3a;
    }
    .at-service-content h2 span {
        color: #ffd700;
    }
    .at-service-content p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 15px;
    }
    .at-service-content img {
        width: 100%;
        border-radius: 10px;
    }
    .at-service-item {
        text-align: center;
        padding: 30px 20px;
        margin-bottom: 30px;
        background: #f8f9fa;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .at-service-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        background: white;
    }
    .at-service-icon {
        width: 80px;
        height: 80px;
        line-height: 80px;
        text-align: center;
        background: #ffd700;
        border-radius: 50%;
        margin: 0 auto 20px;
        transition: all 0.3s ease;
    }
    .at-service-item:hover .at-service-icon {
        background: #1a2a3a;
    }
    .at-service-icon i {
        font-size: 40px;
        color: #1a2a3a;
    }
    .at-service-item:hover .at-service-icon i {
        color: #ffd700;
    }
    .at-service-item h4 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #1a2a3a;
        text-transform: uppercase;
    }
    .at-service-item p {
        color: #666;
        line-height: 1.6;
    }
    .at-newsletter-sec {
        padding: 60px 0;
        background-attachment: fixed;
    }
    .at-newsletter-sec h2 {
        text-align: center;
        color: white;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .at-newsletter-sec h2 span {
        color: #ffd700;
    }
    .at-newsletter-sec p {
        text-align: center;
        color: #ccc;
        margin-bottom: 30px;
    }
    .at-newsletter-sec .input-group {
        display: flex;
    }
    .at-newsletter-sec .form-control {
        height: 50px;
        border-radius: 5px 0 0 5px;
        border: none;
        padding: 0 15px;
    }
    .at-sub-btn {
        background: #ffd700;
        border-radius: 0 5px 5px 0;
        padding: 0;
        cursor: pointer;
    }
    .at-sub-btn button,
    .at-sub-btn a {
        display: inline-block;
        padding: 12px 25px;
        color: #1a2a3a;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .at-sub-btn button:hover,
    .at-sub-btn a:hover {
        background: #1a2a3a;
        color: #ffd700;
        border-radius: 0 5px 5px 0;
    }
</style>
@endpush
