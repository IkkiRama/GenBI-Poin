<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianDeputiAnswer extends Model
{
    use HasFactory, SoftDeletes, HasRoles;
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function package_penilaian_deputi(): BelongsTo
    {
        return $this->belongsTo(PackagePenilaianDeputi::class);
    }
}
