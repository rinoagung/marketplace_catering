<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Antrian;
use App\Models\HakAkses;
use App\Models\ViewConfig;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public $todayAntrian;
    public $today;

    public function __construct()
    {
        $this->today = Carbon::today()->toDateString();
        $this->todayAntrian = User::whereDate('created_at', $this->today);
    }

    public function dashboardAuth($hak_akses_id)
    {

        if (auth()->user()->hak_akses_id != $hak_akses_id) {
            abort(403);
        }
        $totalHariIni = $this->todayAntrian
            ->count();

        $sisaAntrian = $this->todayAntrian
            ->where(function ($query) {
                $query->where('status', 'menunggu')
                    ->orWhere('status', 'tunda');
            })
            ->count();

        $status = ['all', 'menunggu', 'proses', 'selesai', 'tunda'];
        $no_antrian = ['all', 'A', 'B'];
        $data_quantity = ['5', '10', '50', '100'];

        $hitungAntrian = [
            [
                'jenis' => 'A',
                'jumlah' => 99,
            ],
            [
                'jenis' => 'B',
                'jumlah' => 99,
            ]
        ];

        return view('auth.users.dashboard', [
            // 'antrian' => Antrian::filter(request(["search", "status", "no_antrian"]))->paginate(request('data_quantity') ?: 5)->withQueryString(),
            'hak_akses_user' => HakAkses::find(auth()->user()->hak_akses_id),
            'status' => $status,
            'no_antrian' => $no_antrian,
            'data_quantity' => $data_quantity,
            'sisaAntrian' => $sisaAntrian,
            'totalHariIni' => $totalHariIni,
            'hitungAntrian' => $hitungAntrian
        ]);
    }

    public function dashboardAdmin()
    {
        $konfigurasi = ViewConfig::first();
        $totalHariIni = $this->todayAntrian->count();
        $pesananDitangani = 99;
        $pesananTotal = 99;
        $loketAktif = User::whereDate('login_terakhir', $this->today)
            ->where('id', '<>', 1)
            ->count();

        $hitungAntrian = [
            [
                'jenis' => 'A',
                'jumlah' => 99,
            ],
            [
                'jenis' => 'B',
                'jumlah' => 99,
            ]
        ];


        return view('auth.admin.dashboard', [
            'hitungAntrian' => $hitungAntrian,
            'totalHariIni' => $totalHariIni,
            'pesananDitangani' => $pesananDitangani,
            'pesananTotal' => $pesananTotal,
            'loketAktif' => $loketAktif,
            'konfigurasi' => $konfigurasi
        ]);
    }
}
