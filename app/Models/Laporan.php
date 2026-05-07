<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_laporan',
        'user_id',
        'judul_laporan',
        'jenis_kejahatan',
        'deskripsi_kejadian',
        'kronologi',
        'waktu_kejadian',
        'tempat_kejadian',
        'korban_nama',
        'korban_alamat',
        'pelaku_nama',
        'ciri_pelaku',
        'barang_bukti',
        'status',
        'catatan_petugas',
        'hasil_penanganan',
        'penerima_id',
        'nama_penerima',
        'tanggal_diterima',
        'verifikator_id',
        'tanggal_verifikasi',
        'tracking_history',
    ];

    protected $casts = [
        'waktu_kejadian' => 'datetime',
        'tanggal_diterima' => 'datetime',
        'tanggal_verifikasi' => 'datetime',
        'tracking_history' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($laporan) {
            $laporan->no_laporan = 'LP/' . date('Ymd') . '/' . rand(1000, 9999);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'menunggu' => '<span class="badge bg-warning text-dark">MENUNGGU</span>',
            'diverifikasi' => '<span class="badge bg-info">TERVERIFIKASI</span>',
            'diproses' => '<span class="badge bg-primary">DIPROSES</span>',
            'selesai' => '<span class="badge bg-success">SELESAI</span>',
            'ditolak' => '<span class="badge bg-danger">DITOLAK</span>',
        ];
        
        return $badges[$this->status] ?? '<span class="badge bg-secondary">' . strtoupper($this->status) . '</span>';
    }

    public function getProgressAttribute()
    {
        $progress = [
            'menunggu' => 25,
            'diverifikasi' => 50,
            'diproses' => 75,
            'selesai' => 100,
            'ditolak' => 0,
        ];
        
        return $progress[$this->status] ?? 0;
    }
}