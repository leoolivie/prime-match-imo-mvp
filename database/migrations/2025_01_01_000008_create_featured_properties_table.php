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
        Schema::create('featured_properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('city');
            $table->string('state', 2);
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('area_m2', 10, 2)->nullable();
            $table->unsignedSmallInteger('bedrooms')->nullable();
            $table->unsignedSmallInteger('year_built')->nullable();
            $table->unsignedSmallInteger('parking_spaces')->nullable();
            $table->string('status')->default('available');
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('display_order')->default(0);
            $table->string('hero_image_path')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('video_url')->nullable();
            $table->string('cta_view_url')->nullable();
            $table->string('cta_concierge_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_properties');
    }
};
