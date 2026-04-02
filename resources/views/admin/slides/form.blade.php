@extends('admin.layouts.app')

@section('title', $slide->exists ? 'Modifier le slide' : 'Ajouter un slide')
@section('header', $slide->exists ? 'Modifier le slide' : 'Ajouter un slide')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.slides.index') }}">Slides</a></li>
    <li class="breadcrumb-item active">{{ $slide->exists ? 'Modifier' : 'Ajouter' }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ $slide->exists ? route('admin.slides.update', $slide) : route('admin.slides.store') }}"
              method="POST"
              enctype="multipart/form-data"
              id="slideForm">
            @csrf
            @if($slide->exists)
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="title">Titre *</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $slide->title) }}" required>
                @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="subtitle">Sous-titre</label>
                <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror"
                       value="{{ old('subtitle', $slide->subtitle) }}">
                @error('subtitle')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">
                    Image
                    @if(!$slide->exists)
                        *
                    @endif
                </label>
                <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror"
                       {{ $slide->exists ? '' : 'required' }} accept="image/*"
                       onchange="compressImage(this)">

                <div id="imagePreview"></div>

                @if($slide->image)
                    <div class="mt-2">
                        <img src="{{ Storage::url($slide->image) }}" style="height: 100px; border-radius: 5px;">
                        <p class="text-muted mt-1">Image actuelle</p>
                    </div>
                @endif

                <small class="form-text text-muted">
                    <i class="fas fa-info-circle"></i>
                    Formats acceptés: JPG, PNG, GIF. Les images seront automatiquement compressées avant l'envoi.<br>
                    <span id="fileInfo"></span>
                </small>
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="button_text">Texte du bouton</label>
                        <input type="text" name="button_text" id="button_text" class="form-control @error('button_text') is-invalid @enderror"
                               value="{{ old('button_text', $slide->button_text) }}" placeholder="ex: En savoir plus">
                        @error('button_text')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="button_link">Lien du bouton</label>
                        <input type="url" name="button_link" id="button_link" class="form-control @error('button_link') is-invalid @enderror"
                               value="{{ old('button_link', $slide->button_link) }}" placeholder="https://...">
                        @error('button_link')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">Ordre d'affichage</label>
                        <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror"
                               value="{{ old('order', $slide->order) }}" min="0">
                        <small class="form-text text-muted">Plus le chiffre est petit, plus le slide apparaît en premier</small>
                        @error('order')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="is_active">Statut</label>
                        <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active', $slide->is_active) ? 'selected' : '' }}>Actif</option>
                            <option value="0" {{ old('is_active', $slide->is_active) ? '' : 'selected' }}>Inactif</option>
                        </select>
                        @error('is_active')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i> {{ $slide->exists ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
                <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>

@if($slide->exists && $slide->image)
<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Aperçu du slide</h3>
    </div>
    <div class="card-body text-center">
        <img src="{{ Storage::url($slide->image) }}" style="max-width: 100%; height: auto; border-radius: 5px;">
        <p class="mt-2">
            <strong>Titre:</strong> {{ $slide->title }}<br>
            <strong>Sous-titre:</strong> {{ $slide->subtitle ?? 'N/A' }}
        </p>
    </div>
</div>
@endif

@section('scripts')
<script>
function compressImage(input) {
    const file = input.files[0];
    const fileInfo = document.getElementById('fileInfo');

    if (!file) return;

    // Afficher la taille originale
    const originalSize = (file.size / 1024).toFixed(2);
    fileInfo.innerHTML = `Taille originale: ${originalSize} KB`;

    // Si l'image est plus petite que 1MB, on ne la compresse pas
    if (file.size < 1024 * 1024) {
        fileInfo.innerHTML += ` - Image déjà optimisée`;
        return;
    }

    // Compresser l'image
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

            // Redimensionner si trop grande (max 1920px)
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
            let quality = 0.7;
            let compressedDataUrl = canvas.toDataURL('image/jpeg', quality);

            // Convertir en Blob
            const compressedBlob = dataURLtoBlob(compressedDataUrl);
            const compressedSize = (compressedBlob.size / 1024).toFixed(2);

            fileInfo.innerHTML += ` - Après compression: ${compressedSize} KB (${Math.round((1 - compressedBlob.size / file.size) * 100)}% de réduction)`;

            // Créer un nouveau fichier compressé
            const compressedFile = new File([compressedBlob], file.name.replace(/\.[^/.]+$/, "") + '.jpg', {
                type: 'image/jpeg',
                lastModified: Date.now()
            });

            // Remplacer le fichier original par le fichier compressé
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(compressedFile);
            input.files = dataTransfer.files;

            // Afficher l'aperçu
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = `<img src="${compressedDataUrl}" style="max-height: 100px; margin-top: 10px; border-radius: 5px;">`;
        };
    };
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

// Optionnel: Désactiver le bouton pendant le traitement
document.getElementById('slideForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement en cours...';
});
</script>
@endsection
@endsection
