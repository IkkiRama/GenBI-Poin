<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Filament\Pages\RankingDeputi;
use Illuminate\Support\Facades\DB;

class ExportRankingDeputiController extends Controller
{
    public function exportPDF(Request $request)
    {
        $monthAngka = $request->input('month');  // Parsing month from request
        $komsat = $request->input('komsat');  // Parsing komsat from request
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

        $rankingPage = new RankingDeputi();
        $ranking = $rankingPage->getRanking($monthAngka, $komsat); // Ambil data sesuai bulan dan komsat

        // Generate PDF (you might already have this in place)
        $pdf = PDF::loadView('pdf.ranking-deputi', compact('ranking', 'month', 'komsat', 'year'));

        return $pdf->download('ranking-deputi.pdf');
    }


}
