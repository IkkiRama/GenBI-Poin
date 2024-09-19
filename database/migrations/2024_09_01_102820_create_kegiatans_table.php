<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->string('nama');
            $table->date('tanggal');
            $table->string('image_bukti');
            $table->text('resume')->nullable();
            $table->text('link')->nullable();
            $table->enum('jenis', ['Responsibility', 'Kontribusi', 'Event', 'Kreativitas'])->nullable();
            $table->integer('score')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
