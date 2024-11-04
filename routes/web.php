<?php

use Illuminate\Support\Facades\Route;
// use App\Livewire\PenilaianDeputi;
use App\Filament\Pages\PenilaianDeputi;
use App\Filament\Pages\Ranking;
use App\Http\Controllers\ExportRankingController;
use App\Http\Controllers\ExportRankingDeputiController;

Route::group(['middleware' => 'auth'], function () {
    Route::get("/nilai-deputi/{penilaianId}", PenilaianDeputi::class)->name("NilaiDeputi");
    // Route::get("/admin/ranking", Ranking::class)->name("filament.pages.ranking");
    // Route::get('/export-ranking/{}', [ExportRankingController::class, 'exportRanking'])->name('export.ranking');
    Route::get('/export-ranking', [ExportRankingController::class, 'exportRanking'])->name('export.ranking');
    Route::get('/ranking-deputi/pdf', [ExportRankingDeputiController::class, 'exportPDF'])->name('ranking-deputi.pdf');
});

Route::get('/', function () {
    return view('welcome');
});
