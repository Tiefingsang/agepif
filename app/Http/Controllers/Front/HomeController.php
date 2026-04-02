<?php
// app/Http/Controllers/Front/HomeController.php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::active()->get();

        $featuredProperties = Property::published()
            ->featured()
            ->with('category')
            ->latest()
            ->take(6)
            ->get();

        $latestProperties = Property::published()
            ->with('category')
            ->latest()
            ->take(9)
            ->get();

        $propertiesForSale = Property::published()
            ->forSale()
            ->latest()
            ->take(4)
            ->get();

        $propertiesForRent = Property::published()
            ->forRent()
            ->latest()
            ->take(4)
            ->get();

        $statistics = [
            'properties_count' => Property::published()->count(),
            'cities_count' => Property::published()->distinct('city')->count('city'),
            'happy_clients' => 150,
            'years_experience' => 10,
        ];

        return view('front.home', compact(
            'slides',
            'featuredProperties',
            'latestProperties',
            'propertiesForSale',
            'propertiesForRent',
            'statistics'
        ));
    }
}
