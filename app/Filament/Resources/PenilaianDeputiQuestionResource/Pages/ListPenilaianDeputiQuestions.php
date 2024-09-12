<?php

namespace App\Filament\Resources\PenilaianDeputiQuestionResource\Pages;

use App\Filament\Resources\PenilaianDeputiQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenilaianDeputiQuestions extends ListRecords
{
    protected static string $resource = PenilaianDeputiQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
