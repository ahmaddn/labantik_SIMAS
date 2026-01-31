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

        /* --- KOP SURAT --- */
        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
            position: relative;
        }

        .header img {
            position: absolute;
            left: 5px;
            top: 0;
            width: 70px;
            height: auto;
        }

        .header h3,
        .header h2,
        .header h4,
        .header p {
            margin: 2px 0;
        }

        .header h4 {
            font-weight: normal;
            font-size: 10pt;
            font-weight: bold;
        }

        .header h2 {
            font-size: 11pt;
            font-weight: bold;
        }

        .header .address {
            font-family: Arial;
            /* Font standar surat dinas */
            font-size: 8pt;
            /* Ukuran pas, tidak terlalu kecil */
            font-weight: normal;
            text-align: center;
            /* KUNCI: Membuat teks rata tengah seperti gambar */
            line-height: 1.3;
            /* Jarak antar baris agar rapi tapi tidak dempet */
            margin-top: 5px;
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
            padding: 20mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            }

            /* Halaman 1 */
            @page {
                size: A4 portrait;
            }

            .page-portrait {
                page-break-after: always;
            }

            /* Halaman 2 */
            .page-landscape-wrapper {
                page-break-before: always;
                page: landscape-page;
                /* Panggil setting landscape */
            }
        }

        @page landscape-page {
            size: A4 landscape;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <!-- === HALAMAN 1: SURAT PERINTAH === -->
    <div class="page-portrait">
        <div class="header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Lambang_Jawa_Barat.svg/1200px-Lambang_Jawa_Barat.svg.png"
                alt="Logo" />
            <h4>PEMERINTAH DAERAH PROVINSI JAWA BARAT</h4>
            <h4>CABANG DINAS PENDIDIKAN WILAYAH IX</h4>
            <h2>SEKOLAH MENENGAH KEJURUAN NEGERI 1 TALAGA</h2>
            <div class="address">
                Bidang Keahlian: Teknologi dan Rekayasa, Teknologi Informasi
                Komunikasi, Bisnis dan Manajemen<br />

                Kampus 1: Jalan Sekolah Nomor 20 Desa Talagakulon Kecamatan
                Talaga Kabupaten Majalengka<br />

                Kampus 2: Jalan Talaga-Bantarujeg Desa Mekarraharja
                Kecamatan Talaga Kabupaten Majalengka<br />

                <!-- Baris Kontak -->
                Telpon <i class="fa-solid fa-phone"></i> (0233) 319238
                &nbsp; FAX <i class="fa-solid fa-fax"></i> (0233) 319238
                &nbsp; POS <i class="fa-solid fa-envelope"></i> 45463 &nbsp;
                NPSN: 20213872<br />

                <!-- Baris Web & Email -->
                Website <i class="fa-solid fa-globe"></i>
                <a href="http://www.smkn1talaga.sch.id">www.smkn1talaga.sch.id</a>
                &nbsp;–&nbsp; Email <i class="fa-solid fa-envelope"></i>
                <a href="mailto:admin@smkn1talaga.sch.id">admin@smkn1talaga.sch.id</a>
            </div>
        </div>

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
            Nomor : ........../KPG.11.01/SMKN1Tlg/CADISDIKWIL.IX/2026
        </div>

        <table class="no-border">
            <tr>
                <td style="width: 80px">Dasar</td>
                <td style="width: 10px">:</td>
                <td></td>
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
                <tr>
                    <td style="text-align: center">1.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-align: center">2.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <table class="no-border" style="margin-top: 15px">
            <tr>
                <td style="width: 80px">Untuk</td>
                <td style="width: 10px">:</td>
                <td>
                    <table class="no-border" style="margin: 0">
                        <tr>
                            <td style="width: 100px">Hari</td>
                            <td>:</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                        </tr>
                        <tr>
                            <td>Waktu</td>
                            <td>:</td>
                        </tr>
                        <tr>
                            <td>Tempat</td>
                            <td>:</td>
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
                Dikeluarkan di : Talaga<br />Pada Tanggal : 15 Januari
                2026<br />Kepala Sekolah <br /><br /><br /><br />
                <div style="font-weight: bold; text-decoration: underline">
                    MUCHAMAD EKI S.A., S.Kom.
                </div>
                <div>NIP. 197610012006041011</div>
            </div>
        </div>
    </div>

    <!-- === HALAMAN 2: SPPD (LANDSCAPE) === -->
    <div class="page-landscape-wrapper">
        <div class="page-landscape">
            <div class="sppd-container">        
                <!-- KOLOM KIRI -->
                <div class="col-left">

                    <!-- KOP SURAT (Dikecilkan agar muat) -->
                    <div class="header"
                        style="border-bottom: 2px solid black; margin-bottom: 5px; padding-bottom: 2px; position: relative; min-height: 90px;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Lambang_Jawa_Barat.svg/1200px-Lambang_Jawa_Barat.svg.png"
                            alt="Logo" style="position: absolute; top: 0; left: 0; width: 60px; height: auto;" />

                        <!-- Style khusus header ini saja -->
                        <div style="margin-left: 70px; text-align: center;">
                            <h4 style="font-size: 8pt; margin: 0;">PEMERINTAH DAERAH PROVINSI JAWA BARAT</h4>
                            <h4 style="font-size: 8pt; margin: 0;">CABANG DINAS PENDIDIKAN WILAYAH IX</h4>
                            <h2 style="font-size: 10pt; margin: 2px 0;">SEKOLAH MENENGAH KEJURUAN NEGERI 1 TALAGA</h2>

                            <div class="address" style="font-size: 6pt; line-height: 1.2;">
                                Bidang Keahlian: Teknologi dan Rekayasa, Teknologi Informasi Komunikasi, Bisnis dan
                                Manajemen<br />
                                Kampus 1: Jalan Sekolah Nomor 20 Desa Talagakulon Kecamatan Talaga Kabupaten
                                Majalengka<br />
                                Kampus 2: Jalan Talaga-Bantarujeg Desa Mekarraharja Kecamatan Talaga Kabupaten
                                Majalengka<br />
                                Telpon <i class="fa-solid fa-phone"></i> (0233) 319238 &nbsp; FAX <i
                                    class="fa-solid fa-fax"></i> (0233) 319238 &nbsp; POS <i
                                    class="fa-solid fa-envelope"></i> 45463 &nbsp; NPSN: 20213872<br />
                                Website <i class="fa-solid fa-globe"></i> <a href="http://www.smkn1talaga.sch.id"
                                    style="text-decoration:none; color:black;">www.smkn1talaga.sch.id</a> – Email <i
                                    class="fa-solid fa-envelope"></i> <a href="mailto:admin@smkn1talaga.sch.id"
                                    style="text-decoration:none; color:black;">admin@smkn1talaga.sch.id</a>
                            </div>
                        </div>
                    </div>

                    <!-- Info Lampiran (Font dikecilkan ke 8pt) -->
                    <table class="no-border" style="font-size: 8pt; margin-bottom: 5px; width: 100%;">
                        <tr>
                            <td width="80" style="padding:0;">Lampiran Ke</td>
                            <td style="padding:0;">: 1 (satu)</td>
                        </tr>
                        <tr>
                            <td style="padding:0;">Kode Nomor</td>
                            <td style="padding:0;">: -</td>
                        </tr>
                        <tr>
                            <td style="padding:0;">Nomor</td>
                            <td style="padding:0;">: 003/KPG.11.01/SMKN1Tlg/CADISDIKWIL.IX/2026</td>
                        </tr>
                    </table>

                    <div
                        style="text-align: center; font-weight: bold; text-decoration: underline; margin-bottom: 5px; font-size: 9pt;">
                        SURAT PERINTAH PERJALANAN DINAS (SPPD)
                    </div>

                    <!-- Tabel Isian (Menggunakan font 8pt dan padding kecil) -->
                    <table class="bordered sppd-table" style="font-size: 8pt; width: 100%;">
                        <tr>
                            <td width="20" align="center">1</td>
                            <td width="140">Penggunaan Anggaran/Kuasa Pengguna Anggaran</td>
                            <td><strong>MUCHAMAD EKI S.A., S.Kom.</strong></td>
                        </tr>
                        <tr>
                            <td align="center">2</td>
                            <td>Nama/NIP Pegawai Yang Melaksanakan Perjalanan Dinas</td>
                            <td>2. Kukun Zayyan Kurnia, S.Pd., M.Pd.Gr / 198410292009011002</td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>a. Pangkat dan Golongan<br>b. Jabatan/Instansi<br>c. Tingkat Biaya</td>
                            <td>a. Penata, III/c<br>b. Bendahara BOS / SMKN 1 Talaga<br>c. -</td>
                        </tr>
                        <tr>
                            <td align="center">4</td>
                            <td>Maksud Perjalanan Dinas</td>
                            <td>Rekonsiliasi Kelengkapan Tanda Bukti Belanja (SPJ) BOPD, BHP Tahun 2025</td>
                        </tr>
                        <tr>
                            <td align="center">5</td>
                            <td>Alat Angkutan</td>
                            <td>Kendaraan Umum/Pribadi</td>
                        </tr>
                        <tr>
                            <td align="center">6</td>
                            <td>a. Tempat Berangkat<br>b. Tempat Tujuan</td>
                            <td>a. SMKN 1 Talaga<br>b. Aula Cabang Dinas Pendidikan Wil. IX</td>
                        </tr>
                        <tr>
                            <td align="center">7</td>
                            <td>a. Lamanya<br>b. Tgl Berangkat<br>c. Tgl Kembali</td>
                            <td>a. 1 Hari<br>b. 13 Januari 2026<br>c. 13 Januari 2026</td>
                        </tr>
                        <tr>
                            <td align="center">8</td>
                            <td>Pengikut: Nama</td>
                            <td>NIP: - / Jabatan: -</td>
                        </tr>
                        <tr>
                            <td align="center">9</td>
                            <td>Pembebanan Anggaran</td>
                            <td>a. SMK Negeri 1 Talaga<br>b. -</td>
                        </tr>
                        <tr>
                            <td align="center">10</td>
                            <td>Keterangan Lain</td>
                            <td></td>
                        </tr>
                    </table>

                    <div style="font-size: 7pt; margin-top: 2px;">*) Coret yang tidak perlu</div>

                    <!-- Tanda Tangan (Diposisikan di kanan bawah) -->
                    <div style="text-align: left; margin-left: 55%; font-size: 8pt; margin-top: 10px;">
                        Dikeluarkan di : Talaga<br>
                        Pada Tanggal : 12 Januari 2026<br>
                        Kuasa Pengguna Anggaran
                        <br><br><br><br> <!-- Space TTD -->
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
                                Berangkat dari: SMKN 1 Talaga<br />
                                (Tempat Kedudukan)<br />
                                Ke: Aula Cabang Dinas Pendidikan Wilayah IX
                                Jabar<br />
                                Pada Tanggal: 13 Januari 2026
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
                                Tiba di : SMKN 1 Talaga<br />
                                Pada Tanggal : 13 Januari 2026<br /><br />
                                <div style="text-align: justify">
                                    Telah diperiksa dengan keterangan bahwa
                                    perjalanan tersebut atas perintahnya dan
                                    semata-mata untuk kepentingan jabatan
                                    dalam waktu yang sesingkat-singkatnya.
                                </div>
                                <div
                                    style="
                                            text-align: center;
                                            margin-top: 15px;
                                        ">
                                    Pengguna Anggaran/Kuasa Pengguna
                                    Anggaran
                                    <br /><br /><br /><br />
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
</body>

</html>
