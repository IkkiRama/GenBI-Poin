<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Imports\ImportUsers;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    public $file = '';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeader(): ?View {
        $data =  Actions\CreateAction::make();
        return View("filament.import.user", compact("data"));
    }


    function save() {
        if ($this->file !== '') {
            Excel::import(new ImportUsers, $this->file);
        }
    }
}
