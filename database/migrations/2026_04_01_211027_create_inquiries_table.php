<?php
// database/migrations/2026_04_01_000003_create_inquiries_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('status')->default('pending'); // pending, contacted, closed, spam
            $table->string('source')->default('website'); // website, whatsapp, phone
            $table->string('ip_address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
