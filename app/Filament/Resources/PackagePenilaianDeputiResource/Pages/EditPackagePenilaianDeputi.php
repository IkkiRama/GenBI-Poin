<?php

namespace App\Filament\Resources\PackagePenilaianDeputiResource\Pages;

use App\Filament\Resources\PackagePenilaianDeputiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPackagePenilaianDeputi extends EditRecord
{
    protected static string $resource = PackagePenilaianDeputiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
