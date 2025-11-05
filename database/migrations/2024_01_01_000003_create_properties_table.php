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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Owner (businessman)
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['apartment', 'house', 'commercial', 'land', 'other']);
            $table->enum('transaction_type', ['sale', 'rent', 'both']);
            $table->decimal('price', 12, 2);
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('area', 10, 2)->nullable(); // in square meters
            $table->string('registration_number')->nullable(); // Matrícula (private)
            $table->json('features')->nullable(); // Additional features
            $table->enum('status', ['available', 'reserved', 'sold', 'rented'])->default('available');
            $table->boolean('highlighted')->default(false);
            $table->timestamp('highlighted_until')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['user_id', 'status']);
            $table->index(['type', 'transaction_type', 'status']);
            $table->index(['city', 'state']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
