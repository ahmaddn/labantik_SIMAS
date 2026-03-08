<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Undangan - {{ $invitation->letter_number }}</title>
    <style>
        /* --- RESET & FONT --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f0f0f0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }

        /* --- TOMBOL ACTIONS --- */
        .action-buttons {
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 210mm;
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
        }

        /* --- HALAMAN --- */
        .page {
            background-color: white;
            width: 210mm;
            min-height: 297mm;
            padding: 15mm 20mm;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            position: relative;
        }

        /* --- KOP SURAT --- */
        .header {
            border-bottom: 3px solid #000;
            padding-bottom: 5px;
            margin-bottom: 5px;
            position: relative;
            min-height: 100px;
            padding-left: 100px;
        }

        .header img {
            position: absolute;
            left: 0;
            top: 0;
            width: auto;
            height: 120px;
        }

        .header-text {
            text-align: center;
        }

        .header h3,
        .header h2,
        .header h4,
        .header p {
            margin: 0;
        }

        .header h3 {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .header h2 {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 2px 0;
        }

        .header p {
            font-size: 8pt;
            line-height: 1.2;
            margin: 1px 0;
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

        /* --- TANGGAL & INFO SURAT --- */
        .date-section {
            text-align: right;
            margin-top: 15px;
            margin-bottom: 15px;
            font-size: 11pt;
        }

        .content {
            font-size: 10pt;
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

        /* Print-specific adjustments */
        @media print {
            .header {
                border-bottom: 3px solid #000;
            }

            .header::after {
                border-bottom: 1px solid #000;
            }

            .header img {
                height: 110px;
            }

            .signature-section {
                page-break-inside: avoid;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <!-- TOMBOL AKSI -->
    <div class="action-buttons">
        <a href="{{ route('su.parentInvitations.index') }}" class="btn btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('su.parentInvitations.edit', $invitation->id) }}" class="btn btn-edit">
            <i class="fa-solid fa-edit"></i> Edit
        </a>
        <button onclick="handlePrint()" class="btn btn-print">
            <i class="fa-solid fa-print"></i> Print
        </button>
    </div>

    <div class="page">
        <!-- KOP SURAT -->
        <div class="header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Coat_of_arms_of_West_Java.svg/500px-Coat_of_arms_of_West_Java.svg.png"
                alt="Logo Jabar">
            <div class="header-text">
                <h3>PEMERINTAH DAERAH PROVINSI JAWA BARAT</h3>
                <h2>CABANG DINAS PENDIDIKAN WILAYAH IX</h2>
                <h3>SEKOLAH MENENGAH KEJURUAN NEGERI 1 TALAGA</h3>
                <div class="address">
                    Bidang Keahlian: Teknologi dan Rekayasa, Teknologi Informasi Komunikasi, Bisnis dan Manajemen
                    Kampus 1: Jalan Sekolah Nomor 20 Desa Talagakulon Kecamatan Talaga Kabupaten Majalengka<br>
                    Kampus 2: Jalan Talaga-Bantarujeg Desa Mekarraharja Kecamatan Talaga Kabupaten Majalengka<br>
                    Telpon <i class="fa-solid fa-phone"></i> (0233) 319238 &nbsp;
                    FAX <i class="fa-solid fa-fax"></i> (0233) 319238 &nbsp;
                    POS <i class="fa-solid fa-envelope"></i> 45463 &nbsp;
                    NPSN: 20213872<br>
                    Website <i class="fa-solid fa-globe"></i>
                    <a href="http://www.smkn1talaga.sch.id">www.smkn1talaga.sch.id</a>
                    &nbsp;–&nbsp; Email <i class="fa-solid fa-envelope"></i>
                    <a href="mailto:admin@smkn1talaga.sch.id">admin@smkn1talaga.sch.id</a>
                </div>
            </div>
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
                Yth. {{ $invitation->to ?? 'Bapak/Ibu Orang Tua/Wali Siswa/i' }}<br>
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

            <!-- PARAGRAF 2 (Purpose) -->
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
                    <td>
                        @if ($invitation->meeting_time)
                            {{ \Carbon\Carbon::parse(time: $invitation->meeting_time)->format('H:i') }} WIB
                        @else
                            ............................................
                        @endif
                    </td>
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
        function handlePrint() {
            // Kirim request untuk increment download count
            fetch("{{ route('su.parentInvitations.increment-download', $invitation->id) }}", {
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
