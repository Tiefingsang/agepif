<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['rental.property', 'client']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->latest()->paginate(20);
        return view('admin.payments.index', compact('payments'));
    }

    public function create(Rental $rental = null)
    {
        if ($rental) {
            $clients = Client::where('id', $rental->client_id)->get();
            return view('admin.payments.form', ['payment' => new Payment(), 'rental' => $rental, 'clients' => $clients]);
        }

        $clients = Client::where('status', 'active')->get();
        $rentals = Rental::where('status', 'active')->get();
        return view('admin.payments.form', ['payment' => new Payment(), 'rentals' => $rentals, 'clients' => $clients]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'due_date' => 'required|date',
            'type' => 'required|in:rent,deposit,penalty,other',
            'status' => 'required|in:paid,pending,overdue,cancelled',
            'payment_method' => 'nullable|string',
            'transaction_id' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        Payment::create($validated);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Paiement enregistré avec succès.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['rental.property', 'client']);
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $rentals = Rental::where('status', 'active')->get();
        $clients = Client::where('status', 'active')->get();
        return view('admin.payments.form', compact('payment', 'rentals', 'clients'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'due_date' => 'required|date',
            'type' => 'required|in:rent,deposit,penalty,other',
            'status' => 'required|in:paid,pending,overdue,cancelled',
            'payment_method' => 'nullable|string',
            'transaction_id' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $payment->update($validated);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Paiement mis à jour avec succès.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payments.index')
            ->with('success', 'Paiement supprimé avec succès.');
    }

    public function sendPaymentReminder(Payment $payment)
    {
        // Envoyer un rappel de paiement par email
        Mail::send('emails.payment-reminder', ['payment' => $payment], function ($message) use ($payment) {
            $message->to($payment->client->email, $payment->client->full_name)
                    ->subject('Rappel de paiement - Loyer ' . $payment->rental->property->title);
        });

        return redirect()->back()->with('success', 'Rappel de paiement envoyé avec succès.');
    }

    public function sendInvoice(Payment $payment)
    {
        // Envoyer la facture par email
        Mail::send('emails.invoice', ['payment' => $payment], function ($message) use ($payment) {
            $message->to($payment->client->email, $payment->client->full_name)
                    ->subject('Facture de paiement - ' . $payment->invoice_number);
        });

        return redirect()->back()->with('success', 'Facture envoyée avec succès.');
    }

    public function markAsPaid(Payment $payment)
    {
        $payment->update([
            'status' => 'paid',
            'payment_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Paiement marqué comme payé.');
    }
}
