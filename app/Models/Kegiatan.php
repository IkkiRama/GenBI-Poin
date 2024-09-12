<?php

namespace App\Models;

use App\Models\PoinKegiatan;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kegiatan extends Model
{
    use HasFactory, SoftDeletes, HasRoles;
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function poin_kegiatan(): HasMany
    {
        return $this->hasMany(PoinKegiatan::class);
    }
}
