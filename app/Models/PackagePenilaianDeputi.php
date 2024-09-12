<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackagePenilaianDeputi extends Model
{
    use HasFactory, SoftDeletes, HasRoles;
    protected $guarded = ['id'];

    public function penilaian_deputi(): BelongsTo
    {
        return $this->belongsTo(PenilaianDeputi::class);
    }

    public function penilaian_deputi_question(): BelongsTo
    {
        return $this->belongsTo(PenilaianDeputiQuestion::class);
    }
}
