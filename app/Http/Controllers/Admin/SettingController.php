<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $settings = [
            'site_name' => Setting::get('site_name', 'AGEPIF Immobilier'),
            'site_description' => Setting::get('site_description', 'Agence immobilière professionnelle'),
            'contact_email' => Setting::get('contact_email', 'contact@agepif.com'),
            'contact_phone' => Setting::get('contact_phone', '+225 01 23 45 67'),
            'contact_whatsapp' => Setting::get('contact_whatsapp', '22501234567'),
            'address' => Setting::get('address', 'Abidjan, Côte d\'Ivoire'),
            'facebook_url' => Setting::get('facebook_url', '#'),
            'twitter_url' => Setting::get('twitter_url', '#'),
            'instagram_url' => Setting::get('instagram_url', '#'),
            'linkedin_url' => Setting::get('linkedin_url', '#'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'contact_whatsapp' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }
}
