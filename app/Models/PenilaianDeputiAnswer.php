<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianDeputiAnswer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function penilaian_deputi(): BelongsTo
    {
        return $this->belongsTo(PenilaianDeputi::class);
    }

    public function penilaian_deputi_question(): BelongsTo
    {
        return $this->belongsTo(PenilaianDeputiQuestion::class);
    }
}
