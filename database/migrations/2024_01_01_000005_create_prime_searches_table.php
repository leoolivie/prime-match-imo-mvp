<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prime_searches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Investor
            $table->enum('property_type', ['apartment', 'house', 'commercial', 'land', 'any'])->default('any');
            $table->enum('transaction_type', ['sale', 'rent', 'both'])->default('both');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->decimal('min_price', 12, 2)->nullable();
            $table->decimal('max_price', 12, 2)->nullable();
            $table->integer('min_bedrooms')->nullable();
            $table->integer('min_bathrooms')->nullable();
            $table->decimal('min_area', 10, 2)->nullable();
            $table->json('features')->nullable();
            $table->boolean('create_alert')->default(false);
            $table->timestamps();
            
            $table->index(['user_id', 'create_alert']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prime_searches');
    }
};
