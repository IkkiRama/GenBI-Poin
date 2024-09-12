<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianDeputi extends Model
{
    use HasFactory, SoftDeletes, HasRoles;
    protected $guarded = ['id'];

    public function package_penilaian_deputi(): HasMany
    {
        return $this->hasMany(PackagePenilaianDeputi::class);
    }
}
