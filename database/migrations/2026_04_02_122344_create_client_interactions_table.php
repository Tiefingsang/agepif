<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('type', ['call', 'email', 'whatsapp', 'meeting', 'visit', 'inquiry', 'rental_request']);
            $table->text('description');
            $table->datetime('scheduled_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_interactions');
    }
};
