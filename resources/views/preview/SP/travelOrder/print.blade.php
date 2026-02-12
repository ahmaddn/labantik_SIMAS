<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Surat Perintah & SPPD</title>
    <style>
        /* --- RESET & FONT --- */
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

        /* --- TOMBOL ACTIONS --- */
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

        /* Sembunyikan tombol saat print */
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
            }

            .page-portrait {
                page-break-after: always;
            }

            .page-landscape-wrapper {
                page-break-before: always;
                page: landscape-page;
            }
        }

        /* --- KOP SURAT --- */
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
            width: 115px;
            height: 130px;
        }

        .header h3,
        .header h2,
        .header h4,
        .header p {
            margin: 0px 0;
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

        /* Memastikan link website/email warnanya hitam & tidak bergaris bawah */
        .header .address a {
            text-decoration: none;
            color: #000;
        }

        /* --- KOP SURAT Landscape --- */
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
            margin: 0px 0;
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

        /* Memastikan link website/email warnanya hitam & tidak bergaris bawah */
        .header .address a {
            text-decoration: none;
            color: #000;
        }

        /* --- TABEL & BORDER --- */
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

        /* Font size khusus tabel agar muat */
        .sppd-table td {
            font-size: 9pt;
        }

        .validation-table td {
            font-size: 9pt;
        }

        /* --- HALAMAN 1 (PORTRAIT) --- */
        .page-portrait {
            background-color: white;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto 0 auto;
            padding: 10mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .portrait-content {
            padding: 0 10mm 0 10mm;
        }

        /* --- HALAMAN 2 (LANDSCAPE) --- */
        .page-landscape {
            background-color: white;
            width: 297mm;
            /* Lebar A4 Landscape */
            min-height: 210mm;
            margin: 0 auto 20px auto;
            /* PENTING: Padding disesuaikan agar layout tidak menempel ke tepi */
            padding: 10mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        /* --- LAYOUT DUA KOLOM SPPD --- */
        .sppd-container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        /* Kolom Kiri */
        .col-left {
            width: 50%;
            padding-right: 15px;
            display: flex;
            flex-direction: column;
        }

        /* Kolom Kanan */
        .col-right {
            width: 50%;
            padding-left: 15px;
        }

        /* Tanda Tangan */
        .signature-block {
            margin-top: 20px;
            text-align: left;
            margin-left: 50%;
            /* Geser ke kanan sedikit */
        }

        .signature-name {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }

        /* --- PENGATURAN PRINT --- */
        @media print {
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

            .page-portrait {
                page-break-after: always;
            }

            .page-landscape-wrapper {
                page-break-before: always;
                page: landscape-page;
                page-break-after: auto;
                /* Ganti dari default */
            }

            /* Hilangkan page break setelah elemen terakhir */
            .page-landscape-wrapper:last-of-type {
                page-break-after: avoid !important;
                break-after: avoid-page !important;
            }

            /* Cegah margin/padding yang menyebabkan overflow */
            .page-landscape:last-child {
                margin-bottom: 0 !important;
                padding-bottom: 0 !important;
            }

            * Halaman terakhir tidak break */ .last-page {
                page-break-after: avoid !important;
                break-after: avoid !important;
            }

            .page-portrait {
                page-break-after: always;
            }

            /* Semua landscape kecuali yang terakhir */
            .page-landscape-wrapper:not(.last-page) {
                page-break-before: always;
                page: landscape-page;
            }

            .page-landscape-wrapper.last-page {
                page-break-before: always;
                page-break-after: avoid !important;
                page: landscape-page;
            }
        }

        @page landscape-page {
            size: A4 landscape;
            margin: 0;
        }

        @page {
            size: A4 portrait;
            margin: 0;
        }

        @page landscape-page {
            size: A4 landscape;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
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
    <!-- === HALAMAN 1: SURAT PERINTAH === -->
    <div class="page-portrait">
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
                POS <i class="fa-solid fa-envelope"></i> 45463 &nbsp;
                NPSN: 20213872<br />
                Website <i class="fa-solid fa-globe"></i>
                <a href="http://www.smkn1talaga.sch.id">www.smkn1talaga.sch.id</a>
                &nbsp;–&nbsp; Email <i class="fa-solid fa-envelope"></i>
                <a href="mailto:admin@smkn1talaga.sch.id">admin@smkn1talaga.sch.id</a>
            </div>
        </div>
        <div class="portrait-content">
            <div
                style="
                    text-align: center;
                    font-weight: bold;
                    text-decoration: underline;
                    font-size: 12pt;
                ">
                SURAT PERINTAH
            </div>
            <div style="text-align: center; margin-bottom: 20px">
                Nomor : {{ $travelOrder->letter_number }}
            </div>

            <table class="no-border">
                <tr>
                    <td style="width: 80px">Dasar</td>
                    <td style="width: 10px">:</td>
                    <td>-</td>
                </tr>
            </table>
            <div style="text-align: center; font-weight: bold; margin: 15px 0">
                MEMERINTAHKAN
            </div>
            <table class="no-border">
                <tr>
                    <td style="width: 80px">Kepada</td>
                    <td style="width: 10px">:</td>
                    <td></td>
                </tr>
            </table>

            <table class="bordered">
                <thead>
                    <tr>
                        <th style="width: 30px">NO.</th>
                        <th>NAMA</th>
                        <th>NIP</th>
                        <th>JABATAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($travelOrder->employees as $employ)
                        <tr>
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ $employ->employee->full_name }}</td>
                            <td>{{ $employ->employee->nip ?? '-' }}</td>
                            <td>{{ $employ->employee->pns_position ?? ($employ->employee->functional_position ?? ($employ->employee->tmt_position ?? '-')) }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <table class="no-border" style="margin-top: 15px; width: 100%;">
                <tr>
                    <td style="width: 20px; vertical-align: top;">Untuk</td>
                    <td>: {{ $travelOrder->purpose }}</td>
                    <td style="vertical-align: top;">
                        <table class="no-border" style="margin-top: 50px; margin-left: 20px; border-spacing: 0;">
                            <tr>
                                <td style="width: 70px; padding: 1px 0;">Hari</td>
                                <td style="width: 10px; padding: 1px 5px;">:</td>
                                <td style="padding: 1px 0;">
                                    {{ \Carbon\Carbon::parse($travelOrder->departure_date)->locale('id')->translatedFormat('l') }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1px 0;">Tanggal</td>
                                <td style="padding: 1px 5px;">:</td>
                                <td style="padding: 1px 0;">
                                    {{ \Carbon\Carbon::parse($travelOrder->departure_date)->locale('id')->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 1px 0;">Waktu</td>
                                <td style="padding: 1px 5px;">:</td>
                                <td style="padding: 1px 0;">{{ $travelOrder->departure_time }} WIB</td>
                            </tr>
                            <tr>
                                <td style="padding: 1px 0;">Tempat</td>
                                <td style="padding: 1px 5px;">:</td>
                                <td style="padding: 1px 0;">{{ $travelOrder->departure_place }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <p>
                Dilaksanakan sebagaimana mestinya dan setelah melaksanakan
                kegiatan agar memberikan laporan baik lisan maupun tulisan
                kepada Kepala Sekolah.
            </p>

            <div style="text-align: right; margin-top: 30px">
                <div
                    style="
                        display: inline-block;
                        text-align: left;
                        width: 220px;
                    ">
                    Dikeluarkan di : {{ $travelOrder->departure_from }}<br />Pada Tanggal :
                    {{ \Carbon\Carbon::parse($travelOrder->issue_date)->locale('id')->translatedFormat('d F Y') }}
                    <br />Kepala Sekolah <br /><br /><br /><br />
                    <div style="font-weight: bold; text-decoration: underline">
                        MUCHAMAD EKI S.A., S.Kom.
                    </div>
                    <div>NIP. 197610012006041011</div>
                </div>
            </div>
        </div>
    </div>


    @foreach ($travelOrder->employees as $index => $employ)
        <!-- === HALAMAN 2: SPPD (LANDSCAPE) === -->
        <div class="page-landscape-wrapper {{ $loop->last ? 'last-page' : '' }}">
            <div class="page-landscape">
                <div class="sppd-container">
                    <!-- KOLOM KIRI -->
                    <div class="col-left">

                        <!-- KOP SURAT (Dikecilkan agar muat) -->
                        <div class="header1"
                            style="border-bottom: 2px solid black; margin-bottom: 5px; padding-bottom: 2px; position: relative; min-height: 90px;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Coat_of_arms_of_West_Java.svg/500px-Coat_of_arms_of_West_Java.svg.png"
                                alt="Logo"
                                style="position: absolute; top: 0; left: 0; width: 70px; height: auto;" />

                            <div style="margin-left: 70px; text-align: center;">
                                <h4 style="font-size: 8pt; margin: 0;">PEMERINTAH DAERAH PROVINSI JAWA BARAT</h4>
                                <h4 style="font-size: 8pt; margin: 0;">CABANG DINAS PENDIDIKAN WILAYAH IX</h4>
                                <h2 style="font-size: 8pt; margin: 0;">SEKOLAH MENENGAH KEJURUAN NEGERI 1 TALAGA
                                </h2>

                                <div class="address" style="font-size: 7pt; line-height: 1.2;">
                                    Bidang Keahlian: Teknologi dan Rekayasa, Teknologi Informasi Komunikasi, Bisnis
                                    dan
                                    Manajemen<br />
                                    Kampus 1: Jalan Sekolah Nomor 20 Desa Talagakulon Kecamatan Talaga Kabupaten
                                    Majalengka<br />
                                    Kampus 2: Jalan Talaga-Bantarujeg Desa Mekarraharja Kecamatan Talaga Kabupaten
                                    Majalengka<br />
                                    Telpon <i class="fa-solid fa-phone"></i> (0233) 319238 &nbsp; FAX <i
                                        class="fa-solid fa-fax"></i> (0233) 319238 &nbsp; POS <i
                                        class="fa-solid fa-envelope"></i> 45463 &nbsp; NPSN: 20213872<br />
                                    Website <i class="fa-solid fa-globe"></i> <a href="http://www.smkn1talaga.sch.id"
                                        style="text-decoration:none; color:black;">www.smkn1talaga.sch.id</a> –
                                    Email <i class="fa-solid fa-envelope"></i> <a href="mailto:admin@smkn1talaga.sch.id"
                                        style="text-decoration:none; color:black;">admin@smkn1talaga.sch.id</a>
                                </div>
                            </div>
                        </div>

                        <!-- Info Lampiran (Font dikecilkan ke 8pt) -->
                        <table class="no-border" style="font-size: 8pt; margin-bottom: 5px; width: 100%;">
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
                            style="text-align: center; font-weight: bold; text-decoration: underline; margin-bottom: 5px; font-size: 9pt;">
                            SURAT PERINTAH PERJALANAN DINAS (SPPD)
                        </div>

                        <!-- Tabel Isian (Menggunakan font 8pt dan padding kecil) -->
                        <table class="bordered sppd-table"
                            style="font-size: 8pt; width: 100%; border-collapse: collapse;">
                            <!-- Baris 1: Pengguna Anggaran -->
                            <tr>
                                <td width="20" align="center" style="vertical-align: top;">1</td>
                                <td width="180" style="vertical-align: top;">Penggunaan Anggaran/Kuasa Pengguna
                                    Anggaran</td>
                                <!-- Menggunakan colspan="2" karena baris 8 memecah kolom ini menjadi dua bagian (NIP & Jabatan) -->
                                <td colspan="2" style="vertical-align: top;"><strong>MUCHAMAD EKI S.A.,
                                        S.Kom.</strong></td>
                            </tr>

                            <!-- Baris 2: Nama Pegawai -->
                            <tr>
                                <td align="center" style="vertical-align: top;">2</td>
                                <td style="vertical-align: top;">Nama/NIP Pegawai Yang Melaksanakan Perjalanan Dinas
                                </td>
                                <td colspan="2" style="vertical-align: top;">
                                    {{ $index + 1 }}. {{ $employ->employee->full_name }} /
                                    {{ $employ->employee->nip ?? '-' }}
                                </td>
                            </tr>

                            <!-- Baris 3: Pangkat, Jabatan, Tingkat Biaya -->
                            <tr>
                                <td align="center" style="vertical-align: top;">3</td>
                                <td style="vertical-align: top;">
                                    a. Pangkat dan Golongan<br>
                                    b. Jabatan/Instansi<br>
                                    c. Tingkat Biaya Perjalanan Dinas
                                </td>
                                <td colspan="2" style="vertical-align: top;">
                                    a. {{ $employ->employee->rank_start ?? '-' }},
                                    {{ $employ->employee->golongan ?? '-' }}<br>
                                    b. {{ $employ->employee->position->name ?? '-' }} / SMKN 1 Talaga<br>
                                    c. -
                                </td>
                            </tr>

                            <!-- Baris 4: Maksud Perjalanan -->
                            <tr>
                                <td align="center" style="vertical-align: top;">4</td>
                                <td style="vertical-align: top;">Maksud Perjalanan Dinas</td>
                                <td colspan="2" style="vertical-align: top;">{{ $travelOrder->purpose }}</td>
                            </tr>

                            <!-- Baris 5: Alat Angkutan -->
                            <tr>
                                <td align="center" style="vertical-align: top;">5</td>
                                <td style="vertical-align: top;">Alat Angkutan Yang Dipergunakan</td>
                                <td colspan="2" style="vertical-align: top;">
                                    {{ $travelOrder->transport_type ?? 'Kendaraan Umum/Pribadi' }}</td>
                            </tr>

                            <!-- Baris 6: Tempat Berangkat & Tujuan -->
                            <tr>
                                <td align="center" style="vertical-align: top;">6</td>
                                <td style="vertical-align: top;">
                                    a. Tempat Berangkat<br>
                                    b. Tempat Tujuan
                                </td>
                                <td colspan="2" style="vertical-align: top;">
                                    a. SMKN 1 Talaga<br>
                                    b. {{ $travelOrder->destination }}
                                </td>
                            </tr>

                            <!-- Baris 7: Lama Perjalanan & Tanggal -->
                            <tr>
                                <td align="center" style="vertical-align: top;">7</td>
                                <td style="vertical-align: top;">
                                    a. Lamanya Perjalanan Dinas<br>
                                    b. Tanggal Berangkat<br>
                                    c. Tanggal Harus Kembali/Tiba di Tempat Baru*)
                                </td>
                                <td colspan="2" style="vertical-align: top;">
                                    a. {{ $travelOrder->duration }} Hari<br>
                                    b.
                                    {{ \Carbon\Carbon::parse($travelOrder->start_date)->translatedFormat('d F Y') }}<br>
                                    c.
                                    {{ \Carbon\Carbon::parse($travelOrder->end_date)->translatedFormat('d F Y') }}
                                </td>
                            </tr>

                            <!-- Baris 8: Pengikut (HEADER BAGIAN INI MEMECAH KOLOM) -->
                            <tr>
                                <td align="center" style="vertical-align: middle;">8</td>
                                <td style="vertical-align: middle;">Pengikut: Nama</td>
                                <td align="center" style="vertical-align: middle; border-left: 1px solid black;">
                                    NIP
                                </td>
                                <td align="center" style="vertical-align: middle; border-left: 1px solid black;">
                                    Jabatan</td>
                            </tr>

                            <!-- Baris 8: Pengikut (DATA LOOPING) -->
                            @if ($travelOrder->followers->isNotEmpty())
                                @foreach ($travelOrder->followers as $follower)
                                    <tr>
                                        <!-- Kolom nomor kosong untuk baris data pengikut -->
                                        <td style="border-top: none; border-bottom: none;"></td>
                                        <td style="vertical-align: top;">
                                            {{ $loop->iteration }}. {{ $follower->follower->full_name ?? '-' }}
                                        </td>
                                        <td style="vertical-align: top;">
                                            {{ $follower->follower->employee_id ?? '-' }}
                                        </td>
                                        <td style="vertical-align: top;">
                                            {{ $follower->follower->position->name ?? '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <!-- Baris Kosong jika tidak ada pengikut agar format tabel tetap terjaga -->
                                <tr>
                                    <td style="border-top: none;"></td>
                                    <td>-</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif

                            <!-- Baris 9: Pembebanan Anggaran -->
                            <tr>
                                <td align="center" style="vertical-align: top;">9</td>
                                <td style="vertical-align: top;">
                                    Pembebanan Anggaran<br>
                                    a. Instansi<br>
                                    b. Akun
                                </td>
                                <td colspan="2" style="vertical-align: top;">
                                    <br>
                                    a. SMK Negeri 1 Talaga<br>
                                    b. {{ $travelOrder->account ?? '-' }}
                                </td>
                            </tr>

                            <!-- Baris 10: Keterangan Lain -->
                            <tr>
                                <td align="center" style="vertical-align: top;">10</td>
                                <td style="vertical-align: top;">Keterangan Lain</td>
                                <td colspan="2" style="vertical-align: top;">{{ $travelOrder->notes ?? '-' }}
                                </td>
                            </tr>
                        </table>
                        <div style="font-size: 7pt; margin-top: 2px;">*) Coret yang tidak perlu</div>
                        <!-- Tanda Tangan (Diposisikan di kanan bawah) -->
                        <div style="text-align: left; margin-left: 55%; font-size: 8pt; margin-top: 10px;">
                            Dikeluarkan di : Talaga<br>
                            Pada Tanggal :
                            {{ \Carbon\Carbon::parse($travelOrder->issue_date ?? $travelOrder->departure_date)->locale('id')->translatedFormat('d F Y') }}<br>
                            Kuasa Pengguna Anggaran
                            <br><br><br><br>
                            <strong><u>MUCHAMAD EKI S.A., S.Kom.</u></strong><br>
                            NIP. 197610012006041011
                        </div>
                    </div>

                    <!-- KOLOM KANAN -->
                    <div class="col-right">
                        <!-- Tabel Kanan (Menyatu) -->
                        <table class="bordered validation-table" style="height: 100%">
                            <!-- Baris I -->
                            <tr>
                                <td width="25">I.</td>
                                <td width="40%"></td>
                                <td>
                                    Berangkat dari: {{ $travelOrder->departure_place }}<br />
                                    (Tempat Kedudukan)<br />
                                    Ke: {{ $travelOrder->destination }}<br />
                                    Pada Tanggal:
                                    {{ \Carbon\Carbon::parse($travelOrder->departure_date)->locale('id')->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            <!-- Baris II -->
                            <tr>
                                <td>II.</td>
                                <td>
                                    Tiba di:<br />Pada Tanggal:<br />Kepala<br /><br /><br />
                                </td>
                                <td>
                                    Berangkat dari:<br />Ke:<br />Pada
                                    Tanggal:<br />Kepala<br /><br /><br />
                                </td>
                            </tr>
                            <!-- Baris III -->
                            <tr>
                                <td>III.</td>
                                <td>
                                    Tiba di:<br />Pada Tanggal:<br />Kepala<br /><br /><br />
                                </td>
                                <td>
                                    Berangkat dari:<br />Ke:<br />Pada
                                    Tanggal:<br />Kepala<br /><br /><br />
                                </td>
                            </tr>
                            <!-- Baris IV -->
                            <tr>
                                <td>IV.</td>
                                <td>
                                    Tiba di:<br />Pada Tanggal:<br />Kepala<br /><br /><br />
                                </td>
                                <td>
                                    Berangkat dari:<br />Ke:<br />Kepala<br /><br /><br />
                                </td>
                            </tr>
                            <!-- Baris V -->
                            <tr>
                                <td>V.</td>
                                <td colspan="2">
                                    Tiba di : {{ $travelOrder->departure_place }}<br />
                                    Pada Tanggal :
                                    {{ \Carbon\Carbon::parse($travelOrder->return_date)->locale('id')->translatedFormat('d F Y') }}<br /><br />
                                    <div style="text-align: justify">
                                        Telah diperiksa dengan keterangan bahwa
                                        perjalanan tersebut atas perintahnya dan
                                        semata-mata untuk kepentingan jabatan
                                        dalam waktu yang sesingkat-singkatnya.
                                    </div>
                                    <div style="text-align: center; margin-top: 15px;">
                                        Pengguna Anggaran/Kuasa Pengguna Anggaran
                                        <br /><br /><br /><br /><br />
                                        <strong><u>MUCHAMAD EKI S.A., S.Kom.</u></strong><br />
                                        NIP. 197610012006041011
                                    </div>
                                </td>
                            </tr>
                            <!-- Baris VI -->
                            <tr>
                                <td colspan="3" style="font-size: 8pt">
                                    <strong>VI. PERHATIAN</strong><br />
                                    PA/KPA yang menerbitkan SPD, Pegawai yang
                                    melakukan perjalanan dinas, para pejabat
                                    mengesahkan tanggal berangkat/tiba, serta
                                    bendahara pengeluaran bertanggung jawab
                                    berdasarkan peraturan – peraturan keuangan
                                    negara apabila negara menderita rugi akibat
                                    kesalahan, kelalaian dan kealpaannya.
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        function handlePrint() {
            // Kirim request untuk increment download count
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
                    // Jalankan print setelah berhasil update
                    window.print();
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Tetap print meskipun ada error
                    window.print();
                });
        }
    </script>
</body>

</html>
