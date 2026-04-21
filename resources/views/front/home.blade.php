@extends('front.layouts.app')

@section('title', 'AGEPIF - Agence de Gestion du Patrimoine Immobilier et Foncier - Bamako, Mali')

@section('content')
<!-- Main Slider start -->
<section class="at-main-slider">
    <div class="flexslider">
        <ul class="slides">
            @foreach($slides as $slide)
            <li data-thumb="{{ Storage::url($slide->image) }}">
                <img src="{{ Storage::url($slide->image) }}" alt="{{ $slide->title }}">
                <p class="flex-caption">{{ $slide->title }} <span>{{ $slide->subtitle ?? 'AGEPIF Mali' }}</span></p>
            </li>
            @endforeach
        </ul>
    </div>
</section>
<!-- Main Slider end -->

<!-- Main Search start from here -->
<section class="main-search-field">
    <div class="container">
        <form action="{{ route('properties.index') }}" method="GET">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="at-col-default-mar">
                        <select name="city">
                            <option value="" selected>Localisation</option>
                            <option value="Bamako">Bamako</option>
                            <option value="Kayes">Kayes</option>
                            <option value="Sikasso">Sikasso</option>
                            <option value="Ségou">Ségou</option>
                            <option value="Mopti">Mopti</option>
                            <option value="Gao">Gao</option>
                            <option value="Tombouctou">Tombouctou</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="at-col-default-mar">
                        <select name="transaction_type" class="div-toggle" data-target=".my-info-1">
                            <option value="" selected>Type de transaction</option>
                            <option value="sale">À vendre</option>
                            <option value="rent">À louer</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="at-col-default-mar">
                        <input class="at-input" type="number" name="min_surface" placeholder="Surface min (m²)">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="at-col-default-mar">
                        <input class="at-input" type="number" name="max_surface" placeholder="Surface max (m²)">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="at-col-default-mar">
                        <select name="bedrooms">
                            <option value="" selected>Chambres</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5+</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="at-col-default-mar">
                        <select name="bathrooms">
                            <option value="" selected>Salles de bain</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5+</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="at-col-default-mar">
                        <div class="at-pricing-range">
                            <div class="my-info-1">
                                <div class="acitveon sale">
                                    <label>Prix : </label>
                                    <input type="text" class="amount at-input-price" readonly>
                                    <div class="slider-range"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="at-col-default-mar">
                        <button class="btn btn-default hvr-bounce-to-right" type="submit">Rechercher</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Main Search End -->

<!-- About start from here -->
<section class="at-about-sec">
    <div class="container justify-content-center">
        <div class="row animatedParent animateOnce">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="at-about-col at-col-default-mar">
                    <div class="at-about-title">
                        <h1>AGEPIF<br><span>Agence de Gestion du Patrimoine Immobilier et Foncier</span></h1>
                        <h6>Votre partenaire de confiance au Mali</h6>
                    </div>
                    <p>AGEPIF est une agence spécialisée dans la gestion du patrimoine immobilier et foncier basée à Bamako, Mali. Nous vous accompagnons dans vos projets immobiliers, de la vente à la gestion locative, en passant par le BTP et les forages.</p>
                    <p>Notre mission est de vous offrir un accompagnement global qui simplifie vos projets : accompagnement à la vente, facilitation de l'acquisition, gestion locative, suivi des travaux BTP, conception de plans 2D/3D, réalisation et réhabilitation de pompes et forages.</p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="at-about-col animated fadeInRightShort slow delay-250">
                    <img src="{{ asset('assets/images/about/1.png') }}" alt="À propos AGEPIF Mali">
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
                <h3><span>+223 79 13 13 95</span></h3>
            </div>
        </div>
    </div>
</section>
<!-- Call End -->

<!-- Property start from here -->
<section class="at-property-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="at-sec-title at-sec-title-left">
                    <h2>Nos <span>Biens</span> en Vedette</h2>
                    <div class="at-heading-under-line">
                        <div class="at-heading-inside-line"></div>
                    </div>
                    <p>Découvrez notre sélection de biens d'exception disponibles à la vente et à la location au Mali</p>
                </div>
            </div>
        </div>
        <div class="row animatedParent animateOnce">
            @forelse($featuredProperties as $property)
            <div class="col-md-4 col-sm-6">
                <div class="at-property-item at-col-default-mar animated fadeInUpShort slow">
                    <div class="at-property-img">
                        @php
                            $images = is_array($property->images) ? $property->images : json_decode($property->images, true);
                            $mainImage = ($images && count($images) > 0) ? Storage::url($images[0]) : asset('assets/images/property/1.jpg');
                        @endphp
                        <img src="{{ $mainImage }}" alt="{{ $property->title }}">
                        <div class="at-property-overlayer"></div>
                        <a class="btn btn-default at-property-btn" href="{{ route('properties.show', $property->slug) }}" role="button">Voir détails</a>
                        <h4 class="{{ $property->transaction_type == 'rent' ? 'at-bg-black' : '' }}">{{ $property->transaction_type == 'sale' ? 'À VENDRE' : 'À LOUER' }}</h4>
                        <h5 class="{{ $property->transaction_type == 'rent' ? 'at-bg-black' : '' }}">{{ number_format($property->price, 0, '', ' ') }} FCFA</h5>
                    </div>
                    <div class="at-property-dis">
                        <ul>
                            <li><i class="fa fa-object-group" aria-hidden="true"></i> {{ $property->surface }} m²</li>
                            @if($property->type != 'land')
                                <li><i class="fa fa-bed" aria-hidden="true"></i> {{ $property->bedrooms }}</li>
                                <li><i class="fa fa-bath" aria-hidden="true"></i> {{ $property->bathrooms }}</li>
                            @endif
                        </ul>
                    </div>
                    <div class="at-property-location">
                        <h4><i class="fa fa-home" aria-hidden="true"></i><a href="{{ route('properties.show', $property->slug) }}">{{ Str::limit($property->title, 30) }}</a></h4>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $property->city }}, {{ $property->neighborhood ?? 'Mali' }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>Aucun bien en vedette pour le moment.</p>
            </div>
            @endforelse
        </div>
        <div class="col-md-12 col-sm-12 text-center">
            <a class="btn btn-default hvr-bounce-to-right" href="{{ route('properties.index') }}" role="button">Tous nos biens</a>
        </div>
    </div>
</section>
<!-- Property End -->

<!-- Services Section -->
<section class="at-service-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="at-sec-title">
                    <h2>Nos <span>Services</span></h2>
                    <div class="at-heading-under-line">
                        <div class="at-heading-inside-line"></div>
                    </div>
                    <p>Un accompagnement global pour tous vos projets immobiliers</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="icofont icofont-ui-home"></i>
                    </div>
                    <h4>Vente & Acquisition</h4>
                    <p>Accompagnement à la vente et facilitation de l'acquisition de biens immobiliers.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="icofont icofont-key"></i>
                    </div>
                    <h4>Gestion Locative</h4>
                    <p>Gestion complète de la location et mise en location de vos biens.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="icofont icofont-building-alt"></i>
                    </div>
                    <h4>BTP & Rénovation</h4>
                    <p>Suivi et contrôle des travaux, rénovation et réhabilitation.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="icofont icofont-ruler-pencil"></i>
                    </div>
                    <h4>Conception 2D/3D</h4>
                    <p>Conception de plans 2D et 3D pour vos projets de construction.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="icofont icofont-water-drop"></i>
                    </div>
                    <h4>Forage & Pompe</h4>
                    <p>Réalisation et réhabilitation de pompes et conception de forages.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-service-item">
                    <div class="at-service-icon">
                        <i class="fa fa-calculator"></i>
                    </div>
                    <h4>Estimation</h4>
                    <p>Estimation précise de vos biens immobiliers.</p>
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
                <p>Recevez nos dernières offres et actualités immobilières au Mali</p>
                <form class="input-group" action="#" method="POST">
                    @csrf
                    <input type="email" class="form-control" placeholder="Votre email" required>
                    <div class="input-group-append">
                        <span class="input-group-text at-sub-btn"><button type="submit" class="hvr-bounce-to-right" style="background: none; border: none;">S'ABONNER</button></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Newsletter End -->
@endsection

@push('styles')
<style>
    .at-service-sec {
        padding: 60px 0;
        background: #f8f9fa;
    }
    .at-service-item {
        text-align: center;
        padding: 30px 20px;
        margin-bottom: 30px;
        background: white;
        border-radius: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .at-service-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
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
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #1a2a3a;
    }
    .at-service-item p {
        color: #666;
        line-height: 1.6;
        font-size: 14px;
    }
    .at-sec-title {
        text-align: center;
        margin-bottom: 50px;
    }
    .at-sec-title h2 {
        font-size: 32px;
        font-weight: 700;
        color: #1a2a3a;
    }
    .at-sec-title h2 span {
        color: #ffd700;
    }
    .at-heading-under-line {
        width: 60px;
        height: 3px;
        background: #ffd700;
        margin: 15px auto;
        position: relative;
    }
    .at-heading-inside-line {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Flexslider initialization
        if ($('.flexslider').length > 0) {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails",
                directionNav: true,
                slideshowSpeed: 5000,
                animationSpeed: 600
            });
        }

        // Price range slider
        if ($(".slider-range").length > 0) {
            $(".slider-range").slider({
                range: true,
                min: 0,
                max: 500000000,
                values: [0, 500000000],
                slide: function(event, ui) {
                    $(".amount").val(ui.values[0] + " FCFA - " + ui.values[1] + " FCFA");
                }
            });
            $(".amount").val($(".slider-range").slider("values", 0) + " FCFA - " + $(".slider-range").slider("values", 1) + " FCFA");
        }
    });
</script>
@endpush
