<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'property_id', 'rental_request_id', 'start_date', 'end_date',
        'monthly_rent', 'deposit', 'status', 'contract_notes', 'contract_file'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function rentalRequest()
    {
        return $this->belongsTo(RentalRequest::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getLastPaymentAttribute()
    {
        return $this->payments()->where('status', 'paid')->latest('payment_date')->first();
    }

    public function getNextPaymentDueAttribute()
    {
        $lastPayment = $this->lastPayment;
        if (!$lastPayment) {
            return $this->start_date;
        }
        return $lastPayment->payment_date->addMonth();
    }

    public function getIsPaymentLateAttribute()
    {
        $nextDue = $this->next_payment_due;
        return $nextDue && $nextDue < now() && !$this->hasPaidCurrentMonth();
    }

    public function hasPaidCurrentMonth()
    {
        $currentMonthStart = now()->startOfMonth();
        return $this->payments()
            ->where('status', 'paid')
            ->where('payment_date', '>=', $currentMonthStart)
            ->exists();
    }

    public function getMonthsPaidAttribute()
    {
        return $this->payments()->where('status', 'paid')->count();
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('status', 'paid')->sum('amount');
    }

    public function getStatusLabelAttribute()
    {
        return [
            'active' => '✅ Actif',
            'expired' => '⏰ Expiré',
            'terminated' => '❌ Résilié',
        ][$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        return [
            'active' => 'success',
            'expired' => 'warning',
            'terminated' => 'danger',
        ][$this->status] ?? 'secondary';
    }
}
