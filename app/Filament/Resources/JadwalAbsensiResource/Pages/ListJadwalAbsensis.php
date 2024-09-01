<?php

namespace App\Filament\Resources\JadwalAbsensiResource\Pages;

use App\Filament\Resources\JadwalAbsensiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJadwalAbsensis extends ListRecords
{
    protected static string $resource = JadwalAbsensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
