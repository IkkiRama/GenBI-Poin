<?php

namespace App\Filament\Resources\KegiatanResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\KegiatanResource;

class ListKegiatans extends ListRecords
{
    protected static string $resource = KegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return Auth::user()->bidang === "pendidikan" > 0 ? [] : [
            Actions\CreateAction::make(),
        ];
}

    public function getTitle(): string {
        return "Kegiatan";
    }
}
