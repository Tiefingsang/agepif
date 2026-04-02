<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $slides = Slide::orderBy('order')->paginate(10);
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        return view('admin.slides.form', ['slide' => new Slide()]);
    }

    public function store(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480', // 10MB max
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $validated['image'] = $this->compressAndSaveImage($image);
        }

        Slide::create($validated);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide ajoutée avec succès. Image compressée et optimisée.');
    }

    public function edit(Slide $slide)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        return view('admin.slides.form', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($slide->image) {
                Storage::disk('public')->delete($slide->image);
            }

            $image = $request->file('image');
            $validated['image'] = $this->compressAndSaveImage($image);
        }

        $slide->update($validated);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide modifiée avec succès.');
    }

    public function destroy(Slide $slide)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        if ($slide->image) {
            Storage::disk('public')->delete($slide->image);
        }

        $slide->delete();

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide supprimée avec succès.');
    }

    /**
     * Compresser et sauvegarder l'image
     */
    private function compressAndSaveImage($image)
    {
        // Créer le dossier s'il n'existe pas
        $folder = storage_path('app/public/slides');
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        // Générer un nom unique
        $filename = time() . '_' . uniqid() . '.jpg';
        $path = $folder . '/' . $filename;

        // Obtenir l'image selon son type
        $source = null;
        $type = exif_imagetype($image);

        switch ($type) {
            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($image);
                break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($image);
                // Préserver la transparence
                imagepalettetotruecolor($source);
                imagealphablending($source, true);
                imagesavealpha($source, true);
                break;
            case IMAGETYPE_GIF:
                $source = imagecreatefromgif($image);
                break;
            default:
                throw new \Exception('Format d\'image non supporté');
        }

        if (!$source) {
            throw new \Exception('Impossible de charger l\'image');
        }

        // Récupérer les dimensions
        $width = imagesx($source);
        $height = imagesy($source);
        $originalSize = $image->getSize();

        // Redimensionner si trop large (max 1920px)
        $maxWidth = 1920;
        if ($width > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = floor($height * ($maxWidth / $width));

            $resized = imagecreatetruecolor($newWidth, $newHeight);

            // Pour PNG, préserver la transparence
            if ($type == IMAGETYPE_PNG) {
                imagealphablending($resized, false);
                imagesavealpha($resized, true);
                $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
                imagefilledrectangle($resized, 0, 0, $newWidth, $newHeight, $transparent);
            }

            imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($source);
            $source = $resized;
        }

        // Déterminer la qualité en fonction de la taille originale
        $quality = $this->getQuality($originalSize);

        // Sauvegarder en JPG avec compression
        imagejpeg($source, $path, $quality);

        // Libérer la mémoire
        imagedestroy($source);

        // Log de la compression
        $compressedSize = filesize($path);
        \Log::info("Image compressée: Original: {$originalSize} bytes, Compressée: {$compressedSize} bytes, Qualité: {$quality}%");

        return 'slides/' . $filename;
    }

    /**
     * Déterminer la qualité de compression
     */
    private function getQuality($fileSize)
    {
        // Plus l'image est grande, plus on compresse
        if ($fileSize > 5 * 1024 * 1024) { // > 5MB
            return 60;
        } elseif ($fileSize > 2 * 1024 * 1024) { // 2-5MB
            return 70;
        } elseif ($fileSize > 1 * 1024 * 1024) { // 1-2MB
            return 80;
        } else { // < 1MB
            return 85;
        }
    }
}
