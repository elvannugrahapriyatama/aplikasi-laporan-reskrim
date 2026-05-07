<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan - {{ $laporan->no_laporan }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 2cm;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h1 { font-size: 18pt; margin: 0; }
        .header h2 { font-size: 14pt; margin: 5px 0; }
        .header h3 { font-size: 12pt; margin: 5px 0; }
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
        .info-table td {
            padding: 5px;
            vertical-align: top;
        }
        .info-table td:first-child {
            width: 30%;
            font-weight: bold;
        }
        .content { margin-top: 20px; }
        .content h4 { font-size: 12pt; margin: 10px 0; }
        .content p { text-align: justify; line-height: 1.5; }
        .footer { margin-top: 50px; text-align: right; }
        .signature {
            margin-top: 30px;
            width: 100%;
        }
        .signature td {
            width: 50%;
            text-align: center;
        }
        hr { margin: 20px 0; }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px;">🖨️ Cetak</button>
        <button onclick="window.close()" style="padding: 10px 20px;">❌ Tutup</button>
    </div>

    <div class="header">
        <h1>KEPOLISIAN NEGARA REPUBLIK INDONESIA</h1>
        <h2>RESOR KOTA BANDUNG</h2>
        <h3>SEKTOR MARGAHAYU</h3>
        <p>Jl. Terusan Kopo No. 385/299 Kec. Margahayu Kab. Bandung</p>
    </div>

    <div class="title">
        SURAT TANDA PENERIMAAN LAPORAN POLISI
    </div>

    <div class="content">
        <table class="info-table">
            <tr><td>Nomor Laporan</td><td>: {{ $laporan->no_laporan }}</td></tr>
            <tr><td>Tanggal Laporan</td><td>: {{ $laporan->created_at->format('d/m/Y H:i:s') }}</td></tr>
            <tr><td>Status</td><td>: {{ ucfirst($laporan->status) }}</td></tr>
        </table>

        <h4>A. DATA PELAPOR</h4>
        <table class="info-table">
            <tr><td>Nama</td><td>: {{ $laporan->user->name ?? '-' }}</td></tr>
            <tr><td>Alamat</td><td>: {{ $laporan->user->alamat ?? '-' }}</td></tr>
            <tr><td>No. Telepon</td><td>: {{ $laporan->user->no_telepon ?? '-' }}</td></tr>
        </table>

        <h4>B. DATA LAPORAN</h4>
        <table class="info-table">
            <tr><td>Judul Laporan</td><td>: {{ $laporan->judul_laporan }}</td></tr>
            <tr><td>Jenis Kejahatan</td><td>: {{ str_replace('_', ' ', ucfirst($laporan->jenis_kejahatan)) }}</td></tr>
            <tr><td>Waktu Kejadian</td><td>: {{ $laporan->waktu_kejadian->format('d/m/Y H:i') }}</td></tr>
            <tr><td>Tempat Kejadian</td><td>: {{ $laporan->tempat_kejadian }}</td></tr>
        </table>

        <h4>C. DESKRIPSI KEJADIAN</h4>
        <p>{{ nl2br($laporan->deskripsi_kejadian) }}</p>

        @if($laporan->kronologi)
            <h4>D. KRONOLOGI KEJADIAN</h4>
            <p>{{ nl2br($laporan->kronologi) }}</p>
        @endif

        @if($laporan->hasil_penanganan)
            <h4>E. HASIL PENANGANAN</h4>
            <p>{{ nl2br($laporan->hasil_penanganan) }}</p>
        @endif
    </div>

    <hr>

    <table class="signature">
        <tr>
            <td>
                Pelapor,<br><br><br><br>
                <u>{{ $laporan->user->name ?? '_________________' }}</u>
            </td>
            <td>
                Bandung, {{ date('d F Y') }}<br>
                Penerima Laporan,<br><br><br><br>
                <u>{{ $laporan->nama_penerima ?? '_________________' }}</u>
            </td>
        </tr>
    </table>
</body>
</html>