<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    /**
     * Afficher la liste des biens
     */
    public function index(Request $request)
    {
        // Vérifier si l'utilisateur est admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $query = Property::with('category');

        // Filtre de recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                  ->orWhere('city', 'LIKE', '%' . $search . '%')
                  ->orWhere('address', 'LIKE', '%' . $search . '%');
            });
        }

        // Filtre par statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtre par type de transaction
        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }

        // Filtre par type de bien
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $properties = $query->latest()->paginate(12);

        // Statistiques pour le dashboard
        $totalProperties = Property::count();
        $publishedCount = Property::where('status', 'published')->count();
        $featuredCount = Property::where('is_featured', true)->count();
        $totalValue = Property::where('transaction_type', 'sale')->sum('price');

        return view('admin.properties.index', compact(
            'properties',
            'totalProperties',
            'publishedCount',
            'featuredCount',
            'totalValue'
        ));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $categories = Category::where('is_active', true)->get();
        $property = new Property();
        return view('admin.properties.form', compact('categories', 'property'));
    }

    /**
     * Enregistrer un nouveau bien
     */
    public function store(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $this->validateProperty($request);

        // Gérer les images (déjà compressées côté client)
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $images[] = $path;
            }
            $validated['images'] = json_encode($images);
        }

        // Générer le slug
        $validated['slug'] = Str::slug($request->title . '-' . uniqid());

        // Gérer les caractéristiques
        $validated['features'] = json_encode($request->features ?? []);

        // Gérer la mise en vedette
        $validated['is_featured'] = $request->has('is_featured') ? true : false;

        Property::create($validated);

        return redirect()->route('admin.properties.index')
            ->with('success', 'Bien immobilier ajouté avec succès.');
    }

    /**
     * Afficher les détails d'un bien
     */
    public function show(Property $property)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $property->load('category', 'inquiries');
        $property->images = json_decode($property->images, true) ?? [];
        $property->features = json_decode($property->features, true) ?? [];

        return view('admin.properties.show', compact('property'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Property $property)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $categories = Category::where('is_active', true)->get();
        $property->features = json_decode($property->features, true) ?? [];
        $property->images = json_decode($property->images, true) ?? [];

        return view('admin.properties.form', compact('property', 'categories'));
    }

    /**
     * Mettre à jour un bien
     */
    public function update(Request $request, Property $property)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $this->validateProperty($request, $property->id);

        // Gérer les nouvelles images
        if ($request->hasFile('images')) {
            $images = json_decode($property->images, true) ?? [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $images[] = $path;
            }
            $validated['images'] = json_encode($images);
        }

        // Gérer la suppression d'images
        if ($request->has('deleted_images')) {
            $currentImages = json_decode($property->images, true) ?? [];
            $deletedImages = $request->deleted_images;

            foreach ($deletedImages as $deletedImage) {
                if (($key = array_search($deletedImage, $currentImages)) !== false) {
                    unset($currentImages[$key]);
                    Storage::disk('public')->delete($deletedImage);
                }
            }
            $validated['images'] = json_encode(array_values($currentImages));
        }

        // Gérer les caractéristiques
        $validated['features'] = json_encode($request->features ?? []);

        // Gérer la mise en vedette
        $validated['is_featured'] = $request->has('is_featured') ? true : false;

        $property->update($validated);

        return redirect()->route('admin.properties.index')
            ->with('success', 'Bien immobilier modifié avec succès.');
    }

    /**
     * Supprimer un bien
     */
    public function destroy(Property $property)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        // Supprimer les images associées
        $images = json_decode($property->images, true) ?? [];
        foreach ($images as $image) {
            Storage::disk('public')->delete($image);
        }

        $property->delete();

        return redirect()->route('admin.properties.index')
            ->with('success', 'Bien immobilier supprimé avec succès.');
    }

    /**
     * Mettre en vedette ou retirer de la vedette
     */
    public function toggleFeatured(Property $property)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $property->update(['is_featured' => !$property->is_featured]);

        $message = $property->is_featured ? 'Bien mis en vedette avec succès' : 'Bien retiré des vedettes';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Valider les données du formulaire
     */
    private function validateProperty(Request $request, $propertyId = null)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'surface' => 'required|numeric|min:0',
            'rooms' => 'nullable|integer|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'garage' => 'nullable|integer|min:0',
            'city' => 'required|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'address' => 'required|string',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'type' => 'required|in:apartment,house,land,commercial,office',
            'transaction_type' => 'required|in:sale,rent',
            'status' => 'required|in:published,draft,sold,rented',
            'features' => 'nullable|array',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max (compressé côté client)
            'video_url' => 'nullable|url',
            'virtual_tour_url' => 'nullable|url',
            'is_featured' => 'nullable|boolean',
            'available_from' => 'nullable|date',
        ];

        // Rendre certains champs optionnels selon le type de bien
        if ($request->type == 'land') {
            $rules['rooms'] = 'nullable';
            $rules['bedrooms'] = 'nullable';
            $rules['bathrooms'] = 'nullable';
            $rules['garage'] = 'nullable';
        }

        return $request->validate($rules);
    }
}
