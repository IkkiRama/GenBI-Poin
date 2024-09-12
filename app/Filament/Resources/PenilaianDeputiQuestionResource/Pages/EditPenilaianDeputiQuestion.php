<?php

namespace App\Filament\Resources\PenilaianDeputiQuestionResource\Pages;

use App\Filament\Resources\PenilaianDeputiQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenilaianDeputiQuestion extends EditRecord
{
    protected static string $resource = PenilaianDeputiQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
