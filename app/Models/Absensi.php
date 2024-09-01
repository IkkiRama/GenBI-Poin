<?php

namespace App\Models;

use App\Models\User;
use App\Models\JadwalAbsensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function jadwal_absensi(): BelongsTo
    {
        return $this->belongsTo(JadwalAbsensi::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
