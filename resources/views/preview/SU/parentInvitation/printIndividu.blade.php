<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Undangan - {{ $invitation->letter_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #e0e0e0;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .page {
            background-color: white;
            width: 210mm;
            min-height: 297mm;
            padding: 15mm 20mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            box-sizing: border-box;
            position: relative;
        }

        /* --- PRINT STYLES --- */
        @media print {
            body {
                background-color: white;
                padding: 0;
                margin: 0;
            }

            .page {
                width: 100%;
                min-height: auto;
                padding: 0;
                margin: 0;
                box-shadow: none;
                page-break-after: avoid;
            }

            @page {
                size: A4;
                margin: 15mm 20mm;
            }

            .no-print {
                display: none;
            }
        }

        /* --- KOP SURAT --- */
        .header {
            border-bottom: 3px solid black;
            padding-bottom: 3px;
            margin-bottom: 3px;
            position: relative;
        }

        .header::after {
            content: '';
            display: block;
            border-bottom: 1px solid black;
            margin-top: 3px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-cell {
            width: 80px;
            vertical-align: top;
            text-align: center;
            padding-right: 10px;
        }

        .logo-img {
            width: 75px;
            height: auto;
        }

        .text-cell {
            text-align: center;
            vertical-align: middle;
        }

        .text-cell h3 {
            margin: 0;
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .text-cell h2 {
            margin: 2px 0;
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .text-cell p {
            margin: 1px 0;
            font-size: 8pt;
            line-height: 1.2;
        }

        .address {
            font-size: 7pt !important;
        }

        .links {
            color: blue;
            text-decoration: underline;
        }

        /* --- TANGGAL & INFO SURAT --- */
        .date-section {
            text-align: right;
            margin-top: 15px;
            margin-bottom: 15px;
            font-size: 11pt;
        }

        .content {
            font-size: 11pt;
            line-height: 1.4;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .info-table td {
            vertical-align: top;
            padding: 2px 0;
        }

        .label-col {
            width: 70px;
        }

        .colon-col {
            width: 15px;
        }

        /* --- PENERIMA --- */
        .recipient-block {
            margin-left: 0;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        /* --- ISI TEXT --- */
        .greeting {
            margin-top: 15px;
            font-style: italic;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .paragraph {
            text-align: justify;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        /* --- JADWAL (Hari, Tanggal, dll) --- */
        .schedule-table {
            margin-left: 60px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .schedule-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .sch-label {
            width: 90px;
        }

        .sch-colon {
            width: 15px;
            text-align: left;
        }

        /* --- PENUTUP & TTD --- */
        .closing {
            margin-top: 15px;
            text-align: justify;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .closing-greeting {
            font-style: italic;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .signature-section {
            margin-top: 20px;
            margin-left: 55%;
            text-align: left;
            width: 45%;
        }

        .kepala-sekolah {
            margin-bottom: 70px;
        }

        .nama-kepsek {
            font-weight: bold;
            text-decoration: underline;
            display: block;
        }

        /* Print Button */
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14pt;
            z-index: 1000;
        }

        .print-button:hover {
            background-color: #0056b3;
        }

        /* Print-specific adjustments */
        @media print {
            .header {
                border-bottom: 3px solid black;
            }

            .header::after {
                border-bottom: 1px solid black;
            }

            .logo-img {
                width: 70px;
            }

            .signature-section {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <button class="print-button no-print" onclick="window.print()">🖨️ Print</button>

    <div class="page">
        <!-- KOP SURAT -->
        <div class="header">
            <table class="header-table">
                <tr>
                    <td class="logo-cell">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Coat_of_arms_of_West_Java.svg/1200px-Coat_of_arms_of_West_Java.svg.png"
                            alt="Logo Jabar" class="logo-img">
                    </td>
                    <td class="text-cell">
                        <h3>PEMERINTAH DAERAH PROVINSI JAWA BARAT</h3>
                        <h3>CABANG DINAS PENDIDIKAN WILAYAH IX</h3>
                        <h2>SEKOLAH MENENGAH KEJURUAN NEGERI 1 TALAGA</h2>
                        <p>Bidang Keahlian: Teknologi dan Rekayasa, Teknologi Informasi komunikasi, Bisnis dan Manajemen
                        </p>
                        <p class="address">Kampus 1: Jalan Sekolah Nomor 20 Desa Talagakulon Kecamatan Talaga Kabupaten
                            Majalengka</p>
                        <p class="address">Kampus 2: Jalan Talaga-Bantarujeg Desa Mekarraharja Kecamatan Talaga
                            Kabupaten Majalengka</p>
                        <p class="address">Telpon (0233) 319238 FAX (0233) 319238 POS 45463 NPSN: 20213872</p>
                        <p class="address">Website <span class="links">www.smkn1talaga.sch.id</span> - Email <span
                                class="links">admin@smkn1talaga.sch.id</span></p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- TANGGAL DI KANAN -->
        <div class="date-section">
            Talaga, {{ \Carbon\Carbon::parse($invitation->issue_date)->locale('id')->isoFormat('D MMMM YYYY') }}
        </div>

        <div class="content">
            <!-- NOMOR SURAT -->
            <table class="info-table">
                <tr>
                    <td class="label-col">Nomor</td>
                    <td class="colon-col">:</td>
                    <td>{{ $invitation->letter_number }}</td>
                </tr>
                <tr>
                    <td class="label-col">Lampiran</td>
                    <td class="colon-col">:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td class="label-col">Perihal</td>
                    <td class="colon-col">:</td>
                    <td>Undangan</td>
                </tr>
            </table>

            <!-- KEPADA -->
            <div class="recipient-block">
                Kepada<br>
                Yth. {{ $invitation->to ?? 'Bapak/Ibu Orang Tua/Wali' }}<br>
                @if ($invitation->student && $invitation->student->student)
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang Tua/Wali dari
                    <strong>{{ $invitation->student->student->full_name }}</strong><br>
                @endif
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;di<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat
            </div>

            <!-- SALAM PEMBUKA -->
            <div class="greeting">
                Assalamu'alaikum Warohmatullohi Wabarokatuh.
            </div>

            <!-- PARAGRAF 1 -->
            <div class="paragraph">
                Salam silaturahmi teriring do'a kami sampaikan semoga tetap dalam lindungan Allah SWT dan diberikan
                kesehatan dalam menjalankan aktifitas kesehariannya.
            </div>

            <!-- PARAGRAF 2 -->
            <div class="paragraph">
                {{ $invitation->purpose ?? 'Sehubungan ada beberapa informasi yang perlu disampaikan dan di musyawarahkan mengenai Program Sekolah SMK Negeri 1 Talaga, maka kami mengundang Bapak/Ibu Orang Tua/Wali Siswa/i untuk hadir dalam kegiatan tersebut.' }}
            </div>

            <!-- PARAGRAF 3 -->
            <div class="paragraph">
                Adapun kegiatan tersebut akan dilaksanakan pada :
            </div>

            <!-- DETAIL JADWAL -->
            <table class="schedule-table">
                <tr>
                    <td class="sch-label">Hari</td>
                    <td class="sch-colon">:</td>
                    <td>{{ $invitation->meeting_day ?? '............................................' }}</td>
                </tr>
                <tr>
                    <td class="sch-label">Tanggal</td>
                    <td class="sch-colon">:</td>
                    <td>
                        @if ($invitation->meeting_date)
                            {{ \Carbon\Carbon::parse($invitation->meeting_date)->locale('id')->isoFormat('D MMMM YYYY') }}
                        @else
                            ............................................
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="sch-label">Waktu</td>
                    <td class="sch-colon">:</td>
                    <td>{{ $invitation->meeting_time ?? '............................................' }}</td>
                </tr>
                <tr>
                    <td class="sch-label">Tempat</td>
                    <td class="sch-colon">:</td>
                    <td>{{ $invitation->meeting_place ?? '............................................' }}</td>
                </tr>
                @if ($invitation->meeting_with)
                    <tr>
                        <td class="sch-label">Bertemu dengan</td>
                        <td class="sch-colon">:</td>
                        <td>{{ $invitation->meeting_with }}</td>
                    </tr>
                @endif
            </table>

            <!-- PENUTUP -->
            <div class="closing">
                Demikian Undangan ini kami sampaikan, atas perhatian dan kehadirannya kami ucapkan terima kasih.
            </div>

            <!-- SALAM PENUTUP -->
            <div class="closing-greeting">
                Wassalamu'alaikum Warohmatullohi Wabarokatuh.
            </div>

            <!-- TANDA TANGAN -->
            <div class="signature-section">
                <div class="kepala-sekolah">Kepala SMKN 1 Talaga</div>

                <span class="nama-kepsek">MUCHAMAD EKI S.A., S.Kom</span>
                <span>NIP. 197610012006041011</span>
            </div>

        </div>
    </div>

    <script>
        // Auto print when page loads (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>

</html>
