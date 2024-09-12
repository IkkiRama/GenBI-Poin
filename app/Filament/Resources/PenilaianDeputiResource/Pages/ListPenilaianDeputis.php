<?php

namespace App\Filament\Resources\PenilaianDeputiResource\Pages;

use App\Filament\Resources\PenilaianDeputiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenilaianDeputis extends ListRecords
{
    protected static string $resource = PenilaianDeputiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
