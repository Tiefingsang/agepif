<?php
// app/Models/Inquiry.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'source',
        'ip_address',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeContacted($query)
    {
        return $query->where('status', 'contacted');
    }

    public function markAsContacted()
    {
        $this->update(['status' => 'contacted']);
    }

    public function markAsClosed()
    {
        $this->update(['status' => 'closed']);
    }
}
