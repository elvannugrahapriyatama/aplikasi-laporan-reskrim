<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        $totalLaporan = Laporan::count();
        
        $laporanHariIni = Laporan::whereDate('created_at', today())->count();
        
        $laporanSelesai = Laporan::where('status', 'selesai')->count();
        
        $laporanDiproses = Laporan::where('status', 'diproses')->count();
        
        $laporanPerStatus = Laporan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) {
                $statusLabels = [
                    'menunggu' => 'Menunggu',
                    'diverifikasi' => 'Diverifikasi',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
                    'ditolak' => 'Ditolak'
                ];
                $label = $statusLabels[$item->status] ?? ucfirst($item->status);
                return [$label => $item->total];
            })
            ->toArray();
        
        $defaultStatus = [
            'Menunggu' => 0,
            'Diverifikasi' => 0,
            'Diproses' => 0,
            'Selesai' => 0,
            'Ditolak' => 0
        ];
        $laporanPerStatus = array_merge($defaultStatus, $laporanPerStatus);
        
        $laporanPerBulan = Laporan::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                $date = \Carbon\Carbon::createFromDate($item->year, $item->month, 1);
                return [
                    'bulan' => $date->format('M Y'),
                    'total' => $item->total
                ];
            })
            ->toArray();
        
        $allMonths = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthKey = $date->format('M Y');
            $allMonths[$monthKey] = 0;
        }
        
        foreach ($laporanPerBulan as $item) {
            $allMonths[$item['bulan']] = $item['total'];
        }
        
        $laporanPerBulanFormatted = [];
        foreach ($allMonths as $bulan => $total) {
            $laporanPerBulanFormatted[] = [
                'bulan' => $bulan,
                'total' => $total
            ];
        }
        
        $laporanTerbaru = Laporan::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('petugas.dashboard', compact(
            'totalLaporan',
            'laporanHariIni', 
            'laporanSelesai',
            'laporanDiproses',
            'laporanPerStatus',
            'laporanPerBulanFormatted',
            'laporanTerbaru'
        ));
    }
}