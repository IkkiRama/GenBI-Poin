<?php

namespace App\Filament\Resources\KegiatanResource\Pages;

use Filament\Actions;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\KegiatanResource;
use Filament\Forms\Components\Actions\Action;

class EditKegiatan extends EditRecord
{
    protected static string $resource = KegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return Auth::user()->bidang === "medeks" ? [] : [
            Actions\DeleteAction::make(),
        ];
    }
}
