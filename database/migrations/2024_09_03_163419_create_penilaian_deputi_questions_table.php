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
        Schema::create('penilaian_deputi_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("penilaian_deputi_id")->constrained("penilaian_deputis")->cascadeOnDelete();
            $table->string('question');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_deputi_questions');
    }
};
