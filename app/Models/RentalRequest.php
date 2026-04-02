<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'client_name',
        'client_email',
        'client_phone',
        'start_date',
        'end_date',
        'duration_months',
        'message',
        'status',
        'source',
        'ip_address',
        'admin_notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function getStatusLabelAttribute()
    {
        return [
            'pending' => '⏳ En attente',
            'approved' => '✅ Approuvé',
            'rejected' => '❌ Rejeté',
            'completed' => '📋 Terminé',
        ][$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        return [
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            'completed' => 'info',
        ][$this->status] ?? 'secondary';
    }
}
