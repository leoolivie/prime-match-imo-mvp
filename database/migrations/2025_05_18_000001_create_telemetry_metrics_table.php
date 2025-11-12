<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('telemetry_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->date('event_date');
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            $table->string('user_type')->nullable();
            $table->string('context')->nullable();
            $table->string('source')->nullable();
            $table->string('metadata_hash', 64)->nullable();
            $table->json('metadata')->nullable();
            $table->unsignedBigInteger('count')->default(0);
            $table->timestamps();

            $table->unique([
                'event_name',
                'event_date',
                'property_id',
                'user_type',
                'context',
                'source',
                'metadata_hash',
            ], 'telemetry_metrics_unique');

            $table->index(['event_name', 'event_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telemetry_metrics');
    }
};
