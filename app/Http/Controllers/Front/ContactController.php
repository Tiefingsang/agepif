<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact');
    }

    public function send(Request $request)
    {
        // Validation des champs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Préparer les données
            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'subject' => $validated['subject'] ?? 'Demande de contact',
                'message' => $validated['message'],
                'source' => 'website',
                'ip_address' => $request->ip(),
                'status' => 'pending',
            ];

            // Sauvegarder dans la base de données
            $inquiry = Inquiry::create($data);

            // Redirection avec message de succès
            return redirect()->back()->with('success', '✓ Votre message a été envoyé avec succès ! Nous vous contacterons dans les plus brefs délais.');

        } catch (\Exception $e) {
            // En cas d'erreur
            return redirect()->back()->with('error', '✗ Une erreur est survenue. Veuillez réessayer ou nous contacter par téléphone.');
        }
    }

    public function propertyInquiry(Request $request, $propertyId)
    {
        $request->merge(['property_id' => $propertyId]);
        return $this->send($request);
    }
}
