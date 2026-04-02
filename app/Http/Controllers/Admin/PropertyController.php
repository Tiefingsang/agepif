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
    public function index(Request $request)
    {
        // Vérifier si l'utilisateur est admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $query = Property::with('category');

        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('city', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $properties = $query->latest()->paginate(15);

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $categories = Category::all();
        $property = new Property();
        return view('admin.properties.form', compact('categories', 'property'));
    }

    public function store(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $this->validateProperty($request);

        // Gérer les images
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $images[] = $path;
            }
            $validated['images'] = json_encode($images);
        }

        $validated['slug'] = Str::slug($request->title . '-' . uniqid());
        $validated['features'] = json_encode($request->features ?? []);

        Property::create($validated);

        return redirect()->route('admin.properties.index')
            ->with('success', 'Bien immobilier ajouté avec succès.');
    }

    public function edit(Property $property)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $categories = Category::all();
        $property->features = json_decode($property->features, true) ?? [];
        $property->images = json_decode($property->images, true) ?? [];
        return view('admin.properties.form', compact('property', 'categories'));
    }

    public function update(Request $request, Property $property)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $this->validateProperty($request);

        // Gérer les nouvelles images
        if ($request->hasFile('images')) {
            $images = json_decode($property->images, true) ?? [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $images[] = $path;
            }
            $validated['images'] = json_encode($images);
        }

        $validated['features'] = json_encode($request->features ?? []);

        $property->update($validated);

        return redirect()->route('admin.properties.index')
            ->with('success', 'Bien immobilier modifié avec succès.');
    }

    public function destroy(Property $property)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        // Supprimer les images
        $images = json_decode($property->images, true) ?? [];
        foreach ($images as $image) {
            Storage::disk('public')->delete($image);
        }

        $property->delete();

        return redirect()->route('admin.properties.index')
            ->with('success', 'Bien immobilier supprimé avec succès.');
    }

    public function toggleFeatured(Property $property)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $property->update(['is_featured' => !$property->is_featured]);

        return redirect()->back()
            ->with('success', $property->is_featured ? 'Bien mis en vedette' : 'Bien retiré des vedettes');
    }

    private function validateProperty(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'surface' => 'required|numeric|min:0',
            'rooms' => 'required|integer|min:0',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'garage' => 'integer|min:0',
            'city' => 'required|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'address' => 'required|string',
            'postal_code' => 'required|string|max:20',
            'type' => 'required|in:apartment,house,land,commercial,office',
            'transaction_type' => 'required|in:sale,rent',
            'status' => 'required|in:published,draft,sold,rented',
            'features' => 'nullable|array',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
            'virtual_tour_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'available_from' => 'nullable|date',
        ]);
    }
}
