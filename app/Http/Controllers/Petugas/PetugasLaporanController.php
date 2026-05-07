<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasLaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporans = Laporan::with('user')
            ->when($request->status, function ($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->when($request->jenis, function ($q) use ($request) {
                return $q->where('jenis_kejahatan', $request->jenis);
            })
            ->when($request->search, function ($q) use ($request) {
                return $q->where('no_laporan', 'like', "%{$request->search}%")
                    ->orWhere('judul_laporan', 'like', "%{$request->search}%")
                    ->orWhereHas('user', function ($uq) use ($request) {
                        $uq->where('name', 'like', "%{$request->search}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('petugas.laporan.index', compact('laporans'));
    }

    public function show(int $id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('petugas.laporan.show', compact('laporan'));
    }

    public function cetak(int $id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('petugas.laporan.cetak', compact('laporan'));
    }

    public function terima(int $id)
    {
        $laporan = Laporan::findOrFail($id);

        $laporan->update([
            'status' => 'diverifikasi',
            'penerima_id' => Auth::id(),
            'nama_penerima' => Auth::user()->name,
            'tanggal_diterima' => now(),
            'tanggal_verifikasi' => now(),
            'verifikator_id' => Auth::id(),
        ]);

        $trackingHistory = $laporan->tracking_history;
        $tracking = [];

        if (!empty($trackingHistory)) {
            if (is_string($trackingHistory)) {
                $tracking = json_decode($trackingHistory, true) ?? [];
            } elseif (is_array($trackingHistory)) {
                $tracking = $trackingHistory;
            }
        }

        $tracking[] = [
            'status' => 'diverifikasi',
            'tanggal' => now()->toDateTimeString(),
            'catatan' => 'Laporan diterima dan diverifikasi oleh ' . Auth::user()->name,
            'petugas_id' => Auth::id()
        ];

        $laporan->update(['tracking_history' => json_encode($tracking)]);

        return redirect()->route('petugas.laporan.show', $laporan->id)
            ->with('success', 'Laporan telah diterima dan diverifikasi!');
    }

    public function proses(int $id)
    {
        $laporan = Laporan::findOrFail($id);

        $laporan->update(['status' => 'diproses']);

        $trackingHistory = $laporan->tracking_history;
        $tracking = [];

        if (!empty($trackingHistory)) {
            if (is_string($trackingHistory)) {
                $tracking = json_decode($trackingHistory, true) ?? [];
            } elseif (is_array($trackingHistory)) {
                $tracking = $trackingHistory;
            }
        }

        $tracking[] = [
            'status' => 'diproses',
            'tanggal' => now()->toDateTimeString(),
            'catatan' => 'Laporan sedang diproses oleh ' . Auth::user()->name,
            'petugas_id' => Auth::id()
        ];

        $laporan->update(['tracking_history' => json_encode($tracking)]);

        return redirect()->route('petugas.laporan.show', $laporan->id)
            ->with('success', 'Laporan sedang diproses!');
    }

    public function selesai(Request $request, int $id)
    {
        $request->validate([
            'hasil_penanganan' => 'required|string'
        ]);

        $laporan = Laporan::findOrFail($id);

        $laporan->update([
            'status' => 'selesai',
            'hasil_penanganan' => $request->hasil_penanganan
        ]);

        $trackingHistory = $laporan->tracking_history;
        $tracking = [];

        if (!empty($trackingHistory)) {
            if (is_string($trackingHistory)) {
                $tracking = json_decode($trackingHistory, true) ?? [];
            } elseif (is_array($trackingHistory)) {
                $tracking = $trackingHistory;
            }
        }

        $tracking[] = [
            'status' => 'selesai',
            'tanggal' => now()->toDateTimeString(),
            'catatan' => 'Laporan selesai ditangani. Hasil: ' . $request->hasil_penanganan,
            'petugas_id' => Auth::id()
        ];

        $laporan->update(['tracking_history' => json_encode($tracking)]);

        return redirect()->route('petugas.laporan.show', $laporan->id)
            ->with('success', 'Laporan selesai!');
    }

    public function tolak(Request $request, int $id)
    {
        $request->validate([
            'catatan_petugas' => 'required|string'
        ]);

        $laporan = Laporan::findOrFail($id);

        $laporan->update([
            'status' => 'ditolak',
            'catatan_petugas' => $request->catatan_petugas
        ]);

        $trackingHistory = $laporan->tracking_history;
        $tracking = [];

        if (!empty($trackingHistory)) {
            if (is_string($trackingHistory)) {
                $tracking = json_decode($trackingHistory, true) ?? [];
            } elseif (is_array($trackingHistory)) {
                $tracking = $trackingHistory;
            }
        }

        $tracking[] = [
            'status' => 'ditolak',
            'tanggal' => now()->toDateTimeString(),
            'catatan' => 'Laporan ditolak. Alasan: ' . $request->catatan_petugas,
            'petugas_id' => Auth::id()
        ];

        $laporan->update(['tracking_history' => json_encode($tracking)]);

        return redirect()->route('petugas.laporan.show', $laporan->id)
            ->with('error', 'Laporan ditolak!');
    }
}
