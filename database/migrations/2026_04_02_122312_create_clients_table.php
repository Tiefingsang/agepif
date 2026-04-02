<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->default('Côte d\'Ivoire');
            $table->string('profession')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('nationality')->default('Ivoirienne');
            $table->string('identity_card')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'inactive', 'blocked'])->default('active');
            $table->string('source')->default('website');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
