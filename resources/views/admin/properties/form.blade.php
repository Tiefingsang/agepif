{{-- @extends('admin.layouts.app')

@section('title', $property->exists ? 'Modifier le bien' : 'Ajouter un bien')
@section('header', $property->exists ? 'Modifier le bien' : 'Ajouter un bien')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ $property->exists ? route('admin.properties.update', $property) : route('admin.properties.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @if($property->exists)
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Titre *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $property->title) }}" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description courte *</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                  rows="3" required>{{ old('description', $property->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description longue</label>
                        <textarea name="long_description" class="form-control" rows="5">{{ old('long_description', $property->long_description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prix (FCFA) *</label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', $property->price) }}" required>
                                @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Surface (m²) *</label>
                                <input type="number" step="0.01" name="surface" class="form-control @error('surface') is-invalid @enderror"
                                       value="{{ old('surface', $property->surface) }}" required>
                                @error('surface')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Pièces</label>
                                <input type="number" name="rooms" class="form-control" value="{{ old('rooms', $property->rooms) }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Chambres</label>
                                <input type="number" name="bedrooms" class="form-control" value="{{ old('bedrooms', $property->bedrooms) }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Salles de bain</label>
                                <input type="number" name="bathrooms" class="form-control" value="{{ old('bathrooms', $property->bathrooms) }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Garages</label>
                                <input type="number" name="garage" class="form-control" value="{{ old('garage', $property->garage) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Catégorie</label>
                        <select name="category_id" class="form-control">
                            <option value="">Sélectionner</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $property->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Type de bien *</label>
                        <select name="type" class="form-control" required>
                            <option value="house" {{ old('type', $property->type) == 'house' ? 'selected' : '' }}>Maison</option>
                            <option value="apartment" {{ old('type', $property->type) == 'apartment' ? 'selected' : '' }}>Appartement</option>
                            <option value="land" {{ old('type', $property->type) == 'land' ? 'selected' : '' }}>Terrain</option>
                            <option value="commercial" {{ old('type', $property->type) == 'commercial' ? 'selected' : '' }}>Commercial</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Transaction *</label>
                        <select name="transaction_type" class="form-control" required>
                            <option value="sale" {{ old('transaction_type', $property->transaction_type) == 'sale' ? 'selected' : '' }}>Vente</option>
                            <option value="rent" {{ old('transaction_type', $property->transaction_type) == 'rent' ? 'selected' : '' }}>Location</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Statut</label>
                        <select name="status" class="form-control">
                            <option value="published" {{ old('status', $property->status) == 'published' ? 'selected' : '' }}>Publié</option>
                            <option value="draft" {{ old('status', $property->status) == 'draft' ? 'selected' : '' }}>Brouillon</option>
                            <option value="sold" {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>Vendu</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_featured" class="custom-control-input" id="is_featured"
                                   value="1" {{ old('is_featured', $property->is_featured) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_featured">Mettre en vedette</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ville *</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city', $property->city) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Quartier</label>
                        <input type="text" name="neighborhood" class="form-control" value="{{ old('neighborhood', $property->neighborhood) }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Adresse *</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $property->address) }}" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Code postal</label>
                        <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $property->postal_code) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pays</label>
                        <input type="text" name="country" class="form-control" value="{{ old('country', $property->country) }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Images</label>
                <input type="file" name="images[]" class="form-control-file" multiple accept="image/*">
                @if($property->images && is_array($property->images))
                    <div class="mt-2">
                        @foreach($property->images as $image)
                            <img src="{{ Storage::url($image) }}" style="height: 50px; margin-right: 5px;">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>URL Vidéo</label>
                <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $property->video_url) }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ $property->exists ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
                <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
 --}}


 @extends('admin.layouts.app')

@section('title', $property->exists ? 'Modifier le bien' : 'Ajouter un bien')
@section('header', $property->exists ? 'Modifier le bien' : 'Ajouter un bien')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.properties.index') }}">Biens</a></li>
    <li class="breadcrumb-item active">{{ $property->exists ? 'Modifier' : 'Ajouter' }}</li>
@endsection

@section('content')
<style>
    .image-preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    .image-preview-item {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid #ddd;
        background: #f8f9fa;
    }
    .image-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .image-preview-item .remove-image {
        position: absolute;
        top: 5px;
        right: 5px;
        background: red;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        text-align: center;
        line-height: 18px;
        cursor: pointer;
        font-size: 12px;
    }
    .compression-info {
        font-size: 12px;
        color: #28a745;
        margin-top: 5px;
    }
    .loading-spinner {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }
</style>

<div class="loading-spinner" id="loadingSpinner">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Chargement...</span>
    </div>
    <p class="mt-2">Compression des images en cours...</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ $property->exists ? route('admin.properties.update', $property) : route('admin.properties.store') }}"
              method="POST"
              enctype="multipart/form-data"
              id="propertyForm">
            @csrf
            @if($property->exists)
                @method('PUT')
            @endif

            <!-- Informations générales -->
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Titre du bien *</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $property->title) }}" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Catégorie *</label>
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-type="{{ $category->slug }}"
                                    {{ old('category_id', $property->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label>Description courte *</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                          rows="3" required>{{ old('description', $property->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Description longue</label>
                <textarea name="long_description" id="long_description" class="form-control" rows="5">{{ old('long_description', $property->long_description) }}</textarea>
            </div>

            <!-- Champs dynamiques selon le type de bien -->
            <div id="dynamicFields">
                <!-- Champs pour tous les types -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Prix (FCFA) *</label>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price', $property->price) }}" required>
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Surface (m²) *</label>
                            <input type="number" step="0.01" name="surface" id="surface" class="form-control @error('surface') is-invalid @enderror"
                                   value="{{ old('surface', $property->surface) }}" required>
                            @error('surface')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Champs pour maison/appartement -->
                <div id="houseFields" style="display: none;">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Pièces</label>
                                <input type="number" name="rooms" id="rooms" class="form-control" value="{{ old('rooms', $property->rooms) }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Chambres</label>
                                <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="{{ old('bedrooms', $property->bedrooms) }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Salles de bain</label>
                                <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ old('bathrooms', $property->bathrooms) }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Garages</label>
                                <input type="number" name="garage" id="garage" class="form-control" value="{{ old('garage', $property->garage) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Localisation -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ville *</label>
                        <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror"
                               value="{{ old('city', $property->city) }}" required>
                        @error('city')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Quartier</label>
                        <input type="text" name="neighborhood" id="neighborhood" class="form-control"
                               value="{{ old('neighborhood', $property->neighborhood) }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Adresse *</label>
                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                       value="{{ old('address', $property->address) }}" required>
                @error('address')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Code postal</label>
                        <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $property->postal_code) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pays</label>
                        <input type="text" name="country" class="form-control" value="{{ old('country', $property->country) }}">
                    </div>
                </div>
            </div>

            <!-- Type de transaction -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Type de bien *</label>
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="house" {{ old('type', $property->type) == 'house' ? 'selected' : '' }}>🏠 Maison</option>
                            <option value="apartment" {{ old('type', $property->type) == 'apartment' ? 'selected' : '' }}>🏢 Appartement</option>
                            <option value="land" {{ old('type', $property->type) == 'land' ? 'selected' : '' }}>🌍 Terrain</option>
                            <option value="commercial" {{ old('type', $property->type) == 'commercial' ? 'selected' : '' }}>🏪 Commercial</option>
                            <option value="office" {{ old('type', $property->type) == 'office' ? 'selected' : '' }}>📋 Bureau</option>
                        </select>
                        @error('type')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Transaction *</label>
                        <select name="transaction_type" class="form-control @error('transaction_type') is-invalid @enderror" required>
                            <option value="sale" {{ old('transaction_type', $property->transaction_type) == 'sale' ? 'selected' : '' }}>💰 Vente</option>
                            <option value="rent" {{ old('transaction_type', $property->transaction_type) == 'rent' ? 'selected' : '' }}>📅 Location</option>
                        </select>
                        @error('transaction_type')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Statut</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="published" {{ old('status', $property->status) == 'published' ? 'selected' : '' }}>✅ Publié</option>
                            <option value="draft" {{ old('status', $property->status) == 'draft' ? 'selected' : '' }}>📝 Brouillon</option>
                            <option value="sold" {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>❌ Vendu</option>
                            <option value="rented" {{ old('status', $property->status) == 'rented' ? 'selected' : '' }}>🔑 Loué</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Images avec compression -->
            <div class="form-group">
                <label>Images</label>
                <input type="file" name="images[]" id="images" class="form-control-file" multiple accept="image/*" onchange="compressAndPreviewImages(this)">
                <small class="form-text text-muted">
                    <i class="fas fa-info-circle"></i>
                    Formats acceptés: JPG, PNG, GIF. Les images seront automatiquement compressées avant l'envoi.<br>
                    <span id="compressionStats"></span>
                </small>
                <div id="imagePreviewContainer" class="image-preview-container">
                    @if($property->images && is_array($property->images))
                        @foreach($property->images as $image)
                            <div class="image-preview-item">
                                <img src="{{ Storage::url($image) }}">
                                <div class="remove-image" onclick="removeImage(this, '{{ $image }}')">×</div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- URL Vidéo -->
            <div class="form-group">
                <label>URL Vidéo (YouTube/Vimeo)</label>
                <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $property->video_url) }}" placeholder="https://www.youtube.com/watch?v=...">
            </div>

            <!-- Caractéristiques -->
            <div class="form-group">
                <label>Caractéristiques</label>
                <div class="row" id="featuresList">
                    @php
                        $featuresList = [
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
                            'buanderie' => '🧺 Buanderie',
                            'cheminee' => '🔥 Cheminée',
                            'terrasse' => '🏖️ Terrasse',
                            'balcon' => '🚪 Balcon'
                        ];
                        $selectedFeatures = old('features', $property->features ?? []);
                        if(is_string($selectedFeatures)) {
                            $selectedFeatures = json_decode($selectedFeatures, true) ?? [];
                        }
                    @endphp
                    @foreach($featuresList as $key => $label)
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="features[]" class="custom-control-input"
                                       id="feature_{{ $key }}" value="{{ $key }}"
                                       {{ in_array($key, $selectedFeatures) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="feature_{{ $key }}">
                                    {{ $label }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Mise en vedette -->
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="is_featured" class="custom-control-input" id="is_featured"
                           value="1" {{ old('is_featured', $property->is_featured) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_featured">
                        <i class="fas fa-star text-warning"></i> Mettre en vedette (apparaît en première page)
                    </label>
                </div>
            </div>

            <!-- Date de disponibilité -->
            <div class="form-group" id="availabilityField">
                <label>Date de disponibilité</label>
                <input type="date" name="available_from" class="form-control" value="{{ old('available_from', $property->available_from) }}">
                <small class="form-text text-muted">Pour les locations, date à partir de laquelle le bien est disponible</small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i> {{ $property->exists ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
                <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// Gestion des champs dynamiques selon la catégorie
document.getElementById('category_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const categoryType = selectedOption.getAttribute('data-type');
    const houseFields = document.getElementById('houseFields');
    const availabilityField = document.getElementById('availabilityField');

    if (categoryType === 'terrains' || categoryType === 'land') {
        houseFields.style.display = 'none';
        // Désactiver les champs inutiles pour un terrain
        document.getElementById('rooms').value = 0;
        document.getElementById('bedrooms').value = 0;
        document.getElementById('bathrooms').value = 0;
        document.getElementById('garage').value = 0;
    } else {
        houseFields.style.display = 'block';
    }
});

// Déclencher le changement au chargement
if (document.getElementById('category_id').value) {
    document.getElementById('category_id').dispatchEvent(new Event('change'));
}

// Compression et prévisualisation des images
function compressAndPreviewImages(input) {
    const files = input.files;
    const previewContainer = document.getElementById('imagePreviewContainer');
    const compressionStats = document.getElementById('compressionStats');
    let totalOriginalSize = 0;
    let totalCompressedSize = 0;
    let processedCount = 0;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        totalOriginalSize += file.size;

        const reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onload = function(e) {
            const img = new Image();
            img.src = e.target.result;

            img.onload = function() {
                // Créer un canvas pour la compression
                const canvas = document.createElement('canvas');
                let width = img.width;
                let height = img.height;

                // Redimensionner si trop grand (max 1920px)
                const maxWidth = 1920;
                if (width > maxWidth) {
                    height = (height * maxWidth) / width;
                    width = maxWidth;
                }

                canvas.width = width;
                canvas.height = height;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);

                // Compresser avec qualité 70%
                const quality = 0.7;
                const compressedDataUrl = canvas.toDataURL('image/jpeg', quality);

                // Convertir en Blob
                const compressedBlob = dataURLtoBlob(compressedDataUrl);
                totalCompressedSize += compressedBlob.size;

                // Créer un nouveau fichier compressé
                const compressedFile = new File([compressedBlob], file.name.replace(/\.[^/.]+$/, "") + '.jpg', {
                    type: 'image/jpeg',
                    lastModified: Date.now()
                });

                // Remplacer le fichier original par le fichier compressé
                const dataTransfer = new DataTransfer();
                for (let j = 0; j < input.files.length; j++) {
                    if (j === i) {
                        dataTransfer.items.add(compressedFile);
                    } else {
                        dataTransfer.items.add(input.files[j]);
                    }
                }
                input.files = dataTransfer.files;

                // Afficher l'aperçu
                const previewDiv = document.createElement('div');
                previewDiv.className = 'image-preview-item';
                previewDiv.innerHTML = `
                    <img src="${compressedDataUrl}">
                    <div class="remove-image" onclick="this.parentElement.remove()">×</div>
                `;
                previewContainer.appendChild(previewDiv);

                processedCount++;
                if (processedCount === files.length) {
                    const reduction = ((1 - totalCompressedSize / totalOriginalSize) * 100).toFixed(1);
                    compressionStats.innerHTML = `<span class="text-success">✓ Compression terminée: ${(totalOriginalSize / 1024 / 1024).toFixed(2)} MB → ${(totalCompressedSize / 1024 / 1024).toFixed(2)} MB (${reduction}% de réduction)</span>`;
                }
            };
        };
    }
}

function dataURLtoBlob(dataURL) {
    const arr = dataURL.split(',');
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    let n = bstr.length;
    const u8arr = new Uint8Array(n);
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new Blob([u8arr], { type: mime });
}

function removeImage(element, imagePath) {
    if (confirm('Supprimer cette image ?')) {
        // Ajouter un champ caché pour marquer la suppression
        const form = document.getElementById('propertyForm');
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'deleted_images[]';
        input.value = imagePath;
        form.appendChild(input);
        element.parentElement.remove();
    }
}

// Désactiver le bouton pendant l'envoi
document.getElementById('propertyForm').addEventListener('submit', function() {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement en cours...';
});
</script>
@endsection
