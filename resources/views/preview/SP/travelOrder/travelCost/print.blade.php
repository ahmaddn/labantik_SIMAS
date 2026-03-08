<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen Perjalanan Dinas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            font-size: 10pt;
            line-height: 1.3;
            margin: 0;
            background-color: #f0f0f0;
        }

        @page {
            size: A4;
            margin: 1.5cm;
        }

        .page-break {
            page-break-before: always;
            margin-top: 50px;
            display: block;
            border-top: 1px dashed #ccc;
            padding-top: 20px;
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
            font-size: 10px;
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

        @media print {
            .action-buttons {
                display: none !important;
            }

            body {
                background: none;
                margin: 0;
                padding: 0;
            }

            .page-portrait {
                width: 100%;
                min-height: auto;
                padding: 0;
                margin: 0;
                box-shadow: none !important;
                border: none !important;
                background-color: white !important;
                page-break-after: always;
            }

            .page-break {
                display: none !important;
            }

            @page {
                size: A4;
                margin: 15mm 20mm;
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

        /* --- HALAMAN --- */
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

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .underline {
            text-decoration: underline;
        }

        .italic {
            font-style: italic;
        }

        /* --- TABEL --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            vertical-align: top;
            padding: 5px;
        }

        th {
            background-color: #d9d9d9;
            text-align: center;
            font-weight: bold;
            border: 1px solid #000;
        }

        .rincian-table td {
            border: 1px solid #000;
        }

        .no-border td {
            border: none;
        }

        .total-row {
            background-color: #d9d9d9;
            font-weight: bold;
        }

        .total-row td {
            border: 1px solid #000;
        }

        .ttd-container {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            page-break-inside: avoid;
        }

        .ttd-box {
            width: 45%;
            text-align: left;
        }

        .ttd-space {
            height: 60px;
        }

        .parallelogram {
            transform: skew(-20deg);
            border: 1px solid #000;
            padding: 10px;
            display: inline-block;
            margin: 5px 0;
            min-width: 300px;
            text-align: center;
            margin-left: 50px;
        }

        .parallelogram-content {
            transform: skew(20deg);
            font-weight: bold;
        }

        .kuitansi-info td {
            border: none;
            padding: 3px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <div class="action-buttons">
        <a href="{{ route('sp.travelOrders.index') }}" class="btn btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('sp.travelCosts.edit', $travelOrder->id) }}" class="btn btn-edit">
            <i class="fa-solid fa-edit"></i> Edit
        </a>
        <button onclick="window.print()" class="btn btn-print">
            <i class="fa-solid fa-print"></i> Print
        </button>
    </div>

    {{-- ======================================================= --}}
    {{-- PAGE 1 — RINCIAN BIAYA PERJALANAN DINAS                 --}}
    {{-- ======================================================= --}}
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
            <h4 class="text-center underline">RINCIAN BIAYA PERJALANAN DINAS</h4>

            <table class="no-border" style="width: 100%; margin-bottom: 10px;">
                <tr>
                    <td style="width: 180px;">Lampiran SPPD Nomor</td>
                    <td>: {{ $travelOrder->letter_number }}</td>
                </tr>
            </table>

            <table class="rincian-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">NO</th>
                        <th>PERINCIAN BIAYA</th>
                        <th style="width: 20%;">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- 1. Uang Harian --}}
                    <tr style="background-color: #d9d9d9;">
                        <td class="bold">1.</td>
                        <td class="bold">Uang Harian</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <table class="no-border" style="width:100%; margin:0;">
                                @forelse($travelOrder->dailyAllowances as $daily)
                                    <tr>
                                        <td>{{ $daily->employee_name }}</td>
                                        <td style="text-align:right;">
                                            {{ $daily->days }} hari x
                                            {{ number_format($daily->amount_per_day, 0, ',', '.') }},-
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                @endforelse
                            </table>
                        </td>
                        <td style="text-align:right; vertical-align: top; padding-top: 2px; line-height: 1.8;">
                            @foreach ($travelOrder->dailyAllowances as $daily)
                                {{ number_format($daily->total_amount, 0, ',', '.') }},-<br>
                            @endforeach
                        </td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="2" class="text-right">Jumlah Uang Harian</td>
                        <td class="text-right">{{ number_format($travelOrder->total_daily_allowance, 0, ',', '.') }},-
                        </td>
                    </tr>

                    {{-- 2. Uang Saku --}}
                    <tr style="background-color: #d9d9d9;">
                        <td class="bold">2.</td>
                        <td class="bold">Uang Saku</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $travelOrder->pocketMoney?->note ?? '' }}&nbsp;</td>
                        <td class="text-right">
                            @if ($travelOrder->pocketMoney && $travelOrder->pocketMoney->amount > 0)
                                {{ number_format($travelOrder->pocketMoney->amount, 0, ',', '.') }},-
                            @else
                                0,-
                            @endif
                        </td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="2" class="text-right">Jumlah Uang Saku</td>
                        <td class="text-right">{{ number_format($travelOrder->total_pocket_money, 0, ',', '.') }},-
                        </td>
                    </tr>

                    {{-- 3. Akomodasi --}}
                    <tr style="background-color: #d9d9d9;">
                        <td class="bold">3.</td>
                        <td class="bold">Akomodasi</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            @foreach ($travelOrder->transports as $transport)
                                {{ $transport->category?->name ?? 'Transport' }}
                                <span
                                    style="float:right;">{{ number_format($transport->amount, 0, ',', '.') }},-</span><br>
                            @endforeach
                            @foreach ($travelOrder->accommodations as $accommodation)
                                {{ $accommodation->category?->name ?? 'Penginapan' }}
                                <span
                                    style="float:right;">{{ number_format($accommodation->total_amount, 0, ',', '.') }},-</span><br>
                            @endforeach
                            @if ($travelOrder->transports->isEmpty() && $travelOrder->accommodations->isEmpty())
                                &nbsp;
                            @endif
                        </td>
                        <td class="text-right"></td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="2" class="text-right">Jumlah Akomodasi</td>
                        <td class="text-right">
                            {{ number_format($travelOrder->total_accommodation + $travelOrder->total_transport, 0, ',', '.') }},-
                        </td>
                    </tr>

                    {{-- Jika ada Uang Representatif, tampilkan sebagai baris ke-4 --}}
                    @if ($travelOrder->representativeAllowance && $travelOrder->representativeAllowance->amount > 0)
                        <tr style="background-color: #d9d9d9;">
                            <td class="bold">4.</td>
                            <td class="bold">Uang Representatif</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>{{ $travelOrder->representativeAllowance->note ?? '' }}&nbsp;</td>
                            <td class="text-right">
                                {{ number_format($travelOrder->representativeAllowance->amount, 0, ',', '.') }},-</td>
                        </tr>
                        <tr class="total-row">
                            <td colspan="2" class="text-right">Jumlah Uang Representatif</td>
                            <td class="text-right">
                                {{ number_format($travelOrder->total_representative, 0, ',', '.') }},-</td>
                        </tr>
                    @endif

                    <tr class="total-row">
                        <td colspan="2" class="text-right">JUMLAH TOTAL</td>
                        <td class="text-right">{{ number_format($travelOrder->grand_total, 0, ',', '.') }},-</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="italic bold">
                            Terbilang: {{ ucfirst(\App\Helpers\Terbilang::convert($travelOrder->grand_total)) }} Rupiah
                        </td>
                    </tr>

                </tbody>
            </table>

            {{-- TTD Rincian Biaya --}}
            <div class="ttd-container">
                <div class="ttd-box">
                    <p>Telah dibayar, sejumlah<br>
                        Rp {{ number_format($travelOrder->grand_total, 0, ',', '.') }},-<br>
                        Bendahara</p>
                    <div class="ttd-space"></div>
                    @php $bendahara = $travelOrder->employees->first(fn($e) => optional($e->employee)->job_position === 'Bendahara') ?? $travelOrder->employees->skip(1)->first(); @endphp
                    <p class="bold">
                        {{ $travelOrder->treasurer?->employee?->full_name ?? ($travelOrder->treasurer?->name ?? '-') }}
                    </p>
                    <p>NIP {{ $travelOrder->treasurer?->employee?->nip ?? '-' }}</p>
                </div>
                <div class="ttd-box">
                    <p>{{ $travelOrder->issue_date?->translatedFormat('d F Y') ?? '-' }}<br>
                        Telah menerima jumlah uang sebesar<br>
                        Rp {{ number_format($travelOrder->grand_total, 0, ',', '.') }},-<br>
                        Yang Menerima,</p>
                    <div class="ttd-space"></div>
                    @php $penerima = $travelOrder->employees->first(); @endphp
                    <p class="bold">{{ optional(optional($penerima)->employee)->name ?? '-' }}</p>
                    <p>NIP {{ optional(optional($penerima)->employee)->nip ?? '-' }}</p>
                </div>
            </div>

            {{-- PERHITUNGAN SPPD RAMPUNG --}}
            <div style="margin-top: 15px">
                <div style="border-bottom: 2px solid #000;">
                    <h4 class="text-center underline" style="margin:0;">PERHITUNGAN SPPD RAMPUNG</h4>
                    <table class="no-border" style="width:60%; margin: 10px auto;">
                        <tr>
                            <td>Ditetapkan sejumlah</td>
                            <td>: Rp {{ number_format($travelOrder->grand_total, 0, ',', '.') }},-</td>
                        </tr>
                        <tr>
                            <td>Yang telah dibayar semula</td>
                            <td>: Rp -</td>
                        </tr>
                        <tr>
                            <td>Sisa kurang/lebih</td>
                            <td>: Rp {{ number_format($travelOrder->grand_total, 0, ',', '.') }},-</td>
                        </tr>
                    </table>
                </div>

                <div class="ttd-container" style="margin-top: 10px; justify-content: flex-end;">
                    <div class="ttd-box">
                        <p>{{ $travelOrder->issue_date?->translatedFormat('d F Y') ?? '-' }}<br>Kuasa Pengguna
                            Anggaran,</p>
                        <div class="ttd-space"></div>
                        <p class="bold">
                            {{ $travelOrder->headmaster?->employee?->full_name ?? ($travelOrder->headmaster?->name ?? '-') }}
                        </p>
                        <p>NIP: {{ $travelOrder->headmaster?->employee?->nip ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- PAGE 2 — DAFTAR PENERIMAAN UANG HARIAN DAN UANG SAKU   --}}
    {{-- ======================================================= --}}
    <div class="page-portrait">
        <div class="header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Coat_of_arms_of_West_Java.svg/500px-Coat_of_arms_of_West_Java.svg.png"
                alt="Logo" />
            <h4>PEMERINTAH DAERAH PROVINSI JAWA BARAT</h4>
            <h4>CABANG DINAS PENDIDIKAN WILAYAH IX</h4>
            <h2>SEKOLAH MENENGAH KEJURUAN NEGERI 1 TALAGA</h2>
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
            <h4 class="text-center">DAFTAR PENERIMAAN UANG HARIAN DAN UANG SAKU<br>PERJALANAN DINAS PROVINSI</h4>

            <table class="no-border" style="width: 100%; margin-bottom: 10px;">
                <tr>
                    <td style="width: 180px;">Lampiran SPPD Nomor</td>
                    <td>: {{ $travelOrder->letter_number }}</td>
                </tr>
                <tr>
                    <td>Tempat Tujuan</td>
                    <td>: {{ $travelOrder->departure_to }}</td>
                </tr>
            </table>

            <table class="rincian-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>GOL</th>
                        <th>UANG HARIAN</th>
                        <th>UANG SAKU</th>
                        <th>JUMLAH</th>
                        <th>TANDA TANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($travelOrder->dailyAllowances as $index => $daily)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}.</td>
                            <td>{{ $daily->employee_name }}</td>
                            <td class="text-center">
                                {{-- Coba ambil golongan dari relasi employees jika ada --}}
                                @php
                                    $emp = $travelOrder->employees->first(
                                        fn($e) => optional($e->employee)->name === $daily->employee_name,
                                    );
                                @endphp
                                {{ optional(optional($emp)->employee)->golongan ?? '-' }}
                            </td>
                            <td class="text-center">
                                {{ $daily->days }} x {{ number_format($daily->amount_per_day, 0, ',', '.') }},- =
                                {{ number_format($daily->total_amount, 0, ',', '.') }},-
                            </td>
                            <td class="text-center">
                                @if ($travelOrder->pocketMoney && $travelOrder->pocketMoney->amount > 0)
                                    {{ number_format($travelOrder->pocketMoney->amount, 0, ',', '.') }},-
                                @endif
                            </td>
                            <td class="text-right">{{ number_format($daily->total_amount, 0, ',', '.') }},-</td>
                            <td></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse

                    {{-- Baris kosong untuk ruang TTD --}}
                    <tr style="height: 30px;">
                        <td colspan="7"></td>
                    </tr>
                    <tr style="height: 30px;">
                        <td colspan="7"></td>
                    </tr>

                    <tr class="total-row">
                        <td colspan="5" class="text-center">Jumlah</td>
                        <td class="text-right">{{ number_format($travelOrder->total_daily_allowance, 0, ',', '.') }},-
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="ttd-container">
                <div class="ttd-box">
                    <p>Kuasa Pengguna Anggaran,</p>
                    <div class="ttd-space"></div>
                    <p class="bold">
                        {{ $travelOrder->headmaster?->employee?->full_name ?? ($travelOrder->headmaster?->name ?? '-') }}
                    </p>
                    <p>NIP: {{ $travelOrder->headmaster?->employee?->nip ?? '-' }}</p>
                </div>
                <div class="ttd-box">
                    <p>{{ $travelOrder->issue_date?->translatedFormat('d F Y') ?? '-' }}<br>Bendahara</p>
                    <div class="ttd-space"></div>
                    @php $bendahara2 = $travelOrder->employees->skip(1)->first(); @endphp
                    <p class="bold">
                        {{ $travelOrder->treasurer?->employee?->full_name ?? ($travelOrder->treasurer?->name ?? '-') }}
                    </p>
                    <p>NIP {{ $travelOrder->treasurer?->employee?->nip ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- PAGE 3 — KUITANSI                                       --}}
    {{-- ======================================================= --}}
    <div class="page-portrait">
        <div class="portrait-content">
            <h3 class="underline bold">KUITANSI (TANDA PEMBAYARAN)</h3>
            <table class="no-border" style="width: 100%; margin-bottom: 20px;">
                <tr>
                    <td style="width: 50%;"></td>
                    <td>
                        Nomor : {{ $travelOrder->letter_number ?? '...' }}
                        CADISDIKWIL.IX/{{ $travelOrder->issue_date?->format('Y') ?? date('Y') }}<br>
                        Kodering : 5.1.02.04.01.0001
                    </td>
                </tr>
            </table>

            <table class="no-border kuitansi-info" style="width: 100%;">
                <tr>
                    <td style="width: 150px;">Sudah Terima Dari</td>
                    <td>: Bendahara SMKN 1 Talaga</td>
                </tr>
                <tr>
                    <td>Kegiatan</td>
                    <td>: {{ $travelOrder->purpose }}</td>
                </tr>
                <tr>
                    <td>Banyaknya</td>
                    <td>:
                        <div class="parallelogram">
                            <span class="parallelogram-content">===
                                {{ ucfirst(\App\Helpers\Terbilang::convert($travelOrder->grand_total)) }} Rupiah
                                ===</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Uang Sejumlah</td>
                    <td>:
                        <div class="parallelogram">
                            <span class="parallelogram-content">Rp
                                {{ number_format($travelOrder->grand_total, 0, ',', '.') }},-</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Yaitu</td>
                    <td>: {{ $travelOrder->purpose }}
                        @php $penerimaKuitansi = $travelOrder->employees->first(); @endphp
                        An {{ optional(optional($penerimaKuitansi)->employee)->name ?? '-' }}
                        tgl {{ $travelOrder->departure_date?->translatedFormat('d F Y') ?? '-' }}
                    </td>
                </tr>
            </table>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 0; margin-top: 30px;">

                {{-- Kolom 1: KPA --}}
                <div style="text-align: center; padding: 1px 15px; border: 1px solid #000;">
                    <p style="margin: 10px 0 112px 0; font-size: 10px; font-style: italic;">
                        Setuju Dibayar :<br>Kuasa Pengguna Anggaran
                    </p>
                    <p style="margin: 0; font-size: 10px; font-weight: bold; font-style: italic;">
                    <p class="bold">
                        {{ $travelOrder->headmaster?->employee?->full_name ?? ($travelOrder->headmaster?->name ?? '-') }}
                    </p>
                    </p>
                    <p style="margin: 0; font-size: 10px; font-style: italic;">
                    <p>NIP: {{ $travelOrder->headmaster?->employee?->nip ?? '-' }}</p>
                    </p>
                </div>

                {{-- Kolom 2: Bendahara --}}
                <div
                    style="text-align: center; padding: 1px 15px; border: 1px solid #000; border-left: none; border-right: none;">
                    <p style="margin: 35px 0 100px 0; font-size: 10px; font-style: italic;">Bendahara</p>
                    @php $bendahara3 = $travelOrder->employees->skip(1)->first(); @endphp
                    <p style="margin: 0; font-size: 10px; font-weight: bold; font-style: italic;">
                        {{ $travelOrder->treasurer?->employee?->full_name ?? ($travelOrder->treasurer?->name ?? '-') }}
                    </p>
                    <p style="margin: 0; font-size: 10px; font-style: italic;">
                        NIP: {{ $travelOrder->treasurer?->employee?->nip ?? '-' }}
                    </p>
                </div>

                {{-- Kolom 3: Yang Menerima --}}
                <div style="padding: 10px 15px; border: 1px solid #000;">
                    <p style="margin: 0 0 5px 0; font-size: 10px;">
                        {{ $travelOrder->issue_date?->translatedFormat('d F Y') ?? '-' }}<br>Yang menerima
                    </p>
                    @php $penerimaKol = $travelOrder->employees->first(); @endphp
                    <table style="width: 100%; margin: 0; border: none; border-collapse: collapse;">
                        <tr>
                            <td style="border: none; padding: 1px 0; width: 50px; font-size: 10px;">Nama</td>
                            <td style="border: none; padding: 1px 0; font-size: 10px;">:
                                {{ optional(optional($penerimaKol)->employee)->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 1px 0; font-size: 10px;">NIP</td>
                            <td style="border: none; padding: 1px 0; font-size: 10px;">:
                                {{ optional(optional($penerimaKol)->employee)->nip ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 1px 0; font-size: 10px;">Jabatan</td>
                            <td style="border: none; padding: 1px 0; font-size: 10px;">:
                                {{ optional(optional($penerimaKol)->employee)->jabatan ?? 'Guru' }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="border: none; padding: 30px 0 0 0; font-size: 10px;">Tanda Tangan</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
