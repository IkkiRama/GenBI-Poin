<?php


namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class Ranking extends Page
{
    protected static ?string $navigationIcon = 'heroicon-s-academic-cap';

    protected static ?string $navigationLabel = 'Ranking Member';

    protected static ?string $navigationGroup = 'Ranking';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.ranking';

    public $ranking;
    public $month;
    public $komsat;
    public $isActiveMonth = null; // Untuk bulan yang aktif
    public $isActiveKomsat = null; // Untuk komsat yang aktif


    public function mount()
    {
        $this->month = null; // Default: semua bulan
        $this->komsat = null; // Default: semua komsat
        $this->ranking = $this->getRanking($this->komsat, $this->month); // Load data ranking
    }

    public function filterByMonth($month = null)
    {
        $this->month = $month; // Atur bulan sesuai yang dipilih
        $this->ranking = $this->getRanking($this->komsat, $month); // Ambil data berdasarkan komsat dan bulan

        // Update status aktif bulan
        $this->isActiveMonth = $month;
    }

    public function filterByKomsat($komsat = null)
    {
        $this->komsat = $komsat; // Dapatkan komsat yang dipilih
        $this->ranking = $this->getRanking($komsat, $this->month); // Ambil data berdasarkan komsat

        // Update status aktif komsat
        $this->isActiveKomsat = $komsat;
    }

    // Dapatkan poin dari absensi
    public function getAbsensiPoints($month = null)
    {
        $query = DB::table('absensis')
            ->select(
                'absensis.user_id',
                DB::raw('SUM(CASE
                    WHEN absensis.status = "izin" THEN 1
                    WHEN absensis.status = "hadir" THEN jadwal.jumlah_poin
                    ELSE 0
                END) AS total_absensi_points')
            )
            ->join('jadwal_absensis AS jadwal', 'absensis.jadwal_absensi_id', '=', 'jadwal.id');

        // Filter berdasarkan bulan jika ada
        if ($month) {
            $query->whereMonth('absensis.created_at', $month);
        }

        return $query->groupBy('absensis.user_id')->get();
    }

    // Dapatkan poin dari kegiatan
    public function getKegiatanPoints($month = null)
    {
        $query = DB::table('kegiatans')
            ->select('user_id', DB::raw('SUM(score) AS total_kegiatan_points'));

        // Filter berdasarkan bulan jika ada
        if ($month) {
            $query->whereMonth('kegiatans.created_at', $month);
        }

        return $query->groupBy('user_id')->get();
    }

    // Gabungkan poin absensi dan kegiatan
    public function getRanking($komsat = null, $month = null)
    {
        $absensiPoints = $this->getAbsensiPoints($month);
        $kegiatanPoints = $this->getKegiatanPoints($month);

        // Ambil data pengguna dengan role "member"
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'member');

        if ($komsat) {
            $users->where('users.komsat', $komsat);
        }

        $users = $users->select('users.id', 'users.name', 'users.komsat', 'users.bidang')->get()->keyBy('id');

        $ranking = [];

        // Gabungkan data absensi dan kegiatan
        foreach ($absensiPoints as $absensi) {
            $user = $users->get($absensi->user_id);
            if ($user) {
                $ranking[$absensi->user_id] = [
                    'user_id' => $absensi->user_id,
                    'name' => $user->name,
                    'komsat' => $user->komsat,
                    'bidang' => $user->bidang,
                    'total_points' => $absensi->total_absensi_points,
                ];
            }
        }

        foreach ($kegiatanPoints as $kegiatan) {
            $user = $users->get($kegiatan->user_id);
            if ($user) {
                if (isset($ranking[$kegiatan->user_id])) {
                    $ranking[$kegiatan->user_id]['total_points'] += $kegiatan->total_kegiatan_points;
                } else {
                    $ranking[$kegiatan->user_id] = [
                        'user_id' => $kegiatan->user_id,
                        'name' => $user->name,
                        'komsat' => $user->komsat,
                        'bidang' => $user->bidang,
                        'total_points' => $kegiatan->total_kegiatan_points,
                    ];
                }
            }
        }

        foreach ($users as $user) {
            if (!isset($ranking[$user->id])) {
                $ranking[$user->id] = [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'komsat' => $user->komsat,
                    'bidang' => $user->bidang,
                    'total_points' => 0, // Set poin 0 jika tidak ada data
                ];
            }
        }

        // Urutkan berdasarkan total_points secara descending
        return collect($ranking)->sortByDesc('total_points')->values();
    }

    public function getTabs(): array
    {
        return [
            'Semua' => null, // Tab default, tanpa filter bulan
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
        ];
    }
}
// namespace App\Filament\Pages;

// use Filament\Pages\Page;
// use Spatie\Permission\Models\Role;
// use Illuminate\Support\Facades\DB;

// class Ranking extends Page
// {
//     protected static ?string $navigationIcon = 'heroicon-o-document-text';

//     protected static string $view = 'filament.pages.ranking';

//     public $ranking;
//     public $month;

//     public function mount()
//     {
//         $this->month = null; // Default: semua bulan
//         $this->ranking = $this->getRanking(); // Load data ranking saat halaman pertama kali dimuat
//     }

//     public function filterByMonth($month = null)
//     {
//         $this->month = $month;
//         $this->ranking = $this->getRanking($month); // Ambil data berdasarkan bulan
//     }

//     // Dapatkan poin dari absensi
//     public function getAbsensiPoints($month = null)
//     {
//         $query = DB::table('absensis')
//             ->select(
//                 'absensis.user_id',
//                 DB::raw('SUM(CASE
//                     WHEN absensis.status = "izin" THEN 1
//                     WHEN absensis.status = "hadir" THEN jadwal.jumlah_poin
//                     ELSE 0
//                 END) AS total_absensi_points')
//             )
//             ->join('jadwal_absensis AS jadwal', 'absensis.jadwal_absensi_id', '=', 'jadwal.id');

//         // Filter berdasarkan bulan jika ada
//         if ($month) {
//             $query->whereMonth('absensis.created_at', $month);
//         }

//         return $query->groupBy('absensis.user_id')->get();
//     }


//     // Dapatkan poin dari kegiatan
//     public function getKegiatanPoints($month = null)
//     {
//         $query = DB::table('kegiatans')
//             ->select('user_id', DB::raw('SUM(score) AS total_kegiatan_points'));

//         // Filter berdasarkan bulan jika ada
//         if ($month) {
//             $query->whereMonth('kegiatans.created_at', $month);
//         }

//         return $query->groupBy('user_id')->get();
//     }


//     // Gabungkan poin absensi dan kegiatan
//     public function getRanking($month = null)
//     {
//         // Ambil data absensi dan kegiatan berdasarkan bulan
//         $absensiPoints = $this->getAbsensiPoints($month);
//         $kegiatanPoints = $this->getKegiatanPoints($month);

//         // Ambil hanya pengguna dengan role "member"
//         $users = DB::table('users')
//             ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id') // Relasi dengan tabel role
//             ->join('roles', 'model_has_roles.role_id', '=', 'roles.id') // Relasi dengan tabel roles
//             ->where('roles.name', 'member') // Filter untuk role "member"
//             ->select('users.id', 'users.name', 'users.komsat', 'users.bidang')
//             ->get()
//             ->keyBy('id');

//         $ranking = [];

//         // Tambahkan pengguna dengan poin absensi
//         foreach ($absensiPoints as $absensi) {
//             $user = $users->get($absensi->user_id);
//             if ($user) {
//                 $ranking[$absensi->user_id] = [
//                     'user_id' => $absensi->user_id,
//                     'name' => $user->name,
//                     'komsat' => $user->komsat,
//                     'bidang' => $user->bidang,
//                     'total_points' => $absensi->total_absensi_points,
//                 ];
//             }
//         }

//         // Tambahkan pengguna dengan poin kegiatan
//         foreach ($kegiatanPoints as $kegiatan) {
//             $user = $users->get($kegiatan->user_id);
//             if ($user) {
//                 if (isset($ranking[$kegiatan->user_id])) {
//                     $ranking[$kegiatan->user_id]['total_points'] += $kegiatan->total_kegiatan_points;
//                 } else {
//                     $ranking[$kegiatan->user_id] = [
//                         'user_id' => $kegiatan->user_id,
//                         'name' => $user->name,
//                         'komsat' => $user->komsat,
//                         'bidang' => $user->bidang,
//                         'total_points' => $kegiatan->total_kegiatan_points,
//                     ];
//                 }
//             }
//         }

//         // Tambahkan pengguna dengan poin 0 jika tidak ada di absensi atau kegiatan
//         foreach ($users as $user) {
//             if (!isset($ranking[$user->id])) {
//                 $ranking[$user->id] = [
//                     'user_id' => $user->id,
//                     'name' => $user->name,
//                     'komsat' => $user->komsat,
//                     'bidang' => $user->bidang,
//                     'total_points' => 0, // Set poin 0 jika tidak ada data di absensi atau kegiatan
//                 ];
//             }
//         }

//         // Urutkan berdasarkan total_points secara descending
//         return collect($ranking)->sortByDesc('total_points')->values();
//     }


//     public function getTabs(): array
//     {
//         return [
//             'Semua' => null, // Tab default, tanpa filter bulan
//             'Januari' => 1,
//             'Februari' => 2,
//             'Maret' => 3,
//             'April' => 4,
//             'Mei' => 5,
//             'Juni' => 6,
//             'Juli' => 7,
//             'Agustus' => 8,
//             'September' => 9,
//             'Oktober' => 10,
//             'November' => 11,
//             'Desember' => 12,
//         ];
//     }
// }
