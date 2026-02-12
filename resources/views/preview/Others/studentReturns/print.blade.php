<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan SMKN 1 Talaga - {{ $studentReturn->letter_number }}</title>
    <style>
        /* Pengaturan Dasar Halaman */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f0f0f0;
            font-family: Arial;
            font-size: 11pt;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }

        /* --- TOMBOL ACTIONS --- */
        .action-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            gap: 10px;
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

        /* Judul Surat */
        .title-section {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .title-section h2 {
            font-size: 16px;
            text-decoration: underline;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .title-section p {
            font-size: 14px;
            margin: 5px 0 0 0;
        }

        /* Isi Surat */
        .content {
            font-size: 14px;
            line-height: 1.5;
        }

        /* Tabel Data Diri */
        .data-table {
            width: 100%;
            margin-left: 20px;
            margin-top: 10px;
            margin-bottom: 10px;
            border-collapse: collapse;
        }

        .data-table td {
            vertical-align: top;
            padding: 2px 0;
        }

        .col-label {
            width: 180px;
        }

        .col-separator {
            width: 20px;
            text-align: center;
        }

        /* Grid untuk Bagian Bawah (Tanda Tangan & Arsip) */
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-top: 30px;
            gap: 20px;
            align-items: end;
        }

        /* Kolom Kanan: Tanda Tangan */
        .signature-section {
            grid-column: 2;
            text-align: left;
            margin-left: 50px;
        }

        .signature-place-date {
            margin-bottom: 80px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }

        /* Kolom Kiri: Arsip */
        .archive-section {
            grid-column: 1;
            font-size: 12px;
            margin-top: 50px;
        }

        .archive-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* Helper Styles */
        .indent {
            padding-left: 20px;
        }

        .bold {
            font-weight: bold;
        }

        /* Print Media Query */
        @media print {
            body {
                background: none;
                padding: 0;
            }

            .page {
                box-shadow: none;
                margin: 0;
                width: 100%;
            }

            .action-buttons {
                display: none !important;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <!-- TOMBOL AKSI -->
    <div class="action-buttons">
        <a href="{{ route('others.studentReturns.index') }}" class="btn btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('others.studentReturns.edit', $studentReturn->id) }}" class="btn btn-edit">
            <i class="fa-solid fa-edit"></i> Edit
        </a>
        <button onclick="handlePrint()" class="btn btn-print">
            <i class="fa-solid fa-print"></i> Print
        </button>
    </div>

    <div class="page">
        <!-- HEADER / KOP SURAT -->
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
        <!-- JUDUL SURAT -->
        <div class="title-section">
            <h2>SURAT PERNYATAAN</h2>
            <p>Nomor : {{ $studentReturn->letter_number }}</p>
        </div>

        <!-- ISI SURAT -->
        <div class="content">
            <p>Yang bertanda tangan dibawah ini saya :</p>

            <!-- Tabel Data Penandatangan -->
            <table class="data-table">
                <tr>
                    <td class="col-label">Nama</td>
                    <td class="col-separator">:</td>
                    <td class="bold">
                        @if ($studentReturn->headmaster)
                            {{ strtoupper($studentReturn->headmaster->name) }}
                        @else
                            MUCHAMAD EKI S.A., S.Kom
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>
                        @if ($studentReturn->headmaster && $studentReturn->headmaster->nip)
                            {{ $studentReturn->headmaster->nip }}
                        @else
                            197610012006041011
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Pangkat, Gol/Ruang</td>
                    <td>:</td>
                    <td>
                        @if ($studentReturn->headmaster && $studentReturn->headmaster->rank)
                            {{ $studentReturn->headmaster->rank }}
                        @else
                            Penata Tk.I , III/d
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>
                        @if ($studentReturn->headmaster && $studentReturn->headmaster->position)
                            {{ $studentReturn->headmaster->position }}
                        @else
                            Kepala Sekolah
                        @endif
                    </td>
                </tr>
            </table>

            <p>Menyatakan bahwa :</p>

            <!-- Tabel Data Siswa -->
            <table class="data-table">
                <tr>
                    <td class="col-label">Nama</td>
                    <td class="col-separator">:</td>
                    <td class="bold">
                        @if ($studentReturn->student && $studentReturn->student->student)
                            {{ strtoupper($studentReturn->student->student->full_name) }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td>:</td>
                    <td>
                        @if ($studentReturn->student && $studentReturn->student->student)
                            {{ $studentReturn->student->student->birth_place_date ?? '-' }},
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td>
                        @if ($studentReturn->student && $studentReturn->student->student)
                            {{ $studentReturn->student->student->student_number ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td>:</td>
                    <td>
                        @if ($studentReturn->student && $studentReturn->student->student)
                            {{ $studentReturn->student->student->national_student_number ?? ($studentReturn->student->student->national_identification_number ?? '-') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td>
                        @if ($studentReturn->student && $studentReturn->student->class)
                            {{ $studentReturn->student->class->academic_level ?? '-' }}
                            {{ $studentReturn->student->class->name ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Program Keahlian</td>
                    <td>:</td>
                    <td>
                        @if ($studentReturn->student && $studentReturn->student->class)
                            {{ $studentReturn->student->class->expertiseConcentration->name ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>
                        @if ($studentReturn->student && $studentReturn->student->student)
                            {{ $studentReturn->student->student->address ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </table>

            <p>Berdasarkan :</p>
            <ol class="indent" style="margin-top: 5px; margin-bottom: 10px;">
                @forelse ($studentReturn->reasons as $reason)
                    <li style="margin-bottom: 5px;">{{ $reason->reason }}</li>
                @empty
                    <li>-</li>
                @endforelse
            </ol>

            <p style="text-align: justify;">
                Maka atas dasar itu Pihak Sekolah menyatakan bahwa Siswa tersebut dikembalikan kepada Orang Tua,
                sejak hari
                <span
                    class="bold">{{ \Carbon\Carbon::parse($studentReturn->return_date)->locale('id')->isoFormat('dddd') }}</span>
                Tanggal
                <span class="bold">{{ \Carbon\Carbon::parse($studentReturn->return_date)->format('d') }}</span>
                Bulan
                <span
                    class="bold">{{ \Carbon\Carbon::parse($studentReturn->return_date)->locale('id')->isoFormat('MMMM') }}</span>
                Tahun
                <span class="bold">{{ \Carbon\Carbon::parse($studentReturn->return_date)->format('Y') }}</span>.
            </p>
            <p>
                Demikian Surat ini kami buat untuk dipergunakan sebagaimana mestinya.
            </p>

            <!-- FOOTER GRID SYSTEM (Tanda Tangan & Arsip) -->
            <div class="footer-grid">

                <!-- Kiri: Arsip -->
                <div class="archive-section">
                    <p>Untuk diarsipkan :</p>
                    <ol class="archive-list">
                        <li>1. Bagian Tata Usaha</li>
                        <li>2. Kesiswaan</li>
                        <li>3. Pembina OSIS</li>
                        <li>4. Operator Dapodik</li>
                        <li>5. Bagian ICT</li>
                    </ol>
                </div>

                <!-- Kanan: Tanda Tangan -->
                <div class="signature-section">
                    <div class="signature-place-date">
                        Talaga,
                        {{ \Carbon\Carbon::parse($studentReturn->return_date)->locale('id')->isoFormat('D MMMM YYYY') }}<br>
                        @if ($studentReturn->headmaster && $studentReturn->headmaster->position)
                            {{ $studentReturn->headmaster->position }}
                        @else
                            Kepala Sekolah
                        @endif
                    </div>

                    <div class="signature-name">
                        @if ($studentReturn->headmaster)
                            {{ strtoupper($studentReturn->headmaster->name) }}
                        @else
                            MUCHAMAD EKI S.A., S.Kom
                        @endif
                    </div>
                    <div>
                        @if ($studentReturn->headmaster && $studentReturn->headmaster->nip)
                            NIP. {{ $studentReturn->headmaster->nip }}
                        @else
                            NIP. 197610012006041011
                        @endif
                    </div>
                </div>

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
