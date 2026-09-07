<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('officers', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('officers')->nullOnDelete();
        });

        Schema::table('aspirations', function (Blueprint $table) {
            $table->string('tracking_code')->unique()->nullable()->after('id');
            $table->enum('status', ['pending', 'process', 'completed', 'rejected'])->default('pending')->after('message');
            $table->text('admin_response')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('officers', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });

        Schema::table('aspirations', function (Blueprint $table) {
            $table->dropColumn(['tracking_code', 'status', 'admin_response']);
        });
    }
};
