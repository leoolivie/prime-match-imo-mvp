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
        Schema::table('users', function (Blueprint $table) {
            $table->string('creci')->nullable()->after('role');
            $table->string('cpf_cnpj', 20)->nullable()->after('creci');
            $table->string('businessman_state', 2)->nullable()->after('cpf_cnpj');
            $table->timestamp('property_access_requested_at')->nullable()->after('businessman_state');
            $table->timestamp('property_access_granted_at')->nullable()->after('property_access_requested_at');
            $table->boolean('can_manage_properties')->default(false)->after('property_access_granted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'creci',
                'cpf_cnpj',
                'businessman_state',
                'property_access_requested_at',
                'property_access_granted_at',
                'can_manage_properties',
            ]);
        });
    }
};
