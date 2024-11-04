<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class PenilaianDeputi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.penilaian-deputi';

    protected static bool $shouldRegisterNavigation = false;


    public $penilaianId;

    // public static function shouldRegisterNavigation(): bool
    // {
    //     return false;
    // }

    public function mount($penilaianId) {
        $this->penilaianId = $penilaianId;
    }
}
