@extends('front.layouts.app')

@section('title', 'À propos - AGEPIF Immobilier')

@section('content')
<!-- Inner page heading start -->
<section id="at-inner-title-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="at-inner-title-box">
                    <h2>À propos</h2>
                    <p><a href="{{ route('home') }}">Accueil</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="#">À propos</a>
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

<!-- About start from here -->
<section class="at-about-sec">
    <div class="container justify-content-center">
        <div class="row animatedParent animateOnce">
            <div class="col-xl-7 col-lg-6 col-md-12">
                <div class="at-about-col at-col-default-mar">
                    <div class="at-about-title">
                        <h1>AGEPIF<br> <span>Immobilier de Prestige</span></h1>
                        <h6>Votre partenaire de confiance</h6>
                    </div>
                    <p>AGEPIF est une agence immobilière de premier plan en Côte d'Ivoire. Forts de notre expertise et de notre professionnalisme, nous accompagnons nos clients dans tous leurs projets immobiliers, que ce soit pour l'achat, la vente ou la location de biens.</p>
                    <br>
                    <p>Notre mission est de vous offrir un service personnalisé et de qualité, avec une transparence totale et une recherche constante de la satisfaction client. Nous mettons notre expérience et notre réseau à votre service pour concrétiser vos projets immobiliers dans les meilleures conditions.</p>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-6">
                <div class="at-about-col animated fadeInRightShort slow delay-250">
                    <img src="{{ asset('assets/images/about/1.png') }}" alt="À propos AGEPIF">
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
                <h3>APPELER NOUS : <span>+225 01 23 45 67</span></h3>
            </div>
        </div>
    </div>
</section>
<!-- Call End -->

<!-- Nos valeurs / Plan start from here -->
<section class="at-plan-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="at-sec-title at-sec-title-left">
                    <h2>Nos <span>valeurs</span></h2>
                    <div class="at-heading-under-line">
                        <div class="at-heading-inside-line"></div>
                    </div>
                    <p>AGEPIF repose sur des valeurs fondamentales qui guident notre action au quotidien</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="at-plan-box at-col-default-mar">
                    <ul>
                        <li><i class="fa fa-check-circle text-success"></i> Professionnalisme et expertise</li>
                        <li><i class="fa fa-check-circle text-success"></i> Transparence totale</li>
                        <li><i class="fa fa-check-circle text-success"></i> Écoute et accompagnement</li>
                        <li><i class="fa fa-check-circle text-success"></i> Réactivité et efficacité</li>
                        <li><i class="fa fa-check-circle text-success"></i> Confiance et loyauté</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="at-plan-box at-col-default-mar">
                    <ul>
                        <li><i class="fa fa-check-circle text-success"></i> Innovation et modernité</li>
                        <li><i class="fa fa-check-circle text-success"></i> Respect des engagements</li>
                        <li><i class="fa fa-check-circle text-success"></i> Service personnalisé</li>
                        <li><i class="fa fa-check-circle text-success"></i> Qualité et excellence</li>
                        <li><i class="fa fa-check-circle text-success"></i> Passion du métier</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="at-col-default-mar">
                    <img src="{{ asset('assets/images/meeting.jpg') }}" alt="AGEPIF - Notre équipe">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Nos valeurs End -->

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
    .at-plan-box ul {
        list-style: none;
        padding: 0;
    }
    .at-plan-box ul li {
        padding: 10px 0;
        border-bottom: 1px solid #e0e0e0;
        font-size: 15px;
    }
    .at-plan-box ul li i {
        margin-right: 10px;
        color: #ffd700;
    }
    .text-success {
        color: #ffd700 !important;
    }
    .at-Call-right-inside h3 span {
        color: #ffd700;
    }
</style>
@endpush
