<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInteraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'property_id', 'type', 'description',
        'scheduled_at', 'completed_at', 'status', 'notes'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function getTypeLabelAttribute()
    {
        return [
            'call' => '📞 Appel',
            'email' => '✉️ Email',
            'whatsapp' => '💬 WhatsApp',
            'meeting' => '🤝 Rendez-vous',
            'visit' => '🏠 Visite',
            'inquiry' => '❓ Demande info',
            'rental_request' => '📝 Demande location',
        ][$this->type] ?? $this->type;
    }

    public function getStatusLabelAttribute()
    {
        return [
            'pending' => '⏳ En attente',
            'completed' => '✅ Terminé',
            'cancelled' => '❌ Annulé',
        ][$this->status] ?? $this->status;
    }
}
