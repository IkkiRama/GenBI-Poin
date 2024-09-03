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
        Schema::create('penilaian_deputi_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("deputi_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("penilaian_deputi_id")->constrained("penilaian_deputis")->cascadeOnDelete();
            $table->foreignId("penilaian_deputi_question_id")->constrained("penilaian_deputi_questions")->cascadeOnDelete();
            $table->string('option');
            $table->integer('score');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_deputi_answers');
    }
};
