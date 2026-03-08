<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengantar Pindah Sekolah - {{ $schoolTransfers->letter_number }}</title>
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
            padding: 10mm 20mm;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            position: relative;
        }

        /* --- KOP SURAT --- */
        .header {
            border-bottom: 4px double #000;
            padding-bottom: 5px;
            margin-bottom: 20px;
            position: relative;
            min-height: 100px;
            padding-left: 100px;
        }

        .header img {
            position: absolute;
            left: 0;
            top: 0;
            width: auto;
            height: 115px;
        }

        .header-text {
            text-align: center;
        }

        .header h3,
        .header h2,
        .header p {
            margin: 0;
        }

        .header h3 {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.15;
        }

        .header h2 {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 2px 0;
        }

        .header p {
            font-size: 8pt;
            line-height: 1.15;
            margin: 0;
        }

        .header .address {
            font-family: Tahoma;
            font-size: 9pt;
            font-weight: normal;
            text-align: center;
            line-height: 1.3;
            color: #000;
            margin-top: 2px;
        }

        .header .address a {
            text-decoration: underline;
            color: blue;
        }

        /* --- HEADER TANGGAL & TUJUAN --- */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            font-size: 11pt;
            margin-bottom: 30px;
        }

        .header-kiri {
            width: 80%;
        }

        .header-kanan {
            width: 21%;
        }

        .nomor-lampiran-table {
            width: 100%;
            border-collapse: collapse;
        }

        .nomor-lampiran-table td {
            vertical-align: top;
            padding-bottom: 3px;
        }

        .label-cell {
            width: 60px;
            white-space: nowrap;
        }

        .titik-dua {
            width: 10px;
            text-align: center;
        }

        .tanggal-section {
            text-align: right;
            margin-bottom: 5px;
            font-size: 11pt;
            margin-right: 0;
        }

        /* --- ISI SURAT --- */
        .isi-surat {
            font-size: 11pt;
            line-height: 1.5;
            text-align: justify;
        }

        .paragraf {
            margin-bottom: 15px;
        }

        /* --- DATA SISWA --- */
        .data-siswa {
            margin-left: 40px;
            margin-bottom: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table td {
            vertical-align: top;
            padding-bottom: 5px;
            font-size: 11pt;
        }

        .data-label {
            width: 160px;
        }

        .data-separator {
            width: 20px;
            text-align: center;
        }

        .data-content {
            font-weight: bold;
        }

        /* --- TANDA TANGAN --- */
        .ttd-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 40px;
            font-size: 11pt;
        }

        .ttd-box {
            width: 250px;
            text-align: left;
        }

        .ttd-nama {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 70px;
            margin-bottom: 2px;
        }

        /* Helper styling */
        .bold {
            font-weight: bold;
        }

        .underline {
            text-decoration: underline;
        }

        .italic {
            font-style: italic;
        }

        /* Print-specific adjustments */
        @media print {
            .header {
                border-bottom: 4px double #000;
            }

            .header img {
                height: 115px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <!-- TOMBOL AKSI -->
    <div class="action-buttons">
        <a href="{{ route('s_peng.schoolTransfers.index') }}" class="btn btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('s_peng.schoolTransfers.edit', $schoolTransfers->id) }}" class="btn btn-edit">
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
                    Bidang Keahlian: Teknologi dan Rekayasa, Teknologi Informasi Komunikasi, Bisnis dan Manajemen<br>
                    Kampus 1: Jalan Sekolah Nomor 20 Desa Talagakulon Kecamatan Talaga Kabupaten Majalengka<br>
                    Kampus 2: Jalan Talaga-Bantarujeg Desa Mekarraharja Kecamatan Talaga Kabupaten Majalengka<br>
                    Telpon <i class="fa-solid fa-phone"></i> (0233) 319236 &nbsp;
                    FAX <i class="fa-solid fa-fax"></i> (0233) 319236 &nbsp;
                    POS <i class="fa-solid fa-envelope"></i> 45463 &nbsp;
                    NPSN: 20213872<br>
                    Website <i class="fa-solid fa-globe"></i>
                    <a href="http://www.smkn1talaga.sch.id">www.smkn1talaga.sch.id</a>
                    &nbsp;–&nbsp; Email <i class="fa-solid fa-envelope"></i>
                    <a href="mailto:admin@smkn1talaga.sch.id">admin@smkn1talaga.sch.id</a>
                </div>
            </div>
        </div>

        <!-- HEADER TANGGAL, NOMOR, TUJUAN -->
        <div class="tanggal-section">
            Talaga, {{ \Carbon\Carbon::parse($schoolTransfers->issue_date)->locale('id')->isoFormat('D MMMM YYYY') }}
        </div>

        <div class="header-section">
            <div class="header-kiri">
                <table class="nomor-lampiran-table">
                    <tr>
                        <td class="label-cell">Nomor</td>
                        <td class="titik-dua">:</td>
                        <td>{{ $schoolTransfers->letter_number }}</td>
                    </tr>
                    <tr>
                        <td class="label-cell">Lampiran</td>
                        <td class="titik-dua">:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td class="label-cell">Perihal</td>
                        <td class="titik-dua">:</td>
                        <td class="bold underline">Pengantar Pindah Sekolah</td>
                    </tr>
                </table>
            </div>

            <div class="header-kanan">
                Kepada<br>
                <table style="border:none; margin:0; padding:0; width:100%;">
                    <tr>
                        <td style="padding:0; vertical-align:top; white-space:nowrap;">Yth.&nbsp;</td>
                        <td style="padding:0; vertical-align:top;">Kepala {{ $schoolTransfers->destination_school }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0;"></td>
                        <td style="padding:0;">di</td>
                    </tr>
                    <tr>
                        <td style="padding:0;"></td>
                        <td style="padding:0;" class="italic">Tempat</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- ISI SURAT -->
        <div class="isi-surat">
            <div class="paragraf">
                Dengan Hormat,
            </div>

            <div class="paragraf">
                Berdasarkan Surat Permohonan Pindah Sekolah dari Orang Tua/Wali Siswa yang bernama
                <span class="bold">{{ strtoupper($schoolTransfers->student->student->mother_name ?? '-') }}</span>
                untuk Siswa :
            </div>

            <div class="data-siswa">
                <table class="data-table">
                    <tr>
                        <td class="data-label">Nama</td>
                        <td class="data-separator">:</td>
                        <td class="data-content">{{ strtoupper($schoolTransfers->student->student->full_name ?? '-') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="data-label">Tempat, Tanggal Lahir</td>
                        <td class="data-separator">:</td>
                        <td>
                            {{ $schoolTransfers->student->student->birth_place_date ?? '-' }},
                        </td>
                    </tr>
                    <tr>
                        <td class="data-label">NIS</td>
                        <td class="data-separator">:</td>
                        <td>{{ $schoolTransfers->student->student->student_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="data-label">Kelas</td>
                        <td class="data-separator">:</td>
                        <td>{{ $schoolTransfers->student->class->academic_level ?? '-' }}
                            {{ $schoolTransfers->student->class->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="data-label">Program Keahlian</td>
                        <td class="data-separator">:</td>
                        <td>{{ $schoolTransfers->student->class->expertiseProgram->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="data-label">Alamat</td>
                        <td class="data-separator">:</td>
                        <td>{{ $schoolTransfers->student->student->address ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <div class="paragraf">
                Maka pada prinsipnya kami tidak keberatan untuk pindah ke <span
                    class="bold">{{ strtoupper($schoolTransfers->destination_school) }}</span>.
            </div>

            <div class="paragraf">
                Demikian Surat pengantar ini kami sampaikan untuk dipergunakan sebagaimana mestinya.
            </div>
        </div>

        <!-- TANDA TANGAN -->
        <div class="ttd-container">
            <div class="ttd-box">
                Hormat Kami,<br>
                @if ($schoolTransfers->headmaster)
                    {{ $schoolTransfers->headmaster->position ?? 'Kepala Sekolah' }}
                @else
                    Kepala Sekolah
                @endif

                <div class="ttd-nama">
                    @if ($schoolTransfers->headmaster)
                        {{ strtoupper($schoolTransfers->headmaster->name ?? 'MUCHAMAD EKI S.A., S.Kom') }}
                    @else
                        MUCHAMAD EKI S.A., S.Kom
                    @endif
                </div>
                <div>
                    @if ($schoolTransfers->headmaster && $schoolTransfers->headmaster->nip)
                        NIP. {{ $schoolTransfers->headmaster->nip }}
                    @else
                        NIP. 197610012006041011
                    @endif
                </div>
            </div>
        </div>

    </div>

    <script>
        function handlePrint() {
            // Kirim request untuk increment download count
            fetch("{{ route('s_peng.schoolTransfers.increment-download', $schoolTransfers->id) }}", {
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
