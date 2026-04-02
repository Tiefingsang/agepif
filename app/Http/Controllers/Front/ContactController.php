<?php
// app/Http/Controllers/Front/ContactController.php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact');
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'property_id' => 'nullable|exists:properties,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $inquiry = Inquiry::create([
            'property_id' => $request->property_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject ?? 'Demande de contact',
            'message' => $request->message,
            'source' => 'website',
            'ip_address' => $request->ip(),
        ]);

        // Envoyer un email de confirmation
        try {
            Mail::send('emails.contact-confirmation', ['inquiry' => $inquiry], function ($message) use ($inquiry) {
                $message->to($inquiry->email, $inquiry->name)
                    ->subject('Confirmation de votre demande - AGEPIF');
            });

            // Envoyer une notification à l'admin
            Mail::send('emails.contact-notification', ['inquiry' => $inquiry], function ($message) {
                $message->to(config('mail.admin_email'))
                    ->subject('Nouvelle demande de contact - AGEPIF');
            });
        } catch (\Exception $e) {
            // Log l'erreur mais continue
            \Log::error('Email sending failed: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Votre message a été envoyé avec succès. Nous vous contacterons dans les plus brefs délais.');
    }

    public function propertyInquiry(Request $request, $propertyId)
    {
        $request->merge(['property_id' => $propertyId]);
        return $this->send($request);
    }
}
