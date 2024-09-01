<?php

use App\Models\User;
use App\Models\Kegiatan;
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
        Schema::create('poin_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kegiatan::class)->cascadeOnDelete();
            $table->foreignIdFor(User::class)->cascadeOnDelete();
            $table->enum('jenis', ['Responsibility', 'Kontribusi', 'Event', 'Kreativitas']);
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
        Schema::dropIfExists('poin_kegiatans');
    }
};
