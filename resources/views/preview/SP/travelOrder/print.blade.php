<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Surat Perintah, SPPD & Laporan Perjalanan Dinas</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            font-size: 10pt;
            line-height: 1.3;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }

        /* TOMBOL ACTIONS */
        .action-buttons {
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 297mm;
            margin: 0 auto 20px auto;
            padding: 15px 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn {
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit {
            background-color: #3b82f6;
            color: white;
        }

        .btn-edit:hover {
            background-color: #2563eb;
        }

        .btn-print {
            background-color: #10b981;
            color: white;
        }

        .btn-print:hover {
            background-color: #059669;
        }

        .btn-back {
            background-color: #6b7280;
            color: white;
        }

        .btn-back:hover {
            background-color: #4b5563;
        }

        /* KOP SURAT */
        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 5px;
            padding-left: 100px;
            margin-bottom: 10px;
            position: relative;
            min-height: 100px;
        }

        .header img {
            position: absolute;
            left: 0;
            top: 0;
            width: auto;
            height: 130px;
        }

        .header h3,
        .header h2,
        .header h4,
        .header p {
            margin: 0;
        }

        .header h4 {
            font-size: 14pt;
            font-weight: bold;
        }

        .header h2 {
            font-size: 18pt;
            font-weight: bold;
        }

        .header .address {
            font-family: Tahoma;
            font-size: 9pt;
            font-weight: normal;
            text-align: center;
            line-height: 1.4;
            color: #000;
        }

        .header .address a {
            text-decoration: none;
            color: #000;
        }

        /* TABEL GLOBAL */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        td,
        th {
            vertical-align: top;
            padding: 3px;
        }

        .bordered,
        .bordered td,
        .bordered th {
            border: 1px solid black;
        }

        .no-border,
        .no-border td {
            border: none;
        }

        .sppd-table td {
            font-size: 9pt;
        }

        .validation-table td {
            font-size: 9pt;
        }

        /* HALAMAN PORTRAIT */
        .page-portrait {
            background-color: white;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto 20px auto;
            padding: 10mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .portrait-content {
            padding: 0 10mm;
        }

        /* HALAMAN LANDSCAPE */
        .page-landscape-wrapper {
            margin-bottom: 20px;
        }

        .page-landscape {
            background-color: white;
            width: 297mm;
            min-height: 210mm;
            margin: 0 auto;
            padding: 10mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .sppd-container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .col-left {
            width: 50%;
            padding-right: 15px;
            display: flex;
            flex-direction: column;
        }

        .col-right {
            width: 50%;
            padding-left: 15px;
        }

        /* PRINT */
        @media print {
            .action-buttons {
                display: none !important;
            }

            body {
                background: none;
                margin: 0;
                padding: 0;
            }

            .page-portrait,
            .page-landscape {
                margin: 0;
                box-shadow: none;
                width: 100%;
                page-break-inside: avoid;
            }

            .page-portrait.surat-perintah {
                page-break-after: always;
            }

            .page-landscape-wrapper {
                page-break-before: always;
                page: landscape-page;
            }

            .page-landscape-wrapper.last-page {
                page-break-after: always;
            }

            .page-portrait.laporan-page {
                page-break-before: always;
                page-break-after: avoid !important;
                page: portrait-page;
            }
        }

        @page portrait-page {
            size: A4 portrait;
            margin: 10mm;
        }

        @page landscape-page {
            size: A4 landscape;
            margin: 10mm;
        }

        @page {
            size: A4 portrait;
            margin: 0;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>

    {{-- TOMBOL AKSI --}}
    <div class="action-buttons">
        <a href="{{ route('sp.travelOrders.index') }}" class="btn btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('sp.travelOrders.edit', $travelOrder->id) }}" class="btn btn-edit">
            <i class="fa-solid fa-edit"></i> Edit
        </a>
        <button onclick="handlePrint()" class="btn btn-print">
            <i class="fa-solid fa-print"></i> Print
        </button>
    </div>

    @php
        $headmaster = $travelOrder->headmaster?->employee;
        $headmasterName = $headmaster?->full_name ?? 'Kepala Sekolah';
        $headmasterNip = $headmaster?->nip ?? '-';
    @endphp

    {{-- ═══════════════════════════════════════
     HALAMAN 1 - SURAT PERINTAH (Portrait)
═══════════════════════════════════════════ --}}
    <div class="page-portrait surat-perintah">
        <div class="header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Coat_of_arms_of_West_Java.svg/500px-Coat_of_arms_of_West_Java.svg.png"
                alt="Logo" />
            <h4>PEMERINTAH DAERAH PROVINSI JAWA BARAT</h4>
            <h2>CABANG DINAS PENDIDIKAN WILAYAH IX</h2>
            <h4>SEKOLAH MENENGAH KEJURUAN NEGERI 1 TALAGA</h4>
            <div class="address">
                Bidang Keahlian: Teknologi dan Rekayasa, Teknologi Informasi Komunikasi, Bisnis dan Manajemen<br />
                Kampus 1: Jalan Sekolah Nomor 20 Desa Talagakulon Kecamatan Talaga Kabupaten Majalengka<br />
                Kampus 2: Jalan Talaga-Bantarujeg Desa Mekarraharja Kecamatan Talaga Kabupaten Majalengka<br />
                Telpon <i class="fa-solid fa-phone"></i> (0233) 319238 &nbsp;
                FAX <i class="fa-solid fa-fax"></i> (0233) 319238 &nbsp;
                POS <i class="fa-solid fa-envelope"></i> 45463 &nbsp; NPSN: 20213872<br />
                Website <i class="fa-solid fa-globe"></i>
                <a href="http://www.smkn1talaga.sch.id">www.smkn1talaga.sch.id</a>
                &nbsp;&#8211;&nbsp; Email <i class="fa-solid fa-envelope"></i>
                <a href="mailto:admin@smkn1talaga.sch.id">admin@smkn1talaga.sch.id</a>
            </div>
        </div>

        <div class="portrait-content">
            <div style="text-align:center; font-weight:bold; text-decoration:underline; font-size:12pt;">
                SURAT PERINTAH
            </div>
            <div style="text-align:center; margin-bottom:20px;">
                Nomor : {{ $travelOrder->letter_number }}
            </div>

            <table class="no-border">
                <tr>
                    <td style="width:80px;">Dasar</td>
                    <td style="width:10px;">:</td>
                    <td>{{ $travelOrder->base }}</td>
                </tr>
            </table>

            <div style="text-align:center; font-weight:bold; margin:15px 0;">MEMERINTAHKAN</div>

            <table class="no-border">
                <tr>
                    <td style="width:80px;">Kepada</td>
                    <td style="width:10px;">:</td>
                    <td></td>
                </tr>
            </table>

            <table class="bordered">
                <thead>
                    <tr>
                        <th style="width:30px;">NO.</th>
                        <th>NAMA</th>
                        <th>NIP</th>
                        <th>JABATAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($travelOrder->employees as $employ)
                        <tr>
                            <td style="text-align:center;">{{ $loop->iteration }}</td>
                            <td>{{ $employ->employee->full_name }}</td>
                            <td>{{ $employ->employee->nip ?? '-' }}</td>
                            <td>{{ $employ->employee->pns_position ?? ($employ->employee->functional_position ?? ($employ->employee->tmt_position ?? '-')) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="no-border" style="margin-top:15px;">
                <tr>
                    <td style="width:20px; vertical-align:top;">Untuk</td>
                    <td>: {{ $travelOrder->purpose }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table class="no-border" style="margin-top:10px; margin-left:52px; border-spacing:0;">
                            <tr>
                                <td style="width:70px; padding:1px 0;">Hari</td>
                                <td style="width:10px; padding:1px 5px;">:</td>
                                <td style="padding:1px 0;">
                                    {{ \Carbon\Carbon::parse($travelOrder->departure_date)->locale('id')->isoFormat('dddd') }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:1px 0;">Tanggal</td>
                                <td style="padding:1px 5px;">:</td>
                                <td style="padding:1px 0;">
                                    {{ \App\Helpers\DateRangeHelper::format($travelOrder->departure_date, $travelOrder->return_date, 'id', false) }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:1px 0;">Waktu</td>
                                <td style="padding:1px 5px;">:</td>
                                <td style="padding:1px 0;">
                                    {{ \Carbon\Carbon::parse($travelOrder->departure_time)->format('H:i') }} WIB</td>
                            </tr>
                            <tr>
                                <td style="padding:1px 0;">Tempat</td>
                                <td style="padding:1px 5px;">:</td>
                                <td style="padding:1px 0;">{{ $travelOrder->departure_place }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <p>Dilaksanakan sebagaimana mestinya dan setelah melaksanakan kegiatan agar memberikan laporan baik lisan
                maupun tulisan kepada Kepala Sekolah.</p>

            <div style="text-align:right; margin-top:30px;">
                <div style="display:inline-block; text-align:left; width:220px;">
                    Dikeluarkan di : {{ $travelOrder->departure_from }}<br />
                    Pada Tanggal :
                    {{ \Carbon\Carbon::parse($travelOrder->issue_date)->locale('id')->isoFormat('D MMMM YYYY') }}<br />
                    Kepala Sekolah<br /><br /><br /><br />
                    <div style="font-weight:bold; text-decoration:underline;">{{ $headmasterName }}</div>
                    <div>NIP. {{ $headmasterNip }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
     HALAMAN 2..N - SPPD PER PEGAWAI (Landscape)
═══════════════════════════════════════════════════ --}}
    @foreach ($travelOrder->employees as $index => $employ)
        <div class="page-landscape-wrapper {{ $loop->last ? 'last-page' : '' }}">
            <div class="page-landscape">
                <div class="sppd-container">

                    {{-- KOLOM KIRI --}}
                    <div class="col-left">
                        <div
                            style="border-bottom:2px solid black; margin-bottom:5px; padding-bottom:2px; position:relative; min-height:90px;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Coat_of_arms_of_West_Java.svg/500px-Coat_of_arms_of_West_Java.svg.png"
                                alt="Logo" style="position:absolute; top:0; left:0; width:70px; height:auto;" />
                            <div style="margin-left:70px; text-align:center;">
                                <h4 style="font-size:8pt; margin:0;">PEMERINTAH DAERAH PROVINSI JAWA BARAT</h4>
                                <h4 style="font-size:8pt; margin:0;">CABANG DINAS PENDIDIKAN WILAYAH IX</h4>
                                <h2 style="font-size:8pt; margin:0;">SEKOLAH MENENGAH KEJURUAN NEGERI 1 TALAGA</h2>
                                <div class="address" style="font-size:7pt; line-height:1.2;">
                                    Bidang Keahlian: Teknologi dan Rekayasa, Teknologi Informasi Komunikasi, Bisnis dan
                                    Manajemen<br />
                                    Kampus 1: Jalan Sekolah Nomor 20 Desa Talagakulon Kecamatan Talaga Kabupaten
                                    Majalengka<br />
                                    Kampus 2: Jalan Talaga-Bantarujeg Desa Mekarraharja Kecamatan Talaga Kabupaten
                                    Majalengka<br />
                                    Telpon <i class="fa-solid fa-phone"></i> (0233) 319238 &nbsp;
                                    FAX <i class="fa-solid fa-fax"></i> (0233) 319238 &nbsp;
                                    POS <i class="fa-solid fa-envelope"></i> 45463 &nbsp; NPSN: 20213872<br />
                                    Website <i class="fa-solid fa-globe"></i>
                                    <a href="http://www.smkn1talaga.sch.id"
                                        style="text-decoration:none; color:black;">www.smkn1talaga.sch.id</a>
                                    &#8211; Email <i class="fa-solid fa-envelope"></i>
                                    <a href="mailto:admin@smkn1talaga.sch.id"
                                        style="text-decoration:none; color:black;">admin@smkn1talaga.sch.id</a>
                                </div>
                            </div>
                        </div>

                        <table class="no-border" style="font-size:8pt; margin-bottom:5px;">
                            <tr>
                                <td width="80" style="padding:0;">Lampiran Ke</td>
                                <td style="padding:0;">: {{ $index + 1 }}
                                    ({{ \App\Helpers\Terbilang::convert($index + 1) }})</td>
                            </tr>
                            <tr>
                                <td style="padding:0;">Kode Nomor</td>
                                <td style="padding:0;">: -</td>
                            </tr>
                            <tr>
                                <td style="padding:0;">Nomor</td>
                                <td style="padding:0;">: {{ $travelOrder->number }}</td>
                            </tr>
                        </table>

                        <div
                            style="text-align:center; font-weight:bold; text-decoration:underline; margin-bottom:5px; font-size:9pt;">
                            SURAT PERINTAH PERJALANAN DINAS (SPPD)
                        </div>

                        <table class="bordered sppd-table" style="font-size:8pt; width:100%; border-collapse:collapse;">
                            <tr>
                                <td width="20" align="center">1</td>
                                <td width="180">Penggunaan Anggaran/Kuasa Pengguna Anggaran</td>
                                <td colspan="2"><strong>{{ $headmasterName }}</strong></td>
                            </tr>
                            <tr>
                                <td align="center">2</td>
                                <td>Nama/NIP Pegawai Yang Melaksanakan Perjalanan Dinas</td>
                                <td colspan="2">{{ $index + 1 }}. {{ $employ->employee->full_name }} /
                                    {{ $employ->employee->nip ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td align="center">3</td>
                                <td>a. Pangkat dan Golongan<br>b. Jabatan/Instansi<br>c. Tingkat Biaya Perjalanan Dinas
                                </td>
                                <td colspan="2">
                                    a. {{ $employ->employee->pns_type ?? '-' }},
                                    {{ $employ->employee->job_position ?? '-' }}<br>
                                    b. {{ $employ->employee->position->name ?? '-' }} / SMKN 1 Talaga<br>
                                    c. -
                                </td>
                            </tr>
                            <tr>
                                <td align="center">4</td>
                                <td>Maksud Perjalanan Dinas</td>
                                <td colspan="2">{{ $travelOrder->purpose }}</td>
                            </tr>
                            <tr>
                                <td align="center">5</td>
                                <td>Alat Angkutan Yang Dipergunakan</td>
                                <td colspan="2">{{ $travelOrder->transport_type ?? 'Kendaraan Umum/Pribadi' }}</td>
                            </tr>
                            <tr>
                                <td align="center">6</td>
                                <td>a. Tempat Berangkat<br>b. Tempat Tujuan</td>
                                <td colspan="2">a. SMKN 1 Talaga<br>b. {{ $travelOrder->destination }}</td>
                            </tr>
                            <tr>
                                <td align="center">7</td>
                                <td>a. Lamanya Perjalanan Dinas<br>b. Tanggal Berangkat<br>c. Tanggal Harus Kembali/Tiba
                                    di Tempat Baru*)</td>
                                <td colspan="2">
                                    a. {{ $travelOrder->duration_days }} Hari<br>
                                    b.
                                    {{ \Carbon\Carbon::parse($travelOrder->start_date)->locale('id')->isoFormat('D MMMM YYYY') }}<br>
                                    c.
                                    {{ \Carbon\Carbon::parse($travelOrder->end_date)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </td>
                            </tr>
                            <tr>
                                <td align="center">8</td>
                                <td>Pengikut: Nama</td>
                                <td align="center" style="border-left:1px solid black;">NIP</td>
                                <td align="center" style="border-left:1px solid black;">Jabatan</td>
                            </tr>
                            @if ($travelOrder->followers->isNotEmpty())
                                @foreach ($travelOrder->followers as $follower)
                                    <tr>
                                        <td style="border-top:none; border-bottom:none;"></td>
                                        <td>{{ $loop->iteration }}. {{ $follower->follower->full_name ?? '-' }}</td>
                                        <td>{{ $follower->follower->employee_id ?? '-' }}</td>
                                        <td>{{ $follower->follower->position->name ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td style="border-top:none;"></td>
                                    <td>-</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                            <tr>
                                <td align="center">9</td>
                                <td>Pembebanan Anggaran<br>a. Instansi<br>b. Akun</td>
                                <td colspan="2"><br>a. SMK Negeri 1 Talaga<br>b. {{ $travelOrder->acc ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td align="center">10</td>
                                <td>Keterangan Lain</td>
                                <td colspan="2"></td>
                            </tr>
                        </table>

                        <div style="font-size:7pt; margin-top:2px;">*) Coret yang tidak perlu</div>

                        <div style="text-align:left; margin-left:55%; font-size:8pt; margin-top:10px;">
                            Dikeluarkan di : Talaga<br>
                            Pada Tanggal :
                            {{ \Carbon\Carbon::parse($travelOrder->issue_date ?? $travelOrder->departure_date)->locale('id')->isoFormat('D MMMM YYYY') }}<br>
                            Kuasa Pengguna Anggaran<br><br><br><br>
                            <strong><u>{{ $headmasterName }}</u></strong><br>
                            NIP. {{ $headmasterNip }}
                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="col-right">
                        <table class="bordered validation-table" style="height:100%;">
                            <tr>
                                <td width="25">I.</td>
                                <td width="40%"></td>
                                <td>
                                    Berangkat dari: {{ $travelOrder->departure_place }}<br />
                                    (Tempat Kedudukan)<br />
                                    Ke: {{ $travelOrder->departure_to }}<br />
                                    Pada Tanggal:
                                    {{ \Carbon\Carbon::parse($travelOrder->departure_date)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </td>
                            </tr>
                            <tr>
                                <td>II.</td>
                                <td>Tiba di:<br />Pada Tanggal:<br /><br /><br /><br /></td>
                                <td>Berangkat dari:<br />Ke:<br />Pada Tanggal:<br /><br /><br /><br /></td>
                            </tr>
                            <tr>
                                <td>III.</td>
                                <td>Tiba di:<br />Pada Tanggal:<br /><br /><br /><br /></td>
                                <td>Berangkat dari:<br />Ke:<br />Pada Tanggal:<br /><br /><br /><br /></td>
                            </tr>
                            <tr>
                                <td>IV.</td>
                                <td>Tiba di:<br />Pada Tanggal:<br /><br /><br /><br /></td>
                                <td>Berangkat dari:<br />Ke:<br /><br /><br /><br /></td>
                            </tr>
                            <tr>
                                <td>V.</td>
                                <td colspan="2">
                                    Tiba di : {{ $travelOrder->departure_place }}<br />
                                    Pada Tanggal :
                                    {{ \Carbon\Carbon::parse($travelOrder->return_date)->locale('id')->isoFormat('D MMMM YYYY') }}<br /><br />
                                    <div style="text-align:justify;">
                                        Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya
                                        dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.
                                    </div>
                                    <div style="text-align:center; margin-top:15px;">
                                        Pengguna Anggaran/Kuasa Pengguna Anggaran<br /><br /><br /><br /><br />
                                        <strong><u>{{ $headmasterName }}</u></strong><br />
                                        NIP. {{ $headmasterNip }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="font-size:8pt;">
                                    <strong>VI. PERHATIAN</strong><br />
                                    PA/KPA yang menerbitkan SPD, Pegawai yang melakukan perjalanan dinas, para pejabat
                                    mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab
                                    berdasarkan peraturan &#8211; peraturan keuangan negara apabila negara menderita
                                    rugi
                                    akibat kesalahan, kelalaian dan kealpaannya.
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    {{-- ═══════════════════════════════════════════════════════════════
     HALAMAN LAPORAN - LAPORAN HASIL PERJALANAN DINAS (Portrait)
     Di-loop per pegawai
═════════════════════════════════════════════════════════════════════ --}}
    @foreach ($travelOrder->employees as $index => $employ)
        <div class="page-portrait laporan-page">

            {{-- KOP SURAT --}}
            <div
                style="border-bottom:3px solid #000; padding-bottom:6px; margin-bottom:16px;
            position:relative; min-height:110px; padding-left:110px;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Coat_of_arms_of_West_Java.svg/500px-Coat_of_arms_of_West_Java.svg.png"
                    alt="Logo" style="position:absolute; left:0; top:0; width:100px; height:auto;" />
                <div style="text-align:center; font-family:Arial,sans-serif;">
                    <div style="font-size:11pt; font-weight:bold; line-height:1.4;">PEMERINTAH DAERAH PROVINSI JAWA
                        BARAT</div>
                    <div style="font-size:11pt; font-weight:bold; line-height:1.4;">CABANG DINAS PENDIDIKAN WILAYAH IX
                    </div>
                    <div style="font-size:14pt; font-weight:bold; line-height:1.4;">SEKOLAH MENENGAH KEJURUAN NEGERI 1
                        TALAGA</div>
                    <div style="font-family:Tahoma,sans-serif; font-size:8pt; line-height:1.5; margin-top:2px;">
                        Bidang Keahlian: Teknologi dan Rekayasa, Teknologi Informasi Komunikasi, Bisnis dan
                        Manajemen<br>
                        Kampus 1: Jalan Sekolah Nomor 20 Desa Talagakulon Kecamatan Talaga Kabupaten Majalengka<br>
                        Kampus 2: Jalan Talaga-Bantarujeg Desa Mekarraharja Kecamatan Talaga Kabupaten Majalengka<br>
                        Telpon (0233) 319238 &nbsp; FAX (0233) 319238 &nbsp; POS 45463 &nbsp; NPSN: 20213872<br>
                        Website <a href="http://www.smkn1talaga.sch.id"
                            style="text-decoration:none;color:black;">www.smkn1talaga.sch.id</a>
                        &nbsp;&#8211;&nbsp;
                        Email <a href="mailto:admin@smkn1talaga.sch.id"
                            style="text-decoration:none;color:black;">admin@smkn1talaga.sch.id</a>
                    </div>
                </div>
            </div>

            {{-- JUDUL --}}
            <div
                style="text-align:center; font-weight:bold; text-decoration:underline; font-size:12pt;
            font-family:Arial,sans-serif; margin-bottom:16px;">
                LAPORAN HASIL PERJALANAN DINAS
            </div>

            {{-- ISI LAPORAN --}}
            <div style="font-family:Arial,sans-serif; font-size:11pt; line-height:1.6;">

                {{-- 1. Dasar --}}
                <div style="display:flex; align-items:baseline; margin-bottom:4px;">
                    <span style="display:inline-block; width:24px; flex-shrink:0;">1.</span>
                    <span style="display:inline-block; width:180px; flex-shrink:0;">Dasar</span>
                    <span style="display:inline-block; width:16px; flex-shrink:0;">:</span>
                    <span style="flex:1;">{{ $travelOrder->base }}</span>
                </div>

                {{-- 2. Maksud dan Tujuan --}}
                <div style="display:flex; align-items:baseline; margin-bottom:4px;">
                    <span style="display:inline-block; width:24px; flex-shrink:0;">2.</span>
                    <span style="display:inline-block; width:180px; flex-shrink:0;">Maksud dan Tujuan</span>
                    <span style="display:inline-block; width:16px; flex-shrink:0;">:</span>
                    <span style="flex:1;">{{ $travelOrder->purpose }}</span>
                </div>

                {{-- 3. Isi Laporan --}}
                <div style="display:flex; align-items:baseline;">
                    <span style="display:inline-block; width:24px; flex-shrink:0;">3.</span>
                    <span>Isi Laporan</span>
                </div>

                {{-- 3a. Waktu Pelaksanaan --}}
                <div style="display:flex; align-items:baseline; padding-left:24px; margin-bottom:4px;">
                    <span style="display:inline-block; width:22px; flex-shrink:0;">a.</span>
                    <span style="display:inline-block; width:230px; flex-shrink:0;">Waktu Pelaksanaan,
                        Hari/Tanggal</span>
                    <span style="display:inline-block; width:16px; flex-shrink:0;">:</span>
                    {{-- Waktu Pelaksanaan di Laporan --}}
                    <span style="flex:1;">
                        {{ \App\Helpers\DateRangeHelper::format($travelOrder->departure_date, $travelOrder->return_date) }}
                        ({{ $travelOrder->duration_days }} Hari)
                    </span>
                </div>

                {{-- 3b. Instansi Penyelenggara --}}
                <div style="display:flex; align-items:baseline; padding-left:24px; margin-bottom:4px;">
                    <span style="display:inline-block; width:22px; flex-shrink:0;">b.</span>
                    <span style="display:inline-block; width:230px; flex-shrink:0;">Instansi/Perusahaan Penyelenggara
                        Kegiatan</span>
                    <span style="display:inline-block; width:16px; flex-shrink:0;">:</span>
                    <span style="flex:1;">{{ $travelOrder->departure_to ?? '-' }}</span>
                </div>

                {{-- 3c. Hasil Pelaksanaan Tugas --}}
                <div style="display:flex; align-items:baseline; padding-left:24px; margin-bottom:4px;">
                    <span style="display:inline-block; width:22px; flex-shrink:0;">c.</span>
                    <span>Hasil Pelaksanaan Tugas :</span>
                </div>

                {{-- 13 garis kosong --}}
                @for ($i = 0; $i < 13; $i++)
                    <div style="border-bottom:1px dotted #000; height:22px; width:100%;"></div>
                @endfor

            </div>{{-- end isi laporan --}}

            {{-- TANDA TANGAN --}}
            <div
                style="width:80%; margin:24px auto 0 auto;
        display:flex; gap:60px;
        font-family:Arial; font-size:11pt;">

                <div style="flex:1; text-align:left;">
                    Mengetahui,<br>
                    Kepala Sekolah,
                    <div style="height:65px;"></div>
                    <div style="font-weight:bold; text-decoration:underline;">{{ $headmasterName }}</div>
                    <div>NIP. {{ $headmasterNip }}</div>
                </div>

                <div style="flex:1; text-align:left; margin-left: 50px;">
                    Talaga,
                    {{ \Carbon\Carbon::parse($travelOrder->return_date ?? now())->locale('id')->isoFormat('D MMMM YYYY') }}<br>
                    Yang Membuat Laporan,
                    <div style="height:65px;"></div>
                    <div style="font-weight:bold; text-decoration:underline;">
                        {{ $employ->employee->full_name }}
                    </div>
                    <div>NIP. {{ $employ->employee->nip ?? '-' }}</div>
                </div>

            </div>

        </div>
    @endforeach

    <script>
        function handlePrint() {
            fetch("{{ route('sp.travelOrders.increment-download', $travelOrder->id) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Download count updated:', data);
                    window.print();
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.print();
                });
        }
    </script>

</body>

</html>
