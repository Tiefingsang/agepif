@extends('front.layouts.app')

@section('title', $property->title . ' - AGEPIF Mali')

@section('content')
<!-- Inner page heading start -->
<section id="at-inner-title-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="at-inner-title-box">
                    <h2>DÉTAIL DU BIEN</h2>
                    <p><a href="{{ route('home') }}">Accueil</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="{{ route('properties.index') }}">Nos biens</a></p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <img src="{{ asset('assets/images/title.png') }}" alt="AGEPIF Mali">
            </div>
        </div>
    </div>
</section>
<!-- Inner page heading end -->

<!-- Property start from here -->
<section class="at-property-sec at-property-right-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="at-property-details-col">

                    <!-- Carousel -->
                    <div id="carouselExampleDark" class="carousel carousel-dark slide">
                        <div class="carousel-inner">
                            @php
                                $images = is_array($property->images) ? $property->images : json_decode($property->images, true);
                                if(!$images || count($images) == 0) {
                                    $images = ['property-placeholder.jpg'];
                                }
                            @endphp
                            @foreach($images as $index => $image)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="10000">
                                <img src="{{ Storage::url($image) }}" alt="{{ $property->title }}">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $property->title }}</h5>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="carousel-indicators">
                            @foreach($images as $index => $image)
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $index }}"
                                    class="{{ $index == 0 ? 'active' : '' }}"
                                    aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}">
                            </button>
                            @endforeach
                        </div>
                    </div>
                    <!-- End Carousel -->

                    <!-- Description -->
                    <p>{{ $property->description }}</p>
                    @if($property->long_description)
                        <p>{{ $property->long_description }}</p>
                    @endif

                    <!-- Property Features -->
                    <div class="at-sec-title at-sec-title-left">
                        <h2>Caractéristiques <span>du bien</span></h2>
                        <div class="at-heading-under-line">
                            <div class="at-heading-inside-line"></div>
                        </div>
                        <p>Découvrez les caractéristiques détaillées de ce bien immobilier au Mali</p>
                    </div>

                    <div class="row at-property-features">
                        <div class="col-md-6 clearfix">
                            <ul>
                                <li>Référence : <span class="pull-right">#{{ $property->id }}</span></li>
                                <li>Surface totale : <span class="pull-right">{{ $property->surface }} m²</span></li>
                                @if($property->type != 'land')
                                    <li>Chambres : <span class="pull-right">{{ $property->bedrooms }}</span></li>
                                    <li>Salles de bain : <span class="pull-right">{{ $property->bathrooms }}</span></li>
                                    <li>Garages : <span class="pull-right">{{ $property->garage }}</span></li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Statut : <span class="pull-right">{{ $property->transaction_type == 'sale' ? 'À VENDRE' : 'À LOUER' }}</span></li>
                                <li>Type : <span class="pull-right">{{ ucfirst($property->type) }}</span></li>
                                <li>Catégorie : <span class="pull-right">{{ $property->category->name ?? 'N/A' }}</span></li>
                                @if($property->available_from)
                                    <li>Disponible à partir : <span class="pull-right">{{ \Carbon\Carbon::parse($property->available_from)->format('d/m/Y') }}</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Features List -->
                    @if($property->features)
                        @php
                            $features = is_array($property->features) ? $property->features : json_decode($property->features, true);
                        @endphp
                        @if($features && count($features) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Équipements inclus :</h4>
                                    @foreach($features as $feature)
                                        <span class="badge bg-info m-1 p-2">{{ ucfirst($feature) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- Location -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>Localisation</h4>
                            <p><i class="fa fa-map-marker"></i> {{ $property->address }}, {{ $property->city }}, {{ $property->country ?? 'Mali' }}</p>
                            <div class="at-property-map">
                                <iframe
                                    src="https://maps.google.com/maps?q={{ urlencode($property->address . ', ' . $property->city . ', Mali') }}&output=embed"
                                    width="100%"
                                    height="300"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="at-form-area">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="contact_form" action="{{ route('contact.send') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control" type="text" name="name" placeholder="Votre nom" required>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control" type="email" name="email" placeholder="Votre email" required>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <input class="form-control" type="tel" name="phone" placeholder="Votre téléphone" required>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <textarea class="form-control" name="message" rows="5" placeholder="Votre message" required>Je suis intéressé par le bien: {{ $property->title }}</textarea>
                                            <button class="btn btn-default hvr-bounce-to-right" type="submit">ENVOYER</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="at-sidebar at-col-default-mar">

                    <!-- Price & Contact -->
                    <div class="at-sidebar-search at-sidebar-mar">
                        <div class="text-center">
                            <h3 class="text-primary">{{ number_format($property->price, 0, '', ' ') }} FCFA</h3>
                            @if($property->transaction_type == 'rent')
                                <p class="text-muted">/ mois</p>
                            @endif
                            <hr>
                            <a href="https://wa.me/22379131395?text=Je suis intéressé par le bien: {{ $property->title }}" class="btn btn-success btn-block" target="_blank">
                                <i class="fa fa-whatsapp"></i> Contacter via WhatsApp
                            </a>
                            <a href="tel:+22379131395" class="btn btn-primary btn-block mt-2">
                                <i class="fa fa-phone"></i> Appeler maintenant
                            </a>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="at-sidebar-search at-sidebar-mar">
                        <form action="{{ route('properties.index') }}" method="GET">
                            <div class="input-group">
                                <input placeholder="Rechercher un bien..." class="form-control" name="search" type="text">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <!-- Categories -->
                    <div class="at-categories clearfix">
                        <h3 class="at-sedebar-title">Catégories</h3>
                        <ul>
                            @php
                                $categories = App\Models\Category::where('is_active', true)->get();
                            @endphp
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ route('properties.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                <span class="pull-right">({{ $category->properties->where('status', 'published')->count() }})</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Latest Properties -->
                    <div class="at-latest-news">
                        <h3 class="at-sedebar-title">Derniers biens</h3>
                        <ul>
                            @php
                                $latestProperties = App\Models\Property::published()->latest()->take(3)->get();
                            @endphp
                            @foreach($latestProperties as $latest)
                            <li>
                                <div class="at-news-item">
                                    @php
                                        $latestImages = is_array($latest->images) ? $latest->images : json_decode($latest->images, true);
                                        $latestImage = ($latestImages && count($latestImages) > 0) ? Storage::url($latestImages[0]) : asset('assets/images/blog/s1.jpg');
                                    @endphp
                                    <img src="{{ $latestImage }}" alt="{{ $latest->title }}">
                                    <h4><a href="{{ route('properties.show', $latest->slug) }}">{{ Str::limit($latest->title, 30) }}</a></h4>
                                    <p>{{ number_format($latest->price, 0, '', ' ') }} FCFA</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Tags populaires -->
                    <div class="at-sidebar-tags">
                        <h3 class="at-sedebar-title">Tags populaires</h3>
                        <a href="{{ route('properties.index', ['type' => 'house']) }}">Maisons</a>
                        <a href="{{ route('properties.index', ['type' => 'apartment']) }}">Appartements</a>
                        <a href="{{ route('properties.index', ['type' => 'land']) }}">Terrains</a>
                        <a href="{{ route('properties.index', ['transaction_type' => 'sale']) }}">Vente</a>
                        <a href="{{ route('properties.index', ['transaction_type' => 'rent']) }}">Location</a>
                        <a href="{{ route('properties.index', ['city' => 'Bamako']) }}">Bamako</a>
                        <a href="{{ route('properties.index', ['city' => 'Kayes']) }}">Kayes</a>
                        <a href="{{ route('properties.index', ['city' => 'Sikasso']) }}">Sikasso</a>
                    </div>

                    <!-- AGEPIF Preview -->
                    <div class="at-preview">
                        <h3 class="at-sedebar-title">AGEPIF Mali</h3>
                        <img src="{{ asset('assets/images/property/preview.jpg') }}" alt="AGEPIF Immobilier Mali">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .at-property-features ul {
        list-style: none;
        padding: 0;
    }
    .at-property-features ul li {
        padding: 8px 0;
        border-bottom: 1px solid #e0e0e0;
    }
    .at-property-features ul li .pull-right {
        float: right;
        font-weight: 600;
        color: #ffd700;
    }
    .badge.bg-info {
        background-color: #17a2b8;
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 12px;
    }
    .carousel-inner img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    .carousel-caption {
        background: rgba(0,0,0,0.6);
        border-radius: 10px;
        padding: 10px;
    }
    .carousel-caption h5 {
        color: #ffd700;
        font-size: 20px;
    }
    .carousel-indicators button {
        width: 12px !important;
        height: 12px !important;
        border-radius: 50%;
        margin: 0 5px;
    }
    .at-property-map {
        margin-top: 15px;
        border-radius: 8px;
        overflow: hidden;
    }
    .btn-block {
        width: 100%;
        margin-bottom: 10px;
    }
    .at-latest-news .at-news-item {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
    }
    .at-latest-news .at-news-item img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 5px;
    }
    .at-latest-news .at-news-item h4 {
        font-size: 14px;
        margin: 0 0 5px;
    }
    .at-latest-news .at-news-item p {
        font-size: 12px;
        color: #ffd700;
        margin: 0;
    }
    .at-sidebar-tags a {
        display: inline-block;
        padding: 5px 12px;
        margin: 0 5px 8px 0;
        background: #f8f9fa;
        border-radius: 3px;
        color: #333;
        font-size: 12px;
        transition: all 0.3s ease;
    }
    .at-sidebar-tags a:hover {
        background: #ffd700;
        color: #1a2a3a;
    }
    .at-preview img {
        width: 100%;
        border-radius: 8px;
    }
</style>
@endpush
