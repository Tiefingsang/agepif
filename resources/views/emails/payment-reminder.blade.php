<!DOCTYPE html>
<html>
<head>
    <title>Rappel de paiement</title>
</head>
<body>
    <h2>Rappel de paiement - AGEPIF</h2>
    <p>Bonjour {{ $payment->client->full_name }},</p>
    <p>Nous vous rappelons que le paiement du loyer pour le bien <strong>{{ $payment->rental->property->title }}</strong> est dû.</p>
    <p><strong>Montant :</strong> {{ number_format($payment->amount, 0, '', ' ') }} FCFA</p>
    <p><strong>Date d'échéance :</strong> {{ $payment->due_date->format('d/m/Y') }}</p>
    <p>Merci de procéder au paiement dans les plus brefs délais.</p>
    <hr>
    <p>Cordialement,<br>AGEPIF Immobilier</p>
</body>
</html>
