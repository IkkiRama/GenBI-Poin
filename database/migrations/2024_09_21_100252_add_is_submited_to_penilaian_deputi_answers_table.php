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
        Schema::table('penilaian_deputi_answers', function (Blueprint $table) {
            $table->boolean('is_submited')->nullable()->after('penilaian_deputi_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian_deputi_answers', function (Blueprint $table) {
            $table->dropColumn('is_submited');
        });
    }
};
