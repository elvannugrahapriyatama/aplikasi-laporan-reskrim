<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan - {{ $laporan->no_laporan }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 2cm;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 16pt;
            margin: 0;
            letter-spacing: 1px;
        }

        .header h2 {
            font-size: 14pt;
            margin: 5px 0;
        }

        .header h3 {
            font-size: 12pt;
            margin: 5px 0;
        }

        .header p {
            font-size: 10pt;
            margin-top: 5px;
        }

        .title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin: 20px 0;
            text-decoration: underline;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table tr {
            border: none;
        }

        .info-table td {
            padding: 6px 5px;
            vertical-align: top;
            border: none;
        }

        .info-table td:first-child {
            width: 30%;
            font-weight: bold;
        }

        .section-title {
            font-size: 12pt;
            font-weight: bold;
            margin: 15px 0 10px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #ccc;
        }

        .content-text {
            text-align: justify;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .signature {
            margin-top: 40px;
            width: 100%;
        }

        .signature td {
            width: 50%;
            text-align: center;
            padding-top: 30px;
        }

        .signature-line {
            margin-top: 50px;
        }

        hr {
            margin: 20px 0;
            border: 0.5px solid #ccc;
        }

        .footer-note {
            font-size: 9pt;
            text-align: center;
            margin-top: 30px;
            color: #666;
        }

        @media print {
            body {
                margin: 1.5cm;
            }

            .no-print {
                display: none;
            }

            .page-break {
                page-break-before: always;
            }
        }

        .no-print {
            text-align: center;
            margin-bottom: 20px;
            position: sticky;
            top: 10px;
            z-index: 100;
        }

        .btn-cetak,
        .btn-tutup {
            padding: 10px 20px;
            margin: 0 5px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12pt;
            font-family: inherit;
        }

        .btn-cetak {
            background-color: #0A3A5C;
            color: white;
        }

        .btn-tutup {
            background-color: #E63946;
            color: white;
        }

        .btn-cetak:hover,
        .btn-tutup:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="no-print">
        <button class="btn-cetak" onclick="window.print()">🖨️ Cetak</button>
        <button class="btn-tutup" onclick="window.close()">❌ Tutup</button>
    </div>

    <div class="header">
        <h1>KEPOLISIAN NEGARA REPUBLIK INDONESIA</h1>
        <h2>RESOR KOTA BANDUNG</h2>
        <h3>SEKTOR MARGAHAYU</h3>
        <p>Jl. Terusan Kopo No. 385/299 Kec. Margahayu Kab. Bandung</p>
    </div>

    <div class="title">
        LAPORAN HASIL PENANGANAN
    </div>

    <div class="content">
        <table class="info-table">
            <tr>
                <td>Nomor Laporan</td>
                <td>: {{ $laporan->no_laporan }}</td>
            </tr>
            <tr>
                <td>Tanggal Laporan</td>
                <td>: {{ $laporan->created_at ? $laporan->created_at->format('d/m/Y H:i:s') : '-' }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: {{ ucfirst($laporan->status) }}</td>
            </tr>
        </table>

        <div class="section-title">DATA PELAPOR</div>
        <table class="info-table">
            <tr>
                <td>Nama</td>
                <td>: {{ $laporan->user ? $laporan->user->name : '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $laporan->user ? $laporan->user->alamat : '-' }}</td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>: {{ $laporan->user ? $laporan->user->no_telepon : '-' }}</td>
            </tr>
            <tr>
                <td>No. Identitas</td>
                <td>: {{ $laporan->user ? $laporan->user->no_identitas : '-' }}</td>
            </tr>
        </table>

        <div class="section-title">DATA LAPORAN</div>
        <table class="info-table">
            <tr>
                <td>Judul Laporan</td>
                <td>: {{ $laporan->judul_laporan }}</td>
            </tr>
            <tr>
                <td>Jenis Kejahatan</td>
                <td>: {{ str_replace('_', ' ', ucfirst($laporan->jenis_kejahatan)) }}</td>
            </tr>
            <tr>
                <td>Waktu Kejadian</td>
                <td>: {{ $laporan->waktu_kejadian ? $laporan->waktu_kejadian->format('d/m/Y H:i') : '-' }} WIB</td>
            </tr>
            <tr>
                <td>Tempat Kejadian</td>
                <td>: {{ $laporan->tempat_kejadian }}</td>
            </tr>
        </table>

        <div class="section-title">DESKRIPSI KEJADIAN</div>
        <div class="content-text">{{ nl2br($laporan->deskripsi_kejadian) }}</div>

        @if ($laporan->kronologi)
            <div class="section-title">KRONOLOGI KEJADIAN</div>
            <div class="content-text">{{ nl2br($laporan->kronologi) }}</div>
        @endif

        @if ($laporan->korban_nama)
            <div class="section-title">DATA KORBAN</div>
            <table class="info-table">
                <tr>
                    <td>Nama Korban</td>
                    <td>: {{ $laporan->korban_nama }}</td>
                </tr>
                @if ($laporan->korban_alamat)
                    <tr>
                        <td>Alamat Korban</td>
                        <td>: {{ $laporan->korban_alamat }}</td>
                    </tr>
                @endif
            </table>
        @endif

        @if ($laporan->pelaku_nama)
            <div class="section-title">DATA PELAKU</div>
            <table class="info-table">
                <tr>
                    <td>Nama Pelaku</td>
                    <td>: {{ $laporan->pelaku_nama }}</td>
                </tr>
                @if ($laporan->ciri_pelaku)
                    <tr>
                        <td>Ciri-ciri Pelaku</td>
                        <td>: {{ $laporan->ciri_pelaku }}</td>
                    </tr>
                @endif
            </table>
        @endif

        @if ($laporan->barang_bukti)
            <div class="section-title">BARANG BUKTI</div>
            <div class="content-text">{{ nl2br($laporan->barang_bukti) }}</div>
        @endif

        @if ($laporan->hasil_penanganan)
            <div class="section-title">HASIL PENANGANAN</div>
            <div class="content-text">{{ nl2br($laporan->hasil_penanganan) }}</div>
        @endif

        @if ($laporan->catatan_petugas && $laporan->status == 'ditolak')
            <div class="section-title">ALASAN PENOLAKAN</div>
            <div class="content-text">{{ nl2br($laporan->catatan_petugas) }}</div>
        @endif
    </div>

    <hr>

    <table class="signature">
        <tr>
            <td>
                Pelapor,<br><br><br><br>
                <u>{{ $laporan->user ? $laporan->user->name : '_________________' }}</u>
            </td>
            <td>
                Bandung, {{ date('d F Y') }}<br>
                Petugas Penanganan,<br><br><br><br>
                <u>{{ $laporan->nama_penerima ?? '_________________' }}</u>
            </td>
        </tr>
    </table>

    <div class="footer-note">
        Dokumen ini dicetak secara elektronik dan tidak memerlukan tanda tangan basah.
    </div>
</body>

</html>
