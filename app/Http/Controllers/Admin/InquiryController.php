<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $query = Inquiry::with('property');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $inquiries = $query->latest()->paginate(20);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function create()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $properties = \App\Models\Property::where('status', 'published')
            ->orderBy('title')
            ->get();

        return view('admin.inquiries.create', compact('properties'));
    }

    public function store(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'property_id' => 'nullable|exists:properties,id',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:pending,contacted,closed',
            'source' => 'required|string|max:50',
        ]);

        $validated['ip_address'] = $request->ip();

        Inquiry::create($validated);

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Demande ajoutée avec succès.');
    }

    public function show(Inquiry $inquiry)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,closed',
            'notes' => 'nullable|string',
        ]);

        $inquiry->update($validated);

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Demande mise à jour avec succès.');
    }

    public function destroy(Inquiry $inquiry)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Demande supprimée avec succès.');
    }
}
