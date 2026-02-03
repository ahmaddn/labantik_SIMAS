<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Surat Keterangan SMK N 1 Talaga</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }

        body {
            background-color: #525659;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* --- TOMBOL ACTIONS --- */
        .action-buttons {
            position: sticky;
            top: 20px;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 215mm;
            margin-bottom: 20px;
            padding: 15px 25px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
        }

        .btn-edit {
            background-color: #3b82f6;
        }

        .btn-edit:hover {
            background-color: #2563eb;
        }

        .btn-print {
            background-color: #10b981;
        }

        .btn-print:hover {
            background-color: #059669;
        }

        .btn-back {
            background-color: #303332;
        }

        .btn-back:hover {
            background-color: #151414;
        }

        /* --- UKURAN KERTAS F4 --- */
        .page {
            background-color: white;
            width: 215mm;
            min-height: 330mm;
            padding: 15mm 20mm 20mm 25mm;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        /* --- KOP SURAT --- */
        .kop-surat {
            position: relative;
            border-bottom: 4px double black;
            padding-bottom: 10px;
            margin-bottom: 20px;
            /* Jarak setelah kop ke judul */
            text-align: center;
        }

        .logo-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 72pt;
            /* UKURAN ASLI: 71.8pt dari Word */
            height: 85pt;
            /* UKURAN ASLI: 85pt dari Word */
        }

        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .kop-text {
            margin-left: 85px;
            /* Space untuk logo */
        }

        .kop-text h1 {
            font-size: 14pt;
            margin: 0;
            padding: 0;
            font-weight: bold;
            line-height: 1.1;
        }

        .address {
            font-size: 8pt;
            margin-top: 3pt;
            line-height: 1.15;
            font-weight: normal;
            color: black;
        }

        /* --- JUDUL SURAT --- */
        .judul-surat {
            text-align: center;
            margin-top: 0;
            margin-bottom: 18px;
            /* Jarak setelah judul ke isi */
        }

        .judul-surat h4 {
            font-size: 14pt;
            /* Sesuai Word: 14pt */
            text-decoration: underline;
            margin: 0;
            padding: 0;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.15;
        }

        .judul-surat p {
            font-size: 11pt;
            margin: 0;
            padding: 0;
            line-height: 1.15;
        }

        /* --- ISI SURAT --- */
        .isi-surat {
            font-size: 11pt;
            line-height: 1.15;
            /* Line spacing 1.15 dari Word */
            text-align: justify;
        }

        .isi-surat p {
            margin: 0 0 11pt 0;
            /* 11pt spacing antar paragraf */
        }

        /* --- TABEL DATA --- */
        .tabel-data {
            width: 100%;
            border-collapse: collapse;
            margin-left: 36pt;
            /* Tab indent 0.5in = 36pt */
            margin-bottom: 11pt;
            font-size: 11pt;
            line-height: 1.15;
        }

        .tabel-data td {
            vertical-align: top;
            padding: 0;
            padding-bottom: 2pt;
            /* Jarak antar baris minimal */
            line-height: 1.15;
        }

        .col-label {
            width: 158pt;
            /* Lebar kolom label */
            padding-right: 5pt;
        }

        .col-sep {
            width: 12pt;
            text-align: left;
        }

        .col-value {
            /* Sisa lebar */
        }

        .bold-text {
            font-weight: bold;
        }

        /* --- TTD --- */
        .ttd-container {
            float: right;
            width: 280px;
            text-align: left;
            margin-top: 20px;
            font-size: 11pt;
            line-height: 1.15;
        }

        .ttd-tanggal {
            margin: 0;
            line-height: 1.15;
        }

        .ttd-jabatan {
            margin: 0;
            line-height: 1.15;
        }

        .ttd-nama {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 60pt;
            /* Space untuk tanda tangan */
            line-height: 1.15;
        }

        .ttd-nip {
            margin: 0;
            line-height: 1.15;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* --- PENGATURAN PRINT --- */
        @media print {
            @page {
                size: 215mm 330mm;
                margin: 0;
            }

            body {
                background: none;
                padding: 0;
            }

            .action-buttons {
                display: none !important;
            }

            .page {
                box-shadow: none;
                margin: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="action-buttons">
        <div style="display: flex; gap: 10px; align-items: center;">
            <!-- Tombol Back di kiri bersama judul -->
            <a href="{{ route('sk.generalLetters.index') }}" class="btn btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div style="display: flex; gap: 10px">
            <a href="{{ route('sk.generalLetters.edit', $letter->id) }}" class="btn btn-edit">
                <i class="fa-solid fa-pen-to-square"></i> Edit Data
            </a>
            <button onclick="window.print()" class="btn btn-print">
                <i class="fa-solid fa-print"></i> Cetak
            </button>
        </div>
    </div>

    <div class="page clearfix">
        <!-- KOP SURAT -->
        <div class="kop-surat">
            <div class="logo-container">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Coat_of_arms_of_West_Java.svg/500px-Coat_of_arms_of_West_Java.svg.png"
                    alt="Logo Jawa Barat" />
            </div>
            <div class="kop-text">
                <h1>PEMERINTAH DAERAH PROVINSI JAWA BARAT</h1>
                <h1>CABANG DINAS PENDIDIKAN WILAYAH IX</h1>
                <h1>SEKOLAH MENENGAH KEJURUAN NEGERI 1 TALAGA</h1>
                <div class="address">
                    Bidang Keahlian: Teknologi dan Rekayasa, Teknologi Informasi Komunikasi, Bisnis dan Manajemen<br />
                    Kampus 1: Jalan Sekolah Nomor 20 Desa Talagakulon Kecamatan Talaga Kabupaten Majalengka<br />
                    Kampus 2: Jalan Talaga-Bantarujeg Desa Mekarraharja Kecamatan Talaga Kabupaten Majalengka<br />
                    Telpon <i class="fa-solid fa-phone"></i> (0233) 319238
                    &nbsp; FAX <i class="fa-solid fa-fax"></i> (0233) 319238
                    &nbsp; POS <i class="fa-solid fa-envelope"></i> 45463
                    &nbsp; NPSN: 20213872<br />
                    Website <i class="fa-solid fa-globe"></i>
                    <a href="http://www.smkn1talaga.sch.id" target="_blank">www.smkn1talaga.sch.id</a>
                    &nbsp;–&nbsp; Email <i class="fa-solid fa-envelope"></i>
                    <a href="mailto:admin@smkn1talaga.sch.id">admin@smkn1talaga.sch.id</a>
                </div>
            </div>
        </div>

        <!-- JUDUL SURAT -->
        <div class="judul-surat">
            <h4>SURAT KETERANGAN</h4>
            <p>Nomor : {{ $letter->letter_number }}</p>
        </div>

        <!-- ISI SURAT -->
        <div class="isi-surat">
            <p>
                Yang bertanda tangan di bawah ini, Kepala SMK Negeri 1 Talaga Kecamatan Talaga Kabupaten Majalengka:
            </p>

            <!-- Data Kepala Sekolah -->
            <table class="tabel-data">
                <tr>
                    <td class="col-label">Nama</td>
                    <td class="col-sep">:</td>
                    <td class="col-value bold-text">MUCHAMAD EKI S.A., S.Kom</td>
                </tr>
                <tr>
                    <td class="col-label">NIP</td>
                    <td class="col-sep">:</td>
                    <td class="col-value">197610012006041011</td>
                </tr>
                <tr>
                    <td class="col-label">Pangkat, Gol/Ruang</td>
                    <td class="col-sep">:</td>
                    <td class="col-value">Penata Tk.I, III/d</td>
                </tr>
                <tr>
                    <td class="col-label">Jabatan</td>
                    <td class="col-sep">:</td>
                    <td class="col-value">Kepala Sekolah</td>
                </tr>
            </table>

            <p>Menyatakan dengan sebenarnya bahwa :</p>

            <!-- Data Siswa -->
            <table class="tabel-data">
                <tr>
                    <td class="col-label">Nama</td>
                    <td class="col-sep">:</td>
                    <td class="col-value bold-text">{{ $letter->student->student->full_name }}</td>
                </tr>
                <tr>
                    <td class="col-label">Tempat, Tanggal Lahir</td>
                    <td class="col-sep">:</td>
                    <td class="col-value">{{ $letter->student->student->birth_date_place }},
                        {{ $letter->student->student->birth_order }}</td>
                </tr>
                <tr>
                    <td class="col-label">NIS</td>
                    <td class="col-sep">:</td>
                    <td class="col-value">{{ $letter->student->student->student_number }}</td>
                </tr>
                <tr>
                    <td class="col-label">NISN</td>
                    <td class="col-sep">:</td>
                    <td class="col-value">{{ $letter->student->student->national_student_number }}</td>
                </tr>
                <tr>
                    <td class="col-label">Kelas</td>
                    <td class="col-sep">:</td>
                    <td class="col-value">{{ $letter->student->class->name }}</td>
                </tr>
                <tr>
                    <td class="col-label">Jurusan</td>
                    <td class="col-sep">:</td>
                    <td class="col-value">{{ $letter->student->class->expertiseProgram->name }}</td>
                </tr>
            </table>

            <p>
                {{ $letter->content }}
            </p>

            <p>
                Demikian Surat Keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
            </p>
        </div>

        <!-- TTD -->
        <div class="ttd-container">
            <div class="ttd-tanggal">{{ $letter->departure_from }},
                {{ \Carbon\Carbon::parse($letter->issue_date)->locale('id')->translatedFormat('d F Y') }}
            </div>
            <div class="ttd-jabatan">Kepala Sekolah,</div>
            <div class="ttd-nama">MUCHAMAD EKI S.A., S.Kom</div>
            <div class="ttd-nip">NIP. 197610012006041011</div>
        </div>
    </div>
</body>

</html>
