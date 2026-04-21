@extends('front.layouts.app')

@section('title', 'À propos - AGEPIF | Agence de Gestion du Patrimoine Immobilier et Foncier - Mali')

@section('content')
<!-- Inner page heading start -->
<section id="at-inner-title-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="at-inner-title-box">
                    <h2>À propos d'AGEPIF</h2>
                    <p><a href="{{ route('home') }}">Accueil</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="#">À propos</a>
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <img src="{{ asset('assets/images/title.png') }}" alt="AGEPIF Mali">
            </div>
        </div>
    </div>
</section>
<!-- Inner page heading end -->

<!-- About start from here -->
<section class="at-about-sec">
    <div class="container justify-content-center">
        <div class="row animatedParent animateOnce">
            <div class="col-xl-7 col-lg-6 col-md-12">
                <div class="at-about-col at-col-default-mar">
                    <div class="at-about-title">
                        <h1>AGEPIF<br> <span>Agence de Gestion du Patrimoine Immobilier et Foncier</span></h1>
                        <h6>Votre partenaire de confiance au Mali</h6>
                    </div>
                    <p>AGEPIF est une agence spécialisée dans la gestion du patrimoine immobilier et foncier basée à Bamako, Mali. Notre expertise couvre l'accompagnement à la vente, la facilitation de l'acquisition, la gestion locative, ainsi que les travaux de BTP et la conception de forages.</p>
                    <br>
                    <p>Notre mission est de vous offrir un accompagnement global qui simplifie vos projets immobiliers. Nous mettons notre expérience et notre réseau à votre service pour concrétiser vos projets dans les meilleures conditions, avec transparence et professionnalisme.</p>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-6">
                <div class="at-about-col animated fadeInRightShort slow delay-250">
                    <img src="{{ asset('assets/images/about/1.png') }}" alt="AGEPIF Mali - À propos">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About End -->

<!-- Call start from here -->
<section class="at-Call-sec jarallax at-over-layer-black">
    <div class="at-Call-both-side clearfix">
        <div class="at-Call-left">
            <div class="at-inside-Call">
                <h5>RÉSERVEZ VOTRE</h5>
                <h2>APPARTEMENT OU MAISON</h2>
            </div>
        </div>
        <div class="at-Call-right">
            <div class="at-Call-right-inside">
                <h2>Nous sommes prêts à vous recevoir</h2>
                <div class="at-short-line"></div>
                <h3>APPELER NOUS : <span>+223 79 13 13 95</span></h3>
            </div>
        </div>
    </div>
</section>
<!-- Call End -->

<!-- Nos missions start from here -->
<section class="at-plan-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="at-sec-title at-sec-title-left">
                    <h2>Nos <span>missions</span></h2>
                    <div class="at-heading-under-line">
                        <div class="at-heading-inside-line"></div>
                    </div>
                    <p>Une agence immobilière offre un accompagnement global qui simplifie vos projets</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="at-plan-box at-col-default-mar">
                    <ul>
                        <li><i class="fa fa-check-circle"></i> Accompagnement à la vente d'un bien immobilier</li>
                        <li><i class="fa fa-check-circle"></i> Facilitation de l'acquisition d'un bien immobilier</li>
                        <li><i class="fa fa-check-circle"></i> Gestion de la location et mise en location</li>
                        <li><i class="fa fa-check-circle"></i> Estimation immobilière précise</li>
                        <li><i class="fa fa-check-circle"></i> Recherche de biens sur mesure</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="at-plan-box at-col-default-mar">
                    <ul>
                        <li><i class="fa fa-check-circle"></i> Suivi et contrôle des travaux BTP</li>
                        <li><i class="fa fa-check-circle"></i> Rénovation et réhabilitation</li>
                        <li><i class="fa fa-check-circle"></i> Conception de plans 2D et 3D</li>
                        <li><i class="fa fa-check-circle"></i> Élaboration de devis</li>
                        <li><i class="fa fa-check-circle"></i> Conseil juridique et fiscal</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="at-plan-box at-col-default-mar">
                    <ul>
                        <li><i class="fa fa-check-circle"></i> Réalisation et réhabilitation de pompes</li>
                        <li><i class="fa fa-check-circle"></i> Conception de forages</li>
                        <li><i class="fa fa-check-circle"></i> Assistance administrative</li>
                        <li><i class="fa fa-check-circle"></i> Suivi des transactions</li>
                        <li><i class="fa fa-check-circle"></i> Service personnalisé de qualité</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Nos missions End -->

<!-- Newsletter start from here -->
<section class="at-newsletter-sec jarallax at-over-layer-black">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-8">
                <h2>Newsletter <span>AGEPIF</span></h2>
                <p>Recevez nos dernières offres et actualités immobilières au Mali</p>
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
    .at-plan-box ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .at-plan-box ul li {
        padding: 12px 0;
        border-bottom: 1px solid #e0e0e0;
        font-size: 15px;
        display: flex;
        align-items: center;
    }
    .at-plan-box ul li i {
        margin-right: 12px;
        color: #ffd700;
        font-size: 16px;
        width: 20px;
    }
    .at-plan-box ul li:last-child {
        border-bottom: none;
    }
    .at-Call-right-inside h3 span {
        color: #ffd700;
    }
    .at-sec-title-left {
        text-align: left;
        margin-bottom: 30px;
    }
    .at-sec-title-left .at-heading-under-line {
        margin: 15px 0 20px;
    }
    .at-about-title h1 {
        font-size: 36px;
        font-weight: 700;
        color: #1a2a3a;
        margin-bottom: 15px;
    }
    .at-about-title h1 span {
        color: #ffd700;
    }
    .at-about-title h6 {
        color: #666;
        font-size: 16px;
        margin-bottom: 20px;
    }
    .at-about-col p {
        color: #555;
        line-height: 1.8;
    }
</style>
@endpush
