<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id', 'client_id', 'invoice_number', 'payment_date', 'due_date',
        'amount', 'type', 'status', 'payment_method', 'transaction_id', 'notes', 'receipt_file'
    ];

    protected $casts = [
        'payment_date' => 'date',
        'due_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            if (empty($payment->invoice_number)) {
                $payment->invoice_number = 'INV-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getTypeLabelAttribute()
    {
        return [
            'rent' => '🏠 Loyer',
            'deposit' => '💰 Caution',
            'penalty' => '⚠️ Pénalité',
            'other' => '📋 Autre',
        ][$this->type] ?? $this->type;
    }

    public function getStatusLabelAttribute()
    {
        return [
            'paid' => '✅ Payé',
            'pending' => '⏳ En attente',
            'overdue' => '🔴 En retard',
            'cancelled' => '❌ Annulé',
        ][$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        return [
            'paid' => 'success',
            'pending' => 'warning',
            'overdue' => 'danger',
            'cancelled' => 'secondary',
        ][$this->status] ?? 'info';
    }
}
