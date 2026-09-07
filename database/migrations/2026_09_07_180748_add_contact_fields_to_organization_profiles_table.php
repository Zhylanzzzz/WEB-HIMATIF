<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('organization_profiles', function (Blueprint $table) {
            $table->string('email')->nullable()->after('mission');
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->string('instagram')->nullable()->after('address');
            $table->string('youtube')->nullable()->after('instagram');
            $table->string('linkedin')->nullable()->after('youtube');
            $table->string('github')->nullable()->after('linkedin');
            $table->text('google_maps_embed')->nullable()->after('github');
        });
    }

    public function down(): void
    {
        Schema::table('organization_profiles', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone', 'address', 'instagram', 'youtube', 'linkedin', 'github', 'google_maps_embed']);
        });
    }
};
