<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientInteraction;
use App\Models\Property;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('phone', 'LIKE', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $clients = $query->latest()->paginate(20);

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.form', ['client' => new Client()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'nationality' => 'nullable|string|max:255',
            'identity_card' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive,blocked',
            'source' => 'nullable|string|max:255',
        ]);

        Client::create($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client ajouté avec succès.');
    }

    public function show(Client $client)
    {
        $client->load(['interactions' => function($q) {
            $q->latest()->limit(10);
        }, 'inquiries' => function($q) {
            $q->latest()->limit(5);
        }, 'rentalRequests' => function($q) {
            $q->latest()->limit(5);
        }]);

        $interactionsCount = $client->interactions()->count();
        $pendingInteractions = $client->interactions()->where('status', 'pending')->count();
        $totalInquiries = $client->inquiries()->count();
        $totalRentalRequests = $client->rentalRequests()->count();

        return view('admin.clients.show', compact('client', 'interactionsCount', 'pendingInteractions', 'totalInquiries', 'totalRentalRequests'));
    }

    public function edit(Client $client)
    {
        return view('admin.clients.form', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'nationality' => 'nullable|string|max:255',
            'identity_card' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive,blocked',
            'source' => 'nullable|string|max:255',
        ]);

        $client->update($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client modifié avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }

    public function addInteraction(Request $request, Client $client)
    {
        $validated = $request->validate([
            'type' => 'required|in:call,email,whatsapp,meeting,visit,inquiry,rental_request',
            'description' => 'required|string',
            'scheduled_at' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $validated['client_id'] = $client->id;
        $validated['status'] = $validated['scheduled_at'] ? 'pending' : 'completed';
        $validated['completed_at'] = $validated['scheduled_at'] ? null : now();

        ClientInteraction::create($validated);

        return redirect()->back()->with('success', 'Interaction ajoutée avec succès.');
    }
}
