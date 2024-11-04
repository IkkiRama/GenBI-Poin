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
        Schema::table('penilaian_deputi_answers_options', function (Blueprint $table) {
            $table->foreignId('pd_option_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian_deputi_answers_options', function (Blueprint $table) {
            $table->foreignId('pd_option_id')->nullable(false)->change();
        });
    }
};
