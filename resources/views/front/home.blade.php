@extends('front.layouts.app')

@section('title', 'AGEPIF - Agence Immobilière de Prestige en Côte d\'Ivoire')

@section('content')
<!-- Main Slider start -->
<section class="at-main-slider">
    <div class="flexslider">
        <ul class="slides">
            @foreach($slides as $slide)
            <li data-thumb="{{ Storage::url($slide->image) }}">
                <img src="{{ Storage::url($slide->image) }}" alt="{{ $slide->title }}">
                <p class="flex-caption">{{ $slide->title }} <span>{{ $slide->subtitle ?? 'AGEPIF' }}</span></p>
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
                            <option value="Abidjan">Abidjan</option>
                            <option value="Yamoussoukro">Yamoussoukro</option>
                            <option value="Bouaké">Bouaké</option>
                            <option value="San Pedro">San Pedro</option>
                            <option value="Daloa">Daloa</option>
                            <option value="Korhogo">Korhogo</option>
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
                        <h1>AGEPIF <br><span>Immobilier de Prestige</span></h1>
                        <h6>Votre partenaire de confiance</h6>
                    </div>
                    <p>AGEPIF est une agence immobilière de premier plan en Côte d'Ivoire. Forts de notre expertise et de notre professionnalisme, nous accompagnons nos clients dans tous leurs projets immobiliers.</p>
                    <p>Notre mission est de vous offrir un service personnalisé et de qualité, que vous soyez à la recherche d'un bien à acheter, à louer, ou que vous souhaitiez vendre ou mettre en location votre propriété.</p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
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
                <h3><span>+225 01 23 45 67</span></h3>
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
                    <p>Découvrez notre sélection de biens d'exception disponibles à la vente et à la location</p>
                </div>
            </div>
        </div>
        <div class="row animatedParent animateOnce">
            @foreach($featuredProperties as $property)
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
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $property->city }}, {{ $property->neighborhood ?? 'Côte d\'Ivoire' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-12 col-sm-12 text-center">
            <a class="btn btn-default hvr-bounce-to-right" href="{{ route('properties.index') }}" role="button">Tous nos biens</a>
        </div>
    </div>
</section>
<!-- Property End -->

<!-- Blog start from here -->
<section class="at-blog-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="at-sec-title at-sec-title-left">
                    <h2>Notre <span>Blog</span></h2>
                    <div class="at-heading-under-line">
                        <div class="at-heading-inside-line"></div>
                    </div>
                    <p>Conseils et actualités du marché immobilier en Côte d'Ivoire</p>
                </div>
            </div>
        </div>
        <div class="row animatedParent animateOnce">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-blog-box at-col-default-mar animated fadeInUpShort slow">
                    <div class="at-blog-img">
                        <img src="{{ asset('assets/images/blog/1.jpg') }}" alt="Conseils immobiliers">
                        <div class="at-blog-date">
                            <ul>
                                <li><i class="icofont icofont-businessman"></i><a href="#">AGEPIF</a></li>
                                <li><i class="icofont icofont-calendar"></i><a href="#">{{ date('F d, Y') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="at-blog-content">
                        <h4><a href="#">Comment acheter un bien immobilier en Côte d'Ivoire</a></h4>
                        <p>Guide complet pour les acheteurs : les étapes à suivre, les documents nécessaires et les pièges à éviter.</p>
                        <a class="btn btn-default hvr-bounce-to-right" href="#" role="button">Lire la suite</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-blog-box at-col-default-mar animated fadeInUpShort slow delay-250">
                    <div class="at-blog-img">
                        <img src="{{ asset('assets/images/blog/2.jpg') }}" alt="Location immobilière">
                        <div class="at-blog-date">
                            <ul>
                                <li><i class="icofont icofont-businessman"></i><a href="#">AGEPIF</a></li>
                                <li><i class="icofont icofont-calendar"></i><a href="#">{{ date('F d, Y', strtotime('-15 days')) }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="at-blog-content">
                        <h4><a href="#">Les avantages de la location meublée</a></h4>
                        <p>Découvrez pourquoi la location meublée est de plus en plus prisée par les investisseurs et les locataires.</p>
                        <a class="btn btn-default hvr-bounce-to-right" href="#" role="button">Lire la suite</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="at-blog-box at-col-default-mar animated fadeInUpShort slow delay-500">
                    <div class="at-blog-img">
                        <img src="{{ asset('assets/images/blog/3.jpg') }}" alt="Investissement immobilier">
                        <div class="at-blog-date">
                            <ul>
                                <li><i class="icofont icofont-businessman"></i><a href="#">AGEPIF</a></li>
                                <li><i class="icofont icofont-calendar"></i><a href="#">{{ date('F d, Y', strtotime('-30 days')) }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="at-blog-content">
                        <h4><a href="#">Investir dans l'immobilier : les clés du succès</a></h4>
                        <p>Les meilleures stratégies pour réussir votre investissement immobilier en Côte d'Ivoire.</p>
                        <a class="btn btn-default hvr-bounce-to-right" href="#" role="button">Lire la suite</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End -->

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
                        <span class="input-group-text at-sub-btn"><button type="submit" class="hvr-bounce-to-right" style="background: none; border: none;">S'ABONNER</button></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Newsletter End -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Flexslider initialization
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails",
            directionNav: true,
            slideshowSpeed: 5000,
            animationSpeed: 600
        });

        // Price range slider
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
    });
</script>
@endpush
