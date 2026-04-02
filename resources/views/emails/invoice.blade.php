<!DOCTYPE html>
<html>
<head>
    <title>Facture de paiement</title>
</head>
<body>
    <h2>Facture de paiement - AGEPIF</h2>
    <p>Bonjour {{ $payment->client->full_name }},</p>
    <p>Veuillez trouver ci-dessous les détails de votre paiement :</p>

    <table border="1" cellpadding="10" style="border-collapse: collapse;">
        <tr><th>Facture N°</th><td>{{ $payment->invoice_number }}</td></tr>
        <tr><th>Bien</th><td>{{ $payment->rental->property->title }}</td></tr>
        <tr><th>Montant</th><td>{{ number_format($payment->amount, 0, '', ' ') }} FCFA</td></tr>
        <tr><th>Date de paiement</th><td>{{ $payment->payment_date->format('d/m/Y') }}</td></tr>
        <tr><th>Statut</th><td>{{ $payment->status_label }}</td></tr>
    </table>

    <hr>
    <p>Cordialement,<br>AGEPIF Immobilier</p>
</body>
</html>
