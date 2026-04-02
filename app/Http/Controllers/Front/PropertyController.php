<?php
// app/Http/Controllers/Front/PropertyController.php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Category;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::published()->with('category');

        // Filtres
        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('city')) {
            $query->where('city', 'LIKE', "%{$request->city}%");
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('min_surface')) {
            $query->where('surface', '>=', $request->min_surface);
        }

        if ($request->filled('max_surface')) {
            $query->where('surface', '<=', $request->max_surface);
        }

        if ($request->filled('rooms')) {
            $query->where('rooms', '>=', $request->rooms);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('city', 'LIKE', "%{$search}%")
                  ->orWhere('address', 'LIKE', "%{$search}%");
            });
        }

        // Tri
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'surface_asc':
                $query->orderBy('surface', 'asc');
                break;
            case 'surface_desc':
                $query->orderBy('surface', 'desc');
                break;
            default:
                $query->latest();
        }

        $properties = $query->paginate(12)->withQueryString();

        // Statistiques pour les filtres
        $cities = Property::published()->distinct()->pluck('city');
        $categories = Category::where('is_active', true)->get();

        return view('front.properties.index', compact('properties', 'cities', 'categories'));
    }

    public function show($slug)
    {
        $property = Property::where('slug', $slug)
            ->published()
            ->with('category', 'inquiries')
            ->firstOrFail();

        // Incrémenter les vues
        $property->incrementViews();

        // Propriétés similaires
        $similarProperties = Property::published()
            ->where('id', '!=', $property->id)
            ->where('city', $property->city)
            ->orWhere('type', $property->type)
            ->orWhere('transaction_type', $property->transaction_type)
            ->take(3)
            ->get();

        return view('front.properties.show', compact('property', 'similarProperties'));
    }
}
