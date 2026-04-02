<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Property;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['client', 'property'])->latest()->paginate(20);
        return view('admin.rentals.index', compact('rentals'));
    }

    public function create()
    {
        $clients = Client::where('status', 'active')->get();
        $properties = Property::where('transaction_type', 'rent')->where('status', 'published')->get();
        return view('admin.rentals.form', ['rental' => new Rental(), 'clients' => $clients, 'properties' => $properties]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'property_id' => 'required|exists:properties,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'deposit' => 'nullable|numeric|min:0',
            'contract_notes' => 'nullable|string',
        ]);

        Rental::create($validated);

        return redirect()->route('admin.rentals.index')
            ->with('success', 'Contrat de location créé avec succès.');
    }

    public function show(Rental $rental)
    {
        $rental->load(['client', 'property', 'payments']);
        return view('admin.rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        $clients = Client::where('status', 'active')->get();
        $properties = Property::where('transaction_type', 'rent')->where('status', 'published')->get();
        return view('admin.rentals.form', compact('rental', 'clients', 'properties'));
    }

    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'property_id' => 'required|exists:properties,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'deposit' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,expired,terminated',
            'contract_notes' => 'nullable|string',
        ]);

        $rental->update($validated);

        return redirect()->route('admin.rentals.index')
            ->with('success', 'Contrat mis à jour avec succès.');
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();
        return redirect()->route('admin.rentals.index')
            ->with('success', 'Contrat supprimé avec succès.');
    }
}
