<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'whatsapp',
        'address', 'city', 'country', 'profession', 'birth_date',
        'nationality', 'identity_card', 'notes', 'status', 'source'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Relations
    public function interactions()
    {
        return $this->hasMany(ClientInteraction::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'email', 'email');
    }

    public function rentalRequests()
    {
        return $this->hasMany(RentalRequest::class, 'client_email', 'email');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function activeRentals()
    {
        return $this->hasMany(Rental::class)->where('status', 'active');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Accesseurs pour les statistiques
    public function getTotalRentalsCountAttribute()
    {
        return $this->rentals()->count();
    }

    public function getActiveRentalsCountAttribute()
    {
        return $this->rentals()->where('status', 'active')->count();
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('status', 'paid')->sum('amount');
    }

    public function getTotalPendingAttribute()
    {
        return $this->payments()->where('status', 'pending')->sum('amount');
    }

    public function getStatusBadgeAttribute()
    {
        return [
            'active' => 'success',
            'inactive' => 'secondary',
            'blocked' => 'danger',
        ][$this->status] ?? 'info';
    }

    public function getStatusTextAttribute()
    {
        return [
            'active' => 'Actif',
            'inactive' => 'Inactif',
            'blocked' => 'Bloqué',
        ][$this->status] ?? 'Inconnu';
    }
}
