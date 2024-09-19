<?php

namespace App\Filament\Resources\JadwalAbsensiResource\Pages;

use App\Filament\Resources\JadwalAbsensiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJadwalAbsensi extends CreateRecord
{
    protected static string $resource = JadwalAbsensiResource::class;
    protected static bool $canCreateAnother = true;
}
