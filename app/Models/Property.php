<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'long_description',
        'price',
        'surface',
        'rooms',
        'bedrooms',
        'bathrooms',
        'garage',
        'city',
        'neighborhood',
        'address',
        'postal_code',
        'country',
        'type',
        'transaction_type',
        'status',
        'features',
        'images',
        'video_url',
        'virtual_tour_url',
        'is_featured',
        'views',
        'available_from',
    ];

    protected $casts = [
        'features' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
        'available_from' => 'date',
    ];

    // Boot method to generate slug automatically
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = static::generateUniqueSlug($property->title);
            }
        });

        static::updating(function ($property) {
            if ($property->isDirty('title') && empty($property->slug)) {
                $property->slug = static::generateUniqueSlug($property->title);
            }
        });
    }

    // Generate unique slug
    protected static function generateUniqueSlug($title)
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        if ($this->transaction_type === 'rent') {
            return number_format($this->price, 0, '', ' ') . ' FCFA/mois';
        }
        return number_format($this->price, 0, '', ' ') . ' FCFA';
    }

    public function getMainImageAttribute()
    {
        if ($this->images && count($this->images) > 0) {
            return $this->images[0];
        }
        return '/images/default-property.jpg';
    }

    public function getGalleryImagesAttribute()
    {
        if ($this->images && count($this->images) > 1) {
            return array_slice($this->images, 1);
        }
        return [];
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->description, 150);
    }

    // Relations
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeForSale($query)
    {
        return $query->where('transaction_type', 'sale');
    }

    public function scopeForRent($query)
    {
        return $query->where('transaction_type', 'rent');
    }

    public function scopeInCity($query, $city)
    {
        return $query->where('city', 'LIKE', "%{$city}%");
    }

    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    public function scopeSurfaceBetween($query, $min, $max)
    {
        return $query->whereBetween('surface', [$min, $max]);
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views');
    }
}
