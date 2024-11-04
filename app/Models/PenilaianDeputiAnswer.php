<?php

namespace App\Models;

use App\Models\PenilaianDeputi;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PenilaianDeputiAnswer extends Model
{
    use HasFactory, SoftDeletes, HasRoles;
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function deputi()
    {
        return $this->belongsTo(User::class, 'deputi_id');
    }

    public function penilaian_deputi(): BelongsTo
    {
        return $this->belongsTo(PenilaianDeputi::class);
    }

    public function penilaian_deputi_answers_option(): HasMany
    {
        return $this->hasMany(PenilaianDeputiAnswersOption::class);
    }
}
