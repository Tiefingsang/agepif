<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_id')->constrained('rentals')->onDelete('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->date('payment_date');
            $table->date('due_date');
            $table->decimal('amount', 12, 0);
            $table->enum('type', ['rent', 'deposit', 'penalty', 'other'])->default('rent');
            $table->enum('status', ['paid', 'pending', 'overdue', 'cancelled'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('notes')->nullable();
            $table->string('receipt_file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
