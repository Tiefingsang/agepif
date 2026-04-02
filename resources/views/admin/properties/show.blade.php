@extends('admin.layouts.app')

@section('title', $property->title . ' - Détail du bien')
@section('header', 'Détail du bien immobilier')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.properties.index') }}">Biens</a></li>
    <li class="breadcrumb-item active">{{ Str::limit($property->title, 50) }}</li>
@endsection

@section('content')
<style>
    .property-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
    }
    .property-thumb {
        width: 100px;
        height: 70px;
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .property-thumb:hover {
        transform: scale(1.05);
    }
    .info-box {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        text-align: center;
    }
    .info-box i {
        font-size: 28px;
        color: #007bff;
        margin-bottom: 10px;
    }
    .info-box .label {
        font-size: 12px;
        color: #6c757d;
        text-transform: uppercase;
    }
    .info-box .value {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }
    .feature-badge {
        display: inline-block;
        padding: 5px 10px;
        margin: 3px;
        background: #e9ecef;
        border-radius: 20px;
        font-size: 12px;
    }
    .status-badge {
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: bold;
    }
    .gallery-modal-img {
        max-width: 100%;
        max-height: 80vh;
        object-fit: contain;
    }
</style>

<div class="row">
    <!-- Colonne gauche - Images et galerie -->
    <div class="col-md-7">
        <!-- Image principale -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-images"></i> Galerie d'images
                </h3>
                <div class="card-tools">
                    <span class="badge badge-{{ $property->status == 'published' ? 'success' : ($property->status == 'draft' ? 'warning' : 'danger') }} p-2">
                        @if($property->status == 'published')
                            ✅ Publié
                        @elseif($property->status == 'draft')
                            📝 Brouillon
                        @elseif($property->status == 'sold')
                            ❌ Vendu
                        @else
                            🔑 Loué
                        @endif
                    </span>
                </div>
            </div>
            <div class="card-body">
                @php
                    $images = is_array($property->images) ? $property->images : json_decode($property->images, true);
                @endphp

                @if($images && count($images) > 0)
                    <img src="{{ Storage::url($images[0]) }}" alt="{{ $property->title }}" class="property-image" id="mainImage">

                    @if(count($images) > 1)
                        <div class="row mt-3">
                            @foreach($images as $index => $image)
                                <div class="col-auto">
                                    <img src="{{ Storage::url($image) }}"
                                         class="property-thumb"
                                         onclick="changeMainImage(this.src)"
                                         data-full="{{ Storage::url($image) }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-image fa-4x text-muted mb-3"></i>
                        <p class="text-muted">Aucune image disponible</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Description -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-align-left"></i> Description
                </h3>
            </div>
            <div class="card-body">
                <h5>Description courte</h5>
                <p>{{ $property->description }}</p>

                @if($property->long_description)
                    <hr>
                    <h5>Description détaillée</h5>
                    <p>{{ $property->long_description }}</p>
                @endif
            </div>
        </div>

        <!-- Caractéristiques -->
        @if($property->features)
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-check-circle"></i> Équipements & caractéristiques
                    </h3>
                </div>
                <div class="card-body">
                    @php
                        $features = is_array($property->features) ? $property->features : json_decode($property->features, true);
                    @endphp
                    @if($features && count($features) > 0)
                        @foreach($features as $feature)
                            <span class="feature-badge">
                                <i class="fas fa-check text-success"></i>
                                @php
                                    $featureLabels = [
                                        'piscine' => '🏊 Piscine',
                                        'jardin' => '🌳 Jardin',
                                        'parking' => '🅿️ Parking',
                                        'climatisation' => '❄️ Climatisation',
                                        'garde' => '👮 Gardien',
                                        'groupe_electrogene' => '⚡ Groupe électrogène',
                                        'forage' => '💧 Forage',
                                        'alarme' => '🚨 Alarme',
                                        'videovigilance' => '📹 Vidéosurveillance',
                                        'ascenseur' => '🛗 Ascenseur',
                                        'vue_mer' => '🌊 Vue sur mer',
                                        'meuble' => '🛋️ Meublé',
                                        'domotique' => '🏠 Domotique',
                                        'salle_sport' => '🏋️ Salle de sport',
                                        'wifi' => '📶 Wi-Fi',
                                    ];
                                    echo $featureLabels[$feature] ?? ucfirst($feature);
                                @endphp
                            </span>
                        @endforeach
                    @else
                        <p class="text-muted">Aucune caractéristique spécifiée</p>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Colonne droite - Informations -->
    <div class="col-md-5">
        <!-- Informations principales -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i> Informations principales
                </h3>
            </div>
            <div class="card-body">
                <h3 class="text-primary">{{ number_format($property->price, 0, '', ' ') }} FCFA</h3>
                @if($property->transaction_type == 'rent')
                    <p class="text-muted">/ mois</p>
                @endif

                <hr>

                <div class="row">
                    <div class="col-6">
                        <div class="info-box">
                            <i class="fas fa-ruler-combined"></i>
                            <div class="label">Surface</div>
                            <div class="value">{{ $property->surface }} m²</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-box">
                            <i class="fas fa-tag"></i>
                            <div class="label">Type</div>
                            <div class="value">
                                @if($property->type == 'house') 🏠 Maison
                                @elseif($property->type == 'apartment') 🏢 Appartement
                                @elseif($property->type == 'land') 🌍 Terrain
                                @elseif($property->type == 'commercial') 🏪 Commercial
                                @else 📋 Bureau
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-box">
                            <i class="fas fa-exchange-alt"></i>
                            <div class="label">Transaction</div>
                            <div class="value">
                                @if($property->transaction_type == 'sale') 💰 Vente
                                @else 📅 Location
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-box">
                            <i class="fas fa-folder"></i>
                            <div class="label">Catégorie</div>
                            <div class="value">{{ $property->category->name ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Détails du bien -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list-ul"></i> Détails
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    @if($property->type != 'land')
                        <tr>
                            <th><i class="fas fa-door-open"></i> Pièces</th>
                            <td>{{ $property->rooms ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-bed"></i> Chambres</th>
                            <td>{{ $property->bedrooms ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-bath"></i> Salles de bain</th>
                            <td>{{ $property->bathrooms ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-car"></i> Garages</th>
                            <td>{{ $property->garage ?? 'N/A' }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th><i class="fas fa-eye"></i> Vues</th>
                        <td>{{ number_format($property->views, 0, '', ' ') }}</td>
                    </tr>
                    @if($property->available_from)
                        <tr>
                            <th><i class="fas fa-calendar-alt"></i> Disponible à partir</th>
                            <td>{{ \Carbon\Carbon::parse($property->available_from)->format('d/m/Y') }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th><i class="fas fa-star"></i> Vedette</th>
                        <td>
                            @if($property->is_featured)
                                <span class="badge badge-warning">⭐ Oui</span>
                            @else
                                <span class="badge badge-secondary">Non</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Localisation -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-map-marker-alt"></i> Localisation
                </h3>
            </div>
            <div class="card-body">
                <p>
                    <strong><i class="fas fa-city"></i> Ville :</strong> {{ $property->city }}<br>
                    <strong><i class="fas fa-location-dot"></i> Quartier :</strong> {{ $property->neighborhood ?? 'N/A' }}<br>
                    <strong><i class="fas fa-address-card"></i> Adresse :</strong> {{ $property->address }}<br>
                    <strong><i class="fas fa-mail-bulk"></i> Code postal :</strong> {{ $property->postal_code }}<br>
                    <strong><i class="fas fa-globe"></i> Pays :</strong> {{ $property->country }}
                </p>

                @if($property->video_url)
                    <hr>
                    <h6><i class="fas fa-video"></i> Visite virtuelle</h6>
                    <a href="{{ $property->video_url }}" target="_blank" class="btn btn-danger btn-sm">
                        <i class="fab fa-youtube"></i> Voir la vidéo
                    </a>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tools"></i> Actions
                </h3>
            </div>
            <div class="card-body">
                <div class="btn-group w-100">
                    <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="{{ route('admin.properties.toggle-featured', $property) }}" class="btn btn-warning">
                        <i class="fas fa-star"></i> {{ $property->is_featured ? 'Retirer vedette' : 'Mettre en vedette' }}
                    </a>
                    <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer ce bien ?')">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Demandes de contact pour ce bien -->
        @if($property->inquiries && $property->inquiries->count() > 0)
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-envelope"></i> Demandes de contact
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($property->inquiries->take(5) as $inquiry)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $inquiry->name }}</strong><br>
                                        <small>{{ $inquiry->email }} | {{ $inquiry->phone }}</small>
                                    </div>
                                    <div>
                                        <span class="badge badge-{{ $inquiry->status == 'pending' ? 'warning' : ($inquiry->status == 'contacted' ? 'info' : 'success') }}">
                                            {{ $inquiry->status_label ?? $inquiry->status }}
                                        </span>
                                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-info ml-2">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal pour la galerie -->
<div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $property->title }}</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <img src="" alt="" class="gallery-modal-img" id="modalImage">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
function changeMainImage(src) {
    document.getElementById('mainImage').src = src;
}

// Ouvrir la modal avec l'image cliquée
document.querySelectorAll('.property-thumb, #mainImage').forEach(img => {
    img.addEventListener('click', function() {
        const modalImg = document.getElementById('modalImage');
        modalImg.src = this.src;
        $('#galleryModal').modal('show');
    });
});
</script>
@endsection
