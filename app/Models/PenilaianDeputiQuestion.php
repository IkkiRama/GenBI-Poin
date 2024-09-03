<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianDeputiQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function penilaian_deputi(): BelongsTo
    {
        return $this->belongsTo(PenilaianDeputi::class);
    }

    public function penilaian_deputi_option(): HasMany
    {
        return $this->hasMany(PenilaianDeputiOption::class);
    }

    public function penilaian_deputi_answer(): HasMany
    {
        return $this->hasMany(PenilaianDeputiAnswer::class);
    }
}
