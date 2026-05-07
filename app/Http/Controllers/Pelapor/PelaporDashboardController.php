<?php

namespace App\Http\Controllers\Pelapor;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class PelaporDashboardController extends Controller
{
    public function index()
    {
        $laporanSaya = Laporan::where('user_id', Auth::id())->latest()->get();
        
        return view('pelapor.dashboard', [
            'laporanSaya' => $laporanSaya,
            'totalLaporan' => $laporanSaya->count(),
            'laporanMenunggu' => $laporanSaya->where('status', 'menunggu')->count(),
            'laporanDiproses' => $laporanSaya->where('status', 'diproses')->count(),
            'laporanSelesai' => $laporanSaya->where('status', 'selesai')->count(),
        ]);
    }
}