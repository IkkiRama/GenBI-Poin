<?php

namespace App\Filament\Resources\PenilaianDeputiAnswerResource\Pages;

use App\Filament\Resources\PenilaianDeputiAnswerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenilaianDeputiAnswer extends EditRecord
{
    protected static string $resource = PenilaianDeputiAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
