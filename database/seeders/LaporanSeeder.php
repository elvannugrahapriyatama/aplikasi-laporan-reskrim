<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama (opsional)
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Laporan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $pelapor = User::where('role', 'pelapor')->first();
        if (!$pelapor) {
            $this->command->error('pelapor tidak ditemukan! Jalankan UserSeeder dulu.');
            return;
        }

        $petugas = User::where('role', 'petugas')->first();
        if (!$petugas) {
            $this->command->error('User petugas tidak ditemukan! Jalankan UserSeeder dulu.');
            return;
        }

        // Pastikan ada user petugas
        $petugas = User::where('role', 'petugas')->first();
        if (!$petugas) {
            $petugas = User::create([
                'name' => 'Petugas Reskrim',
                'email' => 'petugas@example.com',
                'password' => bcrypt('password'),
                'role' => 'petugas',
                'no_telepon' => '081298765432',
                'alamat' => 'Polres Metro Jakarta',
                'no_identitas' => '3175020101900001',
                'nip' => '197501012005011001',
                'pangkat' => 'Iptu',
                'jabatan' => 'Kanit Reskrim',
            ]);
        }

        // Data laporan dengan berbagai status dan tanggal
        $laporans = [
            // Laporan MENUNGGU (2 laporan - baru)
            [
                'judul' => 'Pencurian Sepeda Motor di Parkiran Mall',
                'jenis' => 'pencurian',
                'deskripsi' => 'Sepeda motor Honda Beat warna hitam hilang dari parkiran mall saat saya berbelanja',
                'kronologi' => 'Saya memarkir motor pukul 14:00 WIB. Pulang pukul 16:30 WIB motor sudah tidak ada. CCTV parkiran sedang rusak.',
                'waktu_kejadian' => Carbon::now()->subDays(2)->setTime(14, 0),
                'tempat' => 'Parkiran Mall Grand Indonesia, Jakarta Pusat',
                'status' => 'menunggu',
                'created_at' => Carbon::now()->subDays(2),
                'tanggal_diterima' => null,
                'tanggal_verifikasi' => null,
                'verifikator_id' => null,
                'penerima_id' => null,
                'nama_penerima' => null,
            ],
            [
                'judul' => 'Penipuan Online Jual Beli di Marketplace',
                'jenis' => 'penipuan',
                'deskripsi' => 'Saya mentransfer uang Rp 2.500.000 untuk pembelian iPhone, setelah transfer penjual menghilang',
                'kronologi' => 'Order tgl 10 April, transfer 11 April, setelah chat di blokir penjual',
                'waktu_kejadian' => Carbon::now()->subDays(1)->setTime(10, 0),
                'tempat' => 'Online - Shopee',
                'status' => 'menunggu',
                'created_at' => Carbon::now()->subDays(1),
                'tanggal_diterima' => null,
                'tanggal_verifikasi' => null,
                'verifikator_id' => null,
                'penerima_id' => null,
                'nama_penerima' => null,
            ],

            // Laporan DIVERIFIKASI (2 laporan)
            [
                'judul' => 'Penganiayaan di Depan Club Malam',
                'jenis' => 'penganiayaan',
                'deskripsi' => 'Saya dipukul oleh sekelompok orang tak dikenal di depan club malam',
                'kronologi' => 'Kejadian pukul 01:00 WIB, pelaku sekitar 5 orang. Saya mengalami luka memar di wajah.',
                'waktu_kejadian' => Carbon::now()->subDays(5)->setTime(1, 0),
                'tempat' => 'Jl. Senopati No. 88, Jakarta Selatan',
                'status' => 'diverifikasi',
                'created_at' => Carbon::now()->subDays(5),
                'tanggal_diterima' => Carbon::now()->subDays(4),
                'tanggal_verifikasi' => Carbon::now()->subDays(3),
                'verifikator_id' => $petugas->id,
                'penerima_id' => $petugas->id,
                'nama_penerima' => $petugas->name,
            ],
            [
                'judul' => 'Pengerusakan Pagar Rumah oleh Tetangga',
                'jenis' => 'pengerusakan',
                'deskripsi' => 'Tetangga merusak pagar rumah dengan mobilnya secara sengaja',
                'kronologi' => 'Tetangga mengaku pagar saya menghalangi akses, padahal sudah ada sejak 10 tahun',
                'waktu_kejadian' => Carbon::now()->subDays(7)->setTime(15, 30),
                'tempat' => 'Perumahan Citra Garden, Blok A5 No. 12',
                'status' => 'diverifikasi',
                'created_at' => Carbon::now()->subDays(7),
                'tanggal_diterima' => Carbon::now()->subDays(6),
                'tanggal_verifikasi' => Carbon::now()->subDays(5),
                'verifikator_id' => $petugas->id,
                'penerima_id' => $petugas->id,
                'nama_penerima' => $petugas->name,
            ],

            // Laporan DIPROSES (2 laporan)
            [
                'judul' => 'Narkoba Jenis Sabu di Kos-kosan',
                'jenis' => 'narkoba',
                'deskripsi' => 'Menemukan aktivitas transaksi narkoba di kos sebelah',
                'kronologi' => 'Bau sabu tercium dari kos nomor 5, sering ada orang keluar masuk malam hari',
                'waktu_kejadian' => Carbon::now()->subDays(10)->setTime(22, 0),
                'tempat' => 'Kosan Putri Harmoni, Jl. Cendrawasih No. 23',
                'status' => 'diproses',
                'created_at' => Carbon::now()->subDays(10),
                'tanggal_diterima' => Carbon::now()->subDays(9),
                'tanggal_verifikasi' => Carbon::now()->subDays(8),
                'verifikator_id' => $petugas->id,
                'penerima_id' => $petugas->id,
                'nama_penerima' => $petugas->name,
                'catatan_petugas' => 'Sedang dalam penyelidikan, sudah mengirim tim ke lapangan',
                'target_selesai' => Carbon::now()->addDays(7),
            ],
            [
                'judul' => 'KDRT Suami terhadap Istri',
                'jenis' => 'kekerasan_dalam_rumah_tangga',
                'deskripsi' => 'Suami melakukan kekerasan fisik terhadap istri',
                'kronologi' => 'Kejadian sudah berulang kali, terakhir korban dipukul menggunakan gagang sapu',
                'waktu_kejadian' => Carbon::now()->subDays(12)->setTime(20, 0),
                'tempat' => 'Jl. Melati No. 45, Perumahan Bumi Indah',
                'status' => 'diproses',
                'created_at' => Carbon::now()->subDays(12),
                'tanggal_diterima' => Carbon::now()->subDays(11),
                'tanggal_verifikasi' => Carbon::now()->subDays(10),
                'verifikator_id' => $petugas->id,
                'penerima_id' => $petugas->id,
                'nama_penerima' => $petugas->name,
                'catatan_petugas' => 'Korban sudah diamankan, pelaku dalam pengejaran',
                'target_selesai' => Carbon::now()->addDays(14),
            ],

            // Laporan SELESAI (3 laporan)
            [
                'judul' => 'Pencurian HP di Angkutan Umum',
                'jenis' => 'pencurian',
                'deskripsi' => 'HP iPhone 13 hilang saat naik bus TransJakarta',
                'kronologi' => 'HP ada di saku celana, setelah turun bus HP sudah tidak ada',
                'waktu_kejadian' => Carbon::now()->subDays(20)->setTime(8, 0),
                'tempat' => 'Bus TransJakarta Koridor 1, Halte Blok M',
                'status' => 'selesai',
                'created_at' => Carbon::now()->subDays(20),
                'tanggal_diterima' => Carbon::now()->subDays(19),
                'tanggal_verifikasi' => Carbon::now()->subDays(18),
                'verifikator_id' => $petugas->id,
                'penerima_id' => $petugas->id,
                'nama_penerima' => $petugas->name,
                'catatan_petugas' => 'Pelaku berhasil diamankan, HP dikembalikan ke korban',
                'hasil_penanganan' => 'Pelaku ditangkap di rumahnya, barang bukti HP ditemukan',
                'tracking_history' => json_encode([
                    ['status' => 'diverifikasi', 'tanggal' => Carbon::now()->subDays(18)->toDateTimeString(), 'catatan' => 'Laporan valid'],
                    ['status' => 'diproses', 'tanggal' => Carbon::now()->subDays(15)->toDateTimeString(), 'catatan' => 'Tim diterjunkan'],
                    ['status' => 'selesai', 'tanggal' => Carbon::now()->subDays(10)->toDateTimeString(), 'catatan' => 'Kasus selesai'],
                ]),
            ],
            [
                'judul' => 'Pencabulan Anak di Bawah Umur',
                'jenis' => 'pencabulan',
                'deskripsi' => 'Anak saya (7 tahun) menjadi korban pencabulan oleh tetangga',
                'kronologi' => 'Kejadian saat anak bermain di rumah tetangga, korban mengaku disetubuhi',
                'waktu_kejadian' => Carbon::now()->subDays(30)->setTime(14, 0),
                'tempat' => 'Jl. Kenanga No. 12, RT 05 RW 03',
                'status' => 'selesai',
                'created_at' => Carbon::now()->subDays(30),
                'tanggal_diterima' => Carbon::now()->subDays(29),
                'tanggal_verifikasi' => Carbon::now()->subDays(28),
                'verifikator_id' => $petugas->id,
                'penerima_id' => $petugas->id,
                'nama_penerima' => $petugas->name,
                'catatan_petugas' => 'Pelaku sudah ditahan, korban mendapat pendampingan psikolog',
                'hasil_penanganan' => 'Pelaku dijerat UU Perlindungan Anak, kasus sudah P21',
                'tracking_history' => json_encode([
                    ['status' => 'diverifikasi', 'tanggal' => Carbon::now()->subDays(28)->toDateTimeString(), 'catatan' => 'Ada saksi dan bukti'],
                    ['status' => 'diproses', 'tanggal' => Carbon::now()->subDays(25)->toDateTimeString(), 'catatan' => 'Penyidikan berjalan'],
                    ['status' => 'selesai', 'tanggal' => Carbon::now()->subDays(5)->toDateTimeString(), 'catatan' => 'Berkas dilimpahkan ke JPU'],
                ]),
            ],
            [
                'judul' => 'Pelanggaran Lalu Lintas Tabrak Lari',
                'jenis' => 'lalu_lintas',
                'deskripsi' => 'Mobil hitam menabrak motor saya lalu kabur',
                'kronologi' => 'Kejadian di lampu merah, mobil dari belakang menabrak lalu tancap gas',
                'waktu_kejadian' => Carbon::now()->subDays(15)->setTime(17, 0),
                'tempat' => 'Simpang Tiga Jl. Sudirman - Jl. Gatot Subroto',
                'status' => 'selesai',
                'created_at' => Carbon::now()->subDays(15),
                'tanggal_diterima' => Carbon::now()->subDays(14),
                'tanggal_verifikasi' => Carbon::now()->subDays(13),
                'verifikator_id' => $petugas->id,
                'penerima_id' => $petugas->id,
                'nama_penerima' => $petugas->name,
                'catatan_petugas' => 'Pelaku teridentifikasi dari CCTV, sudah dimintai keterangan',
                'hasil_penanganan' => 'Pelaku membayar ganti rugi dan membuat pernyataan tidak mengulangi',
                'tracking_history' => json_encode([
                    ['status' => 'diverifikasi', 'tanggal' => Carbon::now()->subDays(13)->toDateTimeString(), 'catatan' => 'CCTV jelas terlihat plat nomor'],
                    ['status' => 'diproses', 'tanggal' => Carbon::now()->subDays(10)->toDateTimeString(), 'catatan' => 'Pelaku dipanggil'],
                    ['status' => 'selesai', 'tanggal' => Carbon::now()->subDays(7)->toDateTimeString(), 'catatan' => 'Restorative justice'],
                ]),
            ],

            // Laporan DITOLAK (1 laporan)
            [
                'judul' => 'Laporan Hoaks Penculikan Anak',
                'jenis' => 'lainnya',
                'deskripsi' => 'Laporan penculikan anak yang ternyata tidak benar',
                'kronologi' => 'Informasi beredar di WA, setelah diselidiki ternyata hoaks',
                'waktu_kejadian' => Carbon::now()->subDays(3)->setTime(9, 0),
                'tempat' => 'Perumahan Griya Asri',
                'status' => 'ditolak',
                'created_at' => Carbon::now()->subDays(3),
                'tanggal_diterima' => Carbon::now()->subDays(2),
                'tanggal_verifikasi' => Carbon::now()->subDays(1),
                'verifikator_id' => $petugas->id,
                'penerima_id' => $petugas->id,
                'nama_penerima' => $petugas->name,
                'catatan_petugas' => 'Laporan tidak valid, tidak ada kejadian sebenarnya',
            ],
        ];

        // Insert laporan dengan no_laporan otomatis
        foreach ($laporans as $data) {
            $no_laporan = 'LP/' . $data['created_at']->format('Ymd') . '/' . rand(1000, 9999);

            Laporan::create([
                'no_laporan' => $no_laporan,
                'user_id' => $pelapor->id,
                'judul_laporan' => $data['judul'],
                'jenis_kejahatan' => $data['jenis'],
                'deskripsi_kejadian' => $data['deskripsi'],
                'kronologi' => $data['kronologi'],
                'waktu_kejadian' => $data['waktu_kejadian'],
                'tempat_kejadian' => $data['tempat'],
                'status' => $data['status'],
                'catatan_petugas' => $data['catatan_petugas'] ?? null,
                'tanggal_verifikasi' => $data['tanggal_verifikasi'],
                'verifikator_id' => $data['verifikator_id'],
                'penerima_id' => $data['penerima_id'],
                'nama_penerima' => $data['nama_penerima'],
                'tanggal_diterima' => $data['tanggal_diterima'],
                'hasil_penanganan' => $data['hasil_penanganan'] ?? null,
                'target_selesai' => $data['target_selesai'] ?? null,
                'tracking_history' => $data['tracking_history'] ?? null,
                'created_at' => $data['created_at'],
                'updated_at' => $data['created_at'],
            ]);
        }

        // Tambah 2 laporan lagi untuk bulan-bulan sebelumnya (agar chart bulanan terlihat)
        $olderLaporans = [
            [
                'judul' => 'Pencurian di Minimarket',
                'jenis' => 'pencurian',
                'bulan_offset' => 2, // 2 bulan lalu
                'status' => 'selesai',
            ],
            [
                'judul' => 'Penganiayaan di Pasar',
                'jenis' => 'penganiayaan',
                'bulan_offset' => 3, // 3 bulan lalu
                'status' => 'selesai',
            ],
            [
                'judul' => 'Penipuan Arisan Online',
                'jenis' => 'penipuan',
                'bulan_offset' => 1, // 1 bulan lalu
                'status' => 'selesai',
            ],
        ];

        foreach ($olderLaporans as $data) {
            $createdAt = Carbon::now()->subMonths($data['bulan_offset'])->setDay(rand(1, 28));

            Laporan::create([
                'no_laporan' => 'LP/' . $createdAt->format('Ymd') . '/' . rand(1000, 9999),
                'user_id' => $pelapor->id,
                'judul_laporan' => $data['judul'],
                'jenis_kejahatan' => $data['jenis'],
                'deskripsi_kejadian' => 'Deskripsi ' . $data['judul'],
                'kronologi' => 'Kronologi ' . $data['judul'],
                'waktu_kejadian' => $createdAt->copy()->setTime(rand(8, 20), 0),
                'tempat_kejadian' => 'Jakarta',
                'status' => $data['status'],
                'tanggal_verifikasi' => $createdAt->copy()->addDay(),
                'verifikator_id' => $petugas->id,
                'penerima_id' => $petugas->id,
                'nama_penerima' => $petugas->name,
                'tanggal_diterima' => $createdAt->copy()->addDay(),
                'hasil_penanganan' => 'Kasus selesai',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }

        $this->command->info('✅ Seeder Laporan berhasil dijalankan!');
        $this->command->info('📊 Total laporan: ' . Laporan::count());
        $this->command->info('   - Menunggu: ' . Laporan::where('status', 'menunggu')->count());
        $this->command->info('   - Diverifikasi: ' . Laporan::where('status', 'diverifikasi')->count());
        $this->command->info('   - Diproses: ' . Laporan::where('status', 'diproses')->count());
        $this->command->info('   - Selesai: ' . Laporan::where('status', 'selesai')->count());
        $this->command->info('   - Ditolak: ' . Laporan::where('status', 'ditolak')->count());
    }
}
