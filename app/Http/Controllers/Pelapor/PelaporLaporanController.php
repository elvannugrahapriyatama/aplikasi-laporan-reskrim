<?php

namespace App\Http\Controllers\Pelapor;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelaporLaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::where('user_id', Auth::id())->latest()->paginate(10);
        return view('pelapor.laporan.index', compact('laporans'));
    }

    public function create()
    {
        return view('pelapor.laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_laporan' => 'required',
            'jenis_kejahatan' => 'required',
            'deskripsi_kejadian' => 'required',
            'waktu_kejadian' => 'required|date',
            'tempat_kejadian' => 'required',
        ]);

        Laporan::create([
            'user_id' => Auth::id(),
            'no_laporan' => 'LP/' . date('Ymd') . '/' . rand(1000, 9999),
            'judul_laporan' => $request->judul_laporan,
            'jenis_kejahatan' => $request->jenis_kejahatan,
            'deskripsi_kejadian' => $request->deskripsi_kejadian,
            'kronologi' => $request->kronologi,
            'waktu_kejadian' => $request->waktu_kejadian,
            'tempat_kejadian' => $request->tempat_kejadian,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pelapor.laporan.index')->with('success', 'Laporan berhasil dikirim!');
    }

    public function show(Laporan $laporan)
    {
        if ($laporan->user_id != Auth::id()) {
            abort(403);
        }
        return view('pelapor.laporan.show', compact('laporan'));
    }

    public function cetak(Laporan $laporan)
    {
        if ($laporan->user_id != Auth::id()) {
            abort(403);
        }
        return view('pelapor.laporan.cetak', compact('laporan'));
    }
}