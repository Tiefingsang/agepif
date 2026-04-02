<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::where('is_active', true)->orderBy('order')->get();
        $featuredProperties = Property::published()->featured()->latest()->take(6)->get();

        return view('front.home', compact('slides', 'featuredProperties'));
    }
}
