<?php

namespace App\Filament\Resources\PenilaianDeputiAnswerResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PenilaianDeputiAnswerResource;

class ListPenilaianDeputiAnswers extends ListRecords
{
    protected static string $resource = PenilaianDeputiAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'SEMUA' => Tab::make(),
            'UNSOED' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) =>
                    $query->whereHas('user', function (Builder $query) {
                        $query->where('komsat', 'unsoed');
                    })
                ),
            'UMP' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) =>
                    $query->whereHas('user', function (Builder $query) {
                        $query->where('komsat', 'ump');
                    })
                ),
            'UIN' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) =>
                    $query->whereHas('user', function (Builder $query) {
                        $query->where('komsat', 'uin');
                    })
                ),
        ];
    }
}
