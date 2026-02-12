<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Koreksi Data - {{ $correction->letter_number }}</title>
    <style>
        /* --- RESET & FONT --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f0f0f0;
            font-family: Arial;
            font-size: 11pt;
            line-height: 1.6;
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
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 5px;
            padding-left: 100px;
            margin-bottom: 20px;
            position: relative;
            min-height: 100px;
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
        .content {
            font-size: 11pt;
            line-height: 1.6;
            text-align: justify;
        }

        .paragraph {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        /* --- TABEL DATA --- */
        .data-table {
            width: 100%;
            margin-left: 70px;
            margin-top: 10px;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .data-table td {
            vertical-align: top;
            padding-bottom: 5px;
            line-height: 1.6;
        }

        .col-label {
            width: 180px;
        }

        .col-sep {
            width: 20px;
            text-align: left;
        }

        .col-isi {
            font-weight: normal;
        }

        .bold-text {
            font-weight: bold;
        }

        /* --- HIGHLIGHT DATA --- */
        .highlight-incorrect {
            font-weight: bold;
            text-decoration: underline;
        }

        .highlight-correct {
            font-weight: bold;
            text-decoration: underline;
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


        /* Print-specific adjustments */
        @media print {
            .header {
                border-bottom: 4px double #000;
            }

            .header img {
                height: 115px;
            }

            .signature-area {
                page-break-inside: avoid;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <div class="action-buttons">
        <div style="display: flex; gap: 10px; align-items: center;">
            <!-- Tombol Back di kiri bersama judul -->
            <a href="{{ route('sk.dataCorrections.index') }}" class="btn btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div style="display: flex; gap: 10px">
            <a href="{{ route('sk.dataCorrections.edit', $correction->id) }}" class="btn btn-edit">
                <i class="fa-solid fa-pen-to-square"></i> Edit Data
            </a>
            <button onclick="handlePrint()" class="btn btn-print">
                <i class="fa-solid fa-print"></i> Cetak
            </button>
        </div>
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
            <p>Nomor : {{ $correction->letter_number }}</p>
        </div>

        <!-- ISI SURAT -->
        <div class="content">
            <div class="paragraph">
                Yang bertanda tangan di bawah ini, Kepala Sekolah SMK Negeri 1 Talaga Kecamatan Talaga Kabupaten
                Majalengka :
            </div>

            <!-- Tabel Data Kepala Sekolah -->
            <table class="data-table">
                <tr>
                    <td class="col-label">Nama</td>
                    <td class="col-sep">:</td>
                    <td class="col-isi bold-text">
                        MUCHAMAD EKI S.A., S.Kom
                    </td>
                </tr>
                <tr>
                    <td class="col-label">NIP</td>
                    <td class="col-sep">:</td>
                    <td class="col-isi">
                        197610012006041011
                    </td>
                </tr>
                <tr>
                    <td class="col-label">Pangkat, Gol/Ruang</td>
                    <td class="col-sep">:</td>
                    <td class="col-isi">
                        Penata Tk.I, III/d
                    </td>
                </tr>
                <tr>
                    <td class="col-label">Jabatan</td>
                    <td class="col-sep">:</td>
                    <td class="col-isi">Kepala Sekolah</td>
                </tr>
            </table>

            <div class="paragraph">
                Menerangkan dengan sebenarnya bahwa :
            </div>

            <!-- Tabel Data Siswa -->
            <table class="data-table">
                <tr>
                    <td class="col-label">Nama</td>
                    <td class="col-sep">:</td>
                    <td class="col-isi bold-text">{{ $correction->student->student->full_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="col-label">Tempat, Tanggal Lahir</td>
                    <td class="col-sep">:</td>
                    <td class="col-isi">{{ $correction->student->student->birth_place_date ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="col-label">Lulusan</td>
                    <td class="col-sep">:</td>
                    <td class="col-isi">{{ $correction->graduation_year }}</td>
                </tr>
                <tr>
                    <td class="col-label">Kompetensi Keahlian</td>
                    <td class="col-sep">:</td>
                    <td class="col-isi">{{ $correction->student->class->expertiseProgram->name ?? '-' }}</td>
                </tr>
            </table>

            <!-- Konten Koreksi -->
            <div class="paragraph">
                Bahwa nama tersebut benar siswa SMK Negeri 1 Talaga Lulusan Tahun
                {{ $correction->graduation_year ?? '-' }}
                @if ($correction->student && $correction->student->class && $correction->student->class->expertiseProgram)
                    Jurusan
                    {{ $correction->student->class->expertiseProgram->code ?? $correction->student->class->expertiseProgram->name }},
                @endif
                namun terdapat perbedaan Penulisan
                @if ($correction->correction_type == 'student_name')
                    Nama Siswa
                @elseif($correction->correction_type == 'parent_name')
                    Nama Orang Tua
                @elseif($correction->correction_type == 'birth_date')
                    Tanggal Lahir
                @elseif($correction->correction_type == 'birth_place')
                    Tanggal Lahir
                @else
                    {{ $correction->field_name ?? 'Data' }}
                @endif
                di Ijazah dan
                @if ($correction->reference_document)
                    {{ $correction->reference_document }}.
                @else
                    Dokumen Resmi.
                @endif
                <br>
                Dalam Ijazah Tertulis <span class="highlight-incorrect">{{ $correction->incorrect_data ?? '-' }}</span>
                Seharusnya <span class="highlight-correct">{{ $correction->correct_data ?? '-' }}</span>.
            </div>

            <!-- Penutup -->
            <div class="paragraph">
                Demikian Surat Keterangan ini dibuat dengan sebenarnya dan untuk dipergunakan sebagaimana mestinya.
            </div>

            <!-- TTD -->
            <div class="ttd-container">
                <div class="ttd-tanggal">Talaga,
                    {{ \Carbon\Carbon::parse($correction->issue_date)->locale('id')->translatedFormat('d F Y') }}
                </div>
                <div class="ttd-jabatan">Kepala Sekolah</div>
                <div class="ttd-nama">MUCHAMAD EKI S.A., S.Kom</div>
                <div class="ttd-nip">NIP. 197610012006041011</div>
            </div>
        </div>
    </div>

    <script>
        function handlePrint() {
            // Kirim request untuk increment download count
            fetch("{{ route('sk.dataCorrections.increment-download', $correction->id) }}", {
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
