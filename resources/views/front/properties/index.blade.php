@extends('front.layouts.app')

@section('title', 'Nos biens immobiliers - AGEPIF')

@section('content')
<!-- Inner page heading start -->
<section id="at-inner-title-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="at-inner-title-box">
                    <h2>Nos Biens Immobiliers</h2>
                    <p><a href="{{ route('home') }}">Accueil</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="#">Nos biens</a>
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

<!-- Search Filters -->
<section class="at-search-filters">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="at-filter-box">
                    <form method="GET" action="{{ route('properties.index') }}">
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <select name="transaction_type" class="form-control">
                                    <option value="">Transaction</option>
                                    <option value="sale" {{ request('transaction_type') == 'sale' ? 'selected' : '' }}>À vendre</option>
                                    <option value="rent" {{ request('transaction_type') == 'rent' ? 'selected' : '' }}>À louer</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <select name="type" class="form-control">
                                    <option value="">Type de bien</option>
                                    <option value="house" {{ request('type') == 'house' ? 'selected' : '' }}>Maison</option>
                                    <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Appartement</option>
                                    <option value="land" {{ request('type') == 'land' ? 'selected' : '' }}>Terrain</option>
                                    <option value="commercial" {{ request('type') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <select name="city" class="form-control">
                                    <option value="">Ville</option>
                                    <option value="Abidjan" {{ request('city') == 'Abidjan' ? 'selected' : '' }}>Abidjan</option>
                                    <option value="Yamoussoukro" {{ request('city') == 'Yamoussoukro' ? 'selected' : '' }}>Yamoussoukro</option>
                                    <option value="Bouaké" {{ request('city') == 'Bouaké' ? 'selected' : '' }}>Bouaké</option>
                                    <option value="San Pedro" {{ request('city') == 'San Pedro' ? 'selected' : '' }}>San Pedro</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <select name="sort" class="form-control">
                                    <option value="">Trier par</option>
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Plus récents</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <button type="submit" class="btn btn-default btn-block">Filtrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Property start from here -->
<section class="at-property-sec">
    <div class="container-fluid">
        <div class="row">
            @forelse($properties as $property)
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div class="at-property-item at-col-default-mar">
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
                        <h4><i class="fa fa-home" aria-hidden="true"></i><a href="{{ route('properties.show', $property->slug) }}">{{ Str::limit($property->title, 25) }}</a></h4>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $property->city }}, {{ $property->neighborhood ?? 'Côte d\'Ivoire' }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fa fa-home fa-4x text-muted mb-3"></i>
                    <h3>Aucun bien trouvé</h3>
                    <p>Essayez de modifier vos critères de recherche</p>
                    <a href="{{ route('properties.index') }}" class="btn btn-default">Voir tous les biens</a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($properties->hasPages())
        <div class="at-pagination">
            <ul class="pagination justify-content-center">
                {{-- Previous Page Link --}}
                @if ($properties->onFirstPage())
                    <li class="page-item disabled"><span class="page-link"><i class="fa fa-angle-double-left"></i></span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $properties->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i></a></li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($properties->getUrlRange(1, $properties->lastPage()) as $page => $url)
                    @if ($page == $properties->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($properties->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $properties->nextPageUrl() }}"><i class="fa fa-angle-double-right"></i></a></li>
                @else
                    <li class="page-item disabled"><span class="page-link"><i class="fa fa-angle-double-right"></i></span></li>
                @endif
            </ul>
        </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
    .at-search-filters {
        padding: 30px 0;
        background: #f8f9fa;
        margin-bottom: 30px;
    }
    .at-filter-box {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .at-filter-box .form-control {
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #e0e0e0;
        padding: 10px 15px;
    }
    .at-filter-box .btn {
        width: 100%;
        padding: 10px;
        background: #ffd700;
        color: #1a2a3a;
        font-weight: 600;
    }
    .at-filter-box .btn:hover {
        background: #1a2a3a;
        color: #ffd700;
    }
    .at-pagination {
        margin-top: 40px;
        text-align: center;
    }
    .at-pagination .pagination {
        display: inline-flex;
        list-style: none;
        padding: 0;
        border-radius: 5px;
        overflow: hidden;
    }
    .at-pagination .page-item {
        margin: 0;
    }
    .at-pagination .page-link {
        padding: 10px 15px;
        border: 1px solid #e0e0e0;
        color: #333;
        background: white;
        transition: all 0.3s ease;
    }
    .at-pagination .page-item.active .page-link {
        background: #ffd700;
        border-color: #ffd700;
        color: #1a2a3a;
    }
    .at-pagination .page-link:hover {
        background: #ffd700;
        border-color: #ffd700;
        color: #1a2a3a;
    }
    .at-pagination .page-item.disabled .page-link {
        color: #ccc;
        pointer-events: none;
    }
</style>
@endpush
