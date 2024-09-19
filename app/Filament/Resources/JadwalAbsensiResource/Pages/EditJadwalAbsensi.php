<?php

namespace App\Filament\Resources\JadwalAbsensiResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\JadwalAbsensiResource;

class EditJadwalAbsensi extends EditRecord
{
    protected static string $resource = JadwalAbsensiResource::class;

    protected function getFormActions(): array
    {
        return Auth::user()->hasRole("super_admin") || Auth::user()->hasRole("bph") ? [
            ...parent::getFormActions(),
        ] : [];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
