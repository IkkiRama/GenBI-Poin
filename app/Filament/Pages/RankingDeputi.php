<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class RankingDeputi extends Page
{
    protected static string $view = 'filament.pages.ranking-deputi';

    protected static ?string $navigationIcon = 'heroicon-s-academic-cap';

    protected static ?string $navigationGroup = 'Ranking';

    protected static ?int $navigationSort = 2;

    public $ranking;
    public $month;
    public $komsat;
    public $isActiveKomsat = "Semua";
    public $isActiveMonth = null;

    public function mount()
    {
        $this->month = null; // Default: all months
        $this->komsat = 'Semua'; // Default: all komsat
        $this->ranking = $this->getRanking(); // Load ranking data on page load
    }

    // Filter by month
    public function filterByMonth($month = null)
    {
        $this->month = $month;
        $this->ranking = $this->getRanking($month, $this->komsat);
        $this->isActiveMonth = $month;
    }

    // Filter by komsat
    public function filterByKomsat($komsat = null)
    {
        $this->komsat = $komsat;
        $this->ranking = $this->getRanking($this->month, $komsat);
        $this->isActiveKomsat = $komsat;
    }

    // Get the ranking data with month and komsat filters
    public function getRanking($month = null, $komsat = 'Semua')
    {
        // Get absensi and kegiatan points per deputy
        $pointsQuery = DB::table('penilaian_deputi_answers')
            ->select('deputi_id', DB::raw('COALESCE(SUM(pd_options.score), 0) AS total_points'))
            ->join('penilaian_deputi_answers_options AS pd_options', 'penilaian_deputi_answers.id', '=', 'pd_options.pd_answer_id')
            ->groupBy('deputi_id');

        // Apply month filter if provided
        if ($month) {
            $pointsQuery->whereMonth('penilaian_deputi_answers.created_at', $month);
        }

        $points = $pointsQuery->get()->keyBy('deputi_id');

        // Get users with the "deputi" role
        $usersQuery = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'deputi')
            ->select('users.id', 'users.name', 'users.komsat', 'users.bidang');

        // Apply komsat filter if provided (and not 'Semua')
        if ($komsat !== 'Semua') {
            $usersQuery->where('users.komsat', $komsat);
        }

        $users = $usersQuery->get();

        $ranking = [];

        foreach ($users as $user) {
            $totalPoints = $points->get($user->id)->total_points ?? 0; // Default to 0 if no points exist
            $ranking[] = [
                'user_id' => $user->id,
                'name' => $user->name,
                'komsat' => $user->komsat,
                'bidang' => $user->bidang,
                'total_points' => $totalPoints,
            ];
        }

        // Sort by total points
        return collect($ranking)->sortByDesc('total_points')->values();
    }




    // Calculate total points for each deputy
    public function calculateTotalPoints($deputy_id, $month = null)
    {
        // Query to get the total points for each deputy based on answers and options
        $query = DB::table('penilaian_deputi_answers_options')
            ->join('penilaian_deputi_answers', 'penilaian_deputi_answers_options.pd_answer_id', '=', 'penilaian_deputi_answers.id')
            ->where('penilaian_deputi_answers.deputi_id', $deputy_id)
            ->select(DB::raw('SUM(penilaian_deputi_answers_options.score) AS total_points'));

        // Apply month filter if necessary
        if ($month) {
            $query->whereMonth('penilaian_deputi_answers.created_at', $month);
        }

        return $query->value('total_points') ?? 0; // Return total points, or 0 if none found
    }

    // Define tabs for months and komsat
    public function getTabs(): array
    {
        return [
            'Bulan' => [
                'Semua' => null,
                'Januari' => 1,
                'Februari' => 2,
                'Maret' => 3,
                'April' => 4,
                'Mei' => 5,
                'Juni' => 6,
                'Juli' => 7,
                'Agustus' => 8,
                'September' => 9,
                'Oktober' => 10,
                'November' => 11,
                'Desember' => 12,
            ],
            'Komsat' => [
                'Semua' => 'Semua',
                'Unsoed' => 'Unsoed',
                'UMP' => 'UMP',
                'UIN' => 'UIN',
            ],
        ];
    }
}

