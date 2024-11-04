<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Filament\Pages\Ranking;

class ExportRankingController extends Controller
{
    public function exportRanking(Request $request)
    {
        $monthAngka = $request->input('month'); // Ambil bulan dari request jika ada
        $komsat = $request->input('komsat'); // Ambil komsat dari request jika ada
        $year = now()->year; // Ambil tahun saat ini
        $month = "";


        if ($monthAngka) {
            if ($monthAngka == 1) {
                $month = "Januari";
            }elseif ($monthAngka == 2) {
                $month = "Februari";
            }elseif ($monthAngka == 3) {
                $month = "Maret";
            }elseif ($monthAngka == 4) {
                $month = "April";
            }elseif ($monthAngka == 5) {
                $month = "Mei";
            }elseif ($monthAngka == 6) {
                $month = "Juni";
            }elseif ($monthAngka == 7) {
                $month = "Juli";
            }elseif ($monthAngka == 8) {
                $month = "Agustus";
            }elseif ($monthAngka == 9) {
                $month = "September";
            }elseif ($monthAngka == 10) {
                $month = "Oktober";
            }elseif ($monthAngka == 11) {
                $month = "November";
            }elseif ($monthAngka == 12) {
                $month = "Desember";
            }
        }

        $rankingPage = new Ranking();
        $ranking = $rankingPage->getRanking($komsat, $monthAngka); // Ambil data sesuai bulan dan komsat

        $pdf = PDF::loadView('pdf.ranking', compact('ranking', 'month', 'komsat', 'year'));

        return $pdf->download('ranking.pdf');
    }

}
