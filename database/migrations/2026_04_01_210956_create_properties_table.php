<?php
// database/migrations/2026_04_01_000002_create_properties_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->decimal('price', 15, 0);
            $table->decimal('surface', 10, 2);
            $table->integer('rooms');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('garage')->default(0);
            $table->string('city');
            $table->string('neighborhood')->nullable();
            $table->string('address');
            $table->string('postal_code');
            $table->string('country')->default('Côte d\'Ivoire');
            $table->enum('type', ['apartment', 'house', 'land', 'commercial', 'office'])->default('house');
            $table->enum('transaction_type', ['sale', 'rent'])->default('sale');
            $table->enum('status', ['published', 'draft', 'sold', 'rented'])->default('published');
            $table->json('features')->nullable();
            $table->json('images')->nullable();
            $table->string('video_url')->nullable();
            $table->string('virtual_tour_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('views')->default(0);
            $table->date('available_from')->nullable();
            $table->timestamps();

            // Indexes pour la recherche
            $table->index(['city', 'transaction_type', 'status']);
            $table->index('price');
            $table->index('surface');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
