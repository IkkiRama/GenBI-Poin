<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianDeputiAnswersOption extends Model
{
    use HasFactory;

    public function penilaian_deputi_question(): BelongsTo
    {
        return $this->belongsTo(PenilaianDeputiQuestion::class);
    }

    public function penilaian_deputi_option(): BelongsTo
    {
        return $this->belongsTo(PenilaianDeputiOption::class);
    }

    public function penilaian_deputi_answers(): BelongsTo
    {
        return $this->belongsTo(PenilaianDeputiAnswer::class);
    }
}
