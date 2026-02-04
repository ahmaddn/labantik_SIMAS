<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengantar - {{ $coverLetter->letter_number }}</title>
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

        /* --- JUDUL SURAT --- */
        .title-section {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .title-section h2 {
            font-size: 12pt;
            text-decoration: underline;
            margin: 0;
            font-weight: bold;
        }

        .title-section p {
            font-size: 11pt;
            margin: 5px 0 0 0;
        }

        /* --- TUJUAN --- */
        .recipient-section {
            width: 100%;
            margin-bottom: 20px;
            font-size: 10pt;
            position: relative;
        }

        .recipient-right {
            margin-left: 55%;
        }

        .recipient-table {
            border-collapse: collapse;
        }

        .recipient-table td {
            vertical-align: top;
            padding-bottom: 2px;
        }

        .recipient-table td:first-child {
            padding-right: 5px;
        }

        .recipient-indent {
            padding-left: 20px;
        }

        /* --- TABEL ISI --- */
        .content-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            margin-bottom: 20px;
        }

        .content-table th,
        .content-table td {
            border: 1px solid black;
            padding: 10px;
            vertical-align: top;
        }

        .content-table th {
            text-align: center;
            font-weight: bold;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .col-no {
            width: 5%;
            text-align: center;
        }

        .col-document {
            width: 45%;
        }

        .col-qty {
            width: 15%;
            text-align: center;
        }

        .col-notes {
            width: 35%;
        }

        /* --- TANDA TANGAN --- */
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 10pt;
        }

        .signature-left {
            width: 40%;
            margin-top: 80px;
        }

        .signature-right {
            width: 40%;
            text-align: center;
        }

        .position-title {
            margin-bottom: 70px;
        }

        .name-underline {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 2px;
        }

        .underline-blank {
            display: inline-block;
            border-bottom: 1px solid black;
            min-width: 150px;
        }

        /* Print-specific adjustments */
        @media print {
            .header {
                border-bottom: 4px double #000;
            }

            .header img {
                height: 80px;
            }

            .signature-area {
                page-break-inside: avoid;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <!-- TOMBOL AKSI -->
    <div class="action-buttons">
        <a href="{{ route('s_peng.coverLetters.index') }}" class="btn btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('s_peng.coverLetters.edit', $coverLetter->id) }}" class="btn btn-edit">
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

        <!-- JUDUL SURAT -->
        <div class="title-section">
            <h2>SURAT PENGANTAR</h2>
            <p>Nomor : {{ $coverLetter->letter_number }}</p>
        </div>

        <!-- TUJUAN -->
        <div class="recipient-section">
            <div class="recipient-right">
                <table class="recipient-table">
                    <tr>
                        <td></td>
                        <td>Talaga,
                            {{ \Carbon\Carbon::parse($coverLetter->issue_date)->locale('id')->isoFormat('D MMMM YYYY') }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kepada</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Yth.</td>
                        <td>{!! nl2br(e($coverLetter->towards)) !!}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="recipient-indent">di</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="recipient-indent" style="font-style: italic;">Tempat</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- TABEL ISI -->
        <table class="content-table">
            <thead>
                <tr>
                    <th class="col-no">NO</th>
                    <th class="col-document">NASKAH DINAS YANG DIKIRIMKAN</th>
                    <th class="col-qty">BANYAKNYA</th>
                    <th class="col-notes">KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
                @if ($coverLetter->details && $coverLetter->details->count() > 0)
                    @foreach ($coverLetter->details as $index => $detail)
                        <tr>
                            <td class="col-no">{{ $index + 1 }}.</td>
                            <td class="col-document">{{ $detail->document_sent ?? '-' }}</td>
                            <td class="col-qty">
                                {{ $detail->qty ?? '-' }}
                                @if ($detail->qty)
                                    <br>Bundel
                                @endif
                            </td>
                            <td class="col-notes">
                                {{ $detail->notes ?? 'Disampaikan dengan hormat, agar menjadi maklum dan untuk dapat penyelesaian sebagaimana mestinya.' }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="col-no">1.</td>
                        <td class="col-document" style="height: 150px;">&nbsp;</td>
                        <td class="col-qty">1 ( Satu )<br>Bundel</td>
                        <td class="col-notes">Disampaikan dengan hormat, agar menjadi maklum dan untuk dapat
                            penyelesaian sebagaimana mestinya.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- TANDA TANGAN -->
        <div class="signature-area">
            <div class="signature-left">
                <div>Diterima Tanggal: <span class="underline-blank"></span></div>
                <div style="margin-top: 5px;">Yang Menerima,</div>
                <div style="margin-top: 70px;">
                    <span class="underline-blank" style="min-width: 200px;"></span>
                </div>
            </div>

            <div class="signature-right">
                <div class="position-title">
                    @if ($coverLetter->headmaster)
                        {{ $coverLetter->headmaster->position ?? 'Kepala Sekolah' }}
                    @else
                        Kepala Sekolah
                    @endif
                </div>

                <span class="name-underline">
                    @if ($coverLetter->headmaster)
                        {{ $coverLetter->headmaster->name ?? 'MUCHAMAD EKI S.A., S.Kom' }}
                    @else
                        MUCHAMAD EKI S.A., S.Kom
                    @endif
                </span>
                <div>
                    @if ($coverLetter->headmaster && $coverLetter->headmaster->nip)
                        NIP. {{ $coverLetter->headmaster->nip }}
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
            fetch("{{ route('s_peng.coverLetters.increment-download', $coverLetter->id) }}", {
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
