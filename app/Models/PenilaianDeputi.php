<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianDeputi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function penilaian_deputi_question(): HasMany
    {
        return $this->hasMany(PenilaianDeputiQuestion::class);
    }

    public function penilaian_deputi_answer(): HasMany
    {
        return $this->hasMany(PenilaianDeputiAnswer::class);
    }
}
