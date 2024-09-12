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
        Schema::create('penilaian_deputi_answers_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId("pd_question_id")->constrained("penilaian_deputi_questions")->cascadeOnDelete();
            $table->foreignId("pd_option_id")->constrained("penilaian_deputi_options")->cascadeOnDelete();
            $table->foreignId("pd_answer_id")->constrained("penilaian_deputi_answers")->cascadeOnDelete();
            $table->integer('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_deputi_answers_options');
    }
};
