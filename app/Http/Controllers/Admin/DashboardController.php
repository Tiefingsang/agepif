<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Vérifier si l'utilisateur est admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé. Vous devez être administrateur.');
        }

        $totalProperties = Property::count();
        $publishedProperties = Property::where('status', 'published')->count();
        $totalInquiries = Inquiry::count();
        $pendingInquiries = Inquiry::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalProperties',
            'publishedProperties',
            'totalInquiries',
            'pendingInquiries'
        ));
    }
}
