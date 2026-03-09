<?php

namespace App\Exports;

use App\Models\M_Official_Travel_Orders;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Illuminate\Support\Collection;

class PerjalananDinasExport implements WithEvents, WithTitle
{
    protected Collection $travelOrders;
    protected string $dateFrom;
    protected string $dateTo;

    const DATA_START_ROW = 10;

    // Warna fill header (dihitung dari theme color + tint Office)
    // Uang Harian  : kuning   FFFF00
    // Penginapan   : biru muda B4C6E7  (theme4 #4472C4 + tint 0.6)
    // Transport    : hijau muda B4D7A8  (theme9 #70AD47 + tint 0.6)
    const COLOR_YELLOW = 'FFFF00';
    const COLOR_BLUE   = 'B4C6E7';
    const COLOR_GREEN  = 'B4D7A8';

    public function __construct(Collection $travelOrders, string $dateFrom, string $dateTo)
    {
        $this->travelOrders = $travelOrders;
        $this->dateFrom     = $dateFrom;
        $this->dateTo       = $dateTo;
    }

    public function title(): string
    {
        return 'Perjadin';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $this->buildSheet($sheet);
            },
        ];
    }

    // ================================================================
    // MAIN BUILDER
    // ================================================================

    private function buildSheet(Worksheet $sheet): void
    {
        $this->writeHeader($sheet);
        $this->writeData($sheet);
        $this->applyAutoColumnWidths($sheet);
    }

    // ================================================================
    // HELPER: border thin 4 sisi pada 1 cell
    // Menulis border per-cell (left/right/top/bottom) lebih reliable
    // daripada allBorders pada merged cell di PhpSpreadsheet
    // ================================================================

    private function setCellBorder(Worksheet $sheet, string $cellCoord): void
    {
        $sheet->getStyle($cellCoord)->applyFromArray([
            'borders' => [
                'left'   => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']],
                'right'  => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']],
                'top'    => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']],
                'bottom' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']],
            ],
        ]);
    }

    // ================================================================
    // HELPER: border thin pada range (untuk cell non-merged)
    // ================================================================

    private function setBorderRange(Worksheet $sheet, string $range): void
    {
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['rgb' => '000000'],
                ],
            ],
        ]);
    }

    // ================================================================
    // HELPER: set fill solid pada range
    // ================================================================

    private function setFill(Worksheet $sheet, string $range, string $rgbHex): void
    {
        $sheet->getStyle($range)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB($rgbHex);
    }

    // ================================================================
    // COLUMN WIDTHS
    // ================================================================

    // ================================================================
    // AUTO COLUMN WIDTHS
    // Minimal lebar per kolom, tapi menyesuaikan konten secara otomatis
    // ================================================================

    private function applyAutoColumnWidths(Worksheet $sheet): void
    {
        // Lebar minimum per kolom (karakter unit)
        $minWidths = [
            'A'  => 6,
            'B'  => 12,
            'C'  => 35,
            'D'  => 18,
            'E'  => 15,
            'F'  => 15,
            'G'  => 10,
            'H'  => 12,
            'I'  => 15,
            'J'  => 8,
            'K'  => 15,
            'L'  => 15,
            'M'  => 14,
            'N'  => 10,
            'O'  => 14,
            'P'  => 15,
            'Q'  => 14,
            'R'  => 10,
            'S'  => 14,
            'T'  => 14,
            'U'  => 10,
            'V'  => 18,
            'W'  => 14,
            'X'  => 20,
            'Y'  => 18,
            'Z'  => 14,
            'AA' => 14,
            'AB' => 16,
        ];

        $allCols = array_merge(range('A', 'Z'), ['AA', 'AB']);

        foreach ($allCols as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Flush auto-size calculation
        $sheet->calculateColumnWidths();

        // Pastikan tidak ada kolom yang lebih kecil dari minimum
        foreach ($minWidths as $col => $min) {
            $current = $sheet->getColumnDimension($col)->getWidth();
            if ($current < $min) {
                $sheet->getColumnDimension($col)
                    ->setAutoSize(false)
                    ->setWidth($min);
            }
        }
    }

    // ================================================================
    // HEADER (Rows 1–9)
    // ================================================================

    private function writeHeader(Worksheet $sheet): void
    {
        $tnr = 'Times New Roman';

        // ── Row Heights ──────────────────────────────────────────────
        $sheet->getRowDimension(1)->setRowHeight(14);
        $sheet->getRowDimension(2)->setRowHeight(15);
        $sheet->getRowDimension(3)->setRowHeight(40.5);
        $sheet->getRowDimension(4)->setRowHeight(15);
        $sheet->getRowDimension(5)->setRowHeight(14.15);
        $sheet->getRowDimension(6)->setRowHeight(14.65);
        $sheet->getRowDimension(7)->setRowHeight(14.65);
        $sheet->getRowDimension(8)->setRowHeight(37.15);
        $sheet->getRowDimension(9)->setRowHeight(12);

        // ── Row 1: Judul ─────────────────────────────────────────────
        $sheet->mergeCells('A1:AB1');
        $sheet->setCellValue('A1', 'Rekap Perjadin Dalam dan Luar Kota Tahun Anggaran 2025');
        $sheet->getStyle('A1')->applyFromArray([
            'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_TOP,
            ],
        ]);

        // ── Row 3: Nama OPD ──────────────────────────────────────────
        $sheet->setCellValue('B3', 'Nama OPD :');
        $sheet->setCellValue('C3', 'SMKN 1 TALAGA');
        $sheet->getStyle('B3:C3')->applyFromArray([
            'font' => ['name' => $tnr, 'bold' => true, 'size' => 11],
        ]);

        // ── Row 5–8: Header kolom A–L (merge per kolom 5:8) ──────────
        // KUNCI: untuk merged cell yang span beberapa baris,
        // border harus di-set di SETIAP baris (bukan hanya cell pertama)
        // agar garis tidak putus-putus
        $singleCols = [
            'A' => 'No.',
            'B' => 'OPD',
            'C' => 'Nama Kegiatan (DPA)',
            'D' => 'Nomor ST/SPPD',
            'E' => 'Nama',
            'F' => 'NIP',
            'G' => 'Golongan / Pangkat',
            'H' => 'Kab/Kota Tujuan',
            'I' => 'Lokasi Tujuan',
            'J' => 'Lama Tugas (hari)',
            'K' => 'Tanggal Berangkat',
            'L' => 'Tanggal Kembali',
        ];
        foreach ($singleCols as $col => $label) {
            $sheet->mergeCells("{$col}5:{$col}8");
            $sheet->setCellValue("{$col}5", $label);
            $sheet->getStyle("{$col}5")->applyFromArray([
                'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'   => Alignment::VERTICAL_TOP,
                    'wrapText'   => true,
                ],
            ]);
            // Set border di setiap baris yang di-span
            foreach ([5, 6, 7, 8] as $row) {
                $this->setCellBorder($sheet, "{$col}{$row}");
            }
        }

        // ── Row 5: M5:AB5 – "Rincian Biaya" ──────────────────────────
        $sheet->mergeCells('M5:AB5');
        $sheet->setCellValue('M5', 'Rincian Biaya');
        $sheet->getStyle('M5')->applyFromArray([
            'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_TOP,
            ],
        ]);
        $this->setBorderRange($sheet, 'M5:AB5');

        // ── Row 6: Sub-group headers ──────────────────────────────────

        // M6:O6 – Uang Harian (kuning)
        $sheet->mergeCells('M6:O6');
        $sheet->setCellValue('M6', 'Uang Harian');
        $sheet->getStyle('M6')->applyFromArray([
            'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_TOP,
            ],
        ]);
        $this->setFill($sheet, 'M6:O6', self::COLOR_YELLOW);
        $this->setBorderRange($sheet, 'M6:O6');

        // P6:S6 – Penginapan (biru muda)
        $sheet->mergeCells('P6:S6');
        $sheet->setCellValue('P6', 'Penginapan');
        $sheet->getStyle('P6')->applyFromArray([
            'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_TOP,
            ],
        ]);
        $this->setFill($sheet, 'P6:S6', self::COLOR_BLUE);
        $this->setBorderRange($sheet, 'P6:S6');

        // T6:Z6 – Transport (hijau muda)
        $sheet->mergeCells('T6:Z6');
        $sheet->setCellValue('T6', 'Transport');
        $sheet->getStyle('T6')->applyFromArray([
            'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_TOP,
            ],
        ]);
        $this->setFill($sheet, 'T6:Z6', self::COLOR_GREEN);
        $this->setBorderRange($sheet, 'T6:Z6');

        // AA6:AA8 – Uang Representatif (merge 3 baris, border per baris)
        $sheet->mergeCells('AA6:AA8');
        $sheet->setCellValue('AA6', 'Uang Representatif (jika ada)');
        $sheet->getStyle('AA6')->applyFromArray([
            'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_TOP,
                'wrapText'   => true,
            ],
        ]);
        foreach ([6, 7, 8] as $row) {
            $this->setCellBorder($sheet, "AA{$row}");
        }

        // AB6:AB8 – Jumlah Total (merge 3 baris, border per baris)
        $sheet->mergeCells('AB6:AB8');
        $sheet->setCellValue('AB6', "Jumlah Total\n(Rp)");
        $sheet->getStyle('AB6')->applyFromArray([
            'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_TOP,
                'wrapText'   => true,
            ],
        ]);
        foreach ([6, 7, 8] as $row) {
            $this->setCellBorder($sheet, "AB{$row}");
        }

        // ── Row 7–8: Detail sub-headers (merge per kolom 7:8) ────────
        // Uang Harian
        $this->writeDetailHeader($sheet, 'M', 'Perhari',                                   self::COLOR_YELLOW, $tnr);
        $this->writeDetailHeader($sheet, 'N', 'Jumlah hari',                               self::COLOR_YELLOW, $tnr);
        $this->writeDetailHeader($sheet, 'O', "Total\n(Rp)",                               self::COLOR_YELLOW, $tnr);
        // Penginapan
        $this->writeDetailHeader($sheet, 'P', 'Nama Hotel',                                self::COLOR_BLUE, $tnr);
        $this->writeDetailHeader($sheet, 'Q', 'Harga Kamar/per malam',                    self::COLOR_BLUE, $tnr);
        $this->writeDetailHeader($sheet, 'R', 'Lama Menginap (malam)',                    self::COLOR_BLUE, $tnr);
        $this->writeDetailHeader($sheet, 'S', "Total\n(Rp)",                              self::COLOR_BLUE, $tnr);
        // Transport
        $this->writeDetailHeader($sheet, 'T', 'BBM',                                      self::COLOR_GREEN, $tnr);
        $this->writeDetailHeader($sheet, 'U', 'Tol',                                      self::COLOR_GREEN, $tnr);
        $this->writeDetailHeader($sheet, 'V', 'Biaya Pesawat/Kereta/Travel/Taxi',         self::COLOR_GREEN, $tnr);
        $this->writeDetailHeader($sheet, 'W', "Total\n(Rp)",                              self::COLOR_GREEN, $tnr);
        $this->writeDetailHeader($sheet, 'X', 'Nama Maskapai (jika menggunakan pesawat)', self::COLOR_GREEN, $tnr);
        $this->writeDetailHeader($sheet, 'Y', 'Kode booking pesawat',                     self::COLOR_GREEN, $tnr);
        $this->writeDetailHeader($sheet, 'Z', 'No Tiket Pesawat',                         self::COLOR_GREEN, $tnr);

        // ── Row 9: Nomor Kolom ────────────────────────────────────────
        $colNums = [
            'A'  => 1,
            'B'  => 2,
            'C'  => 3,
            'D'  => 4,
            'E'  => 5,
            'F'  => 6,
            'G'  => 7,
            'H'  => 8,
            'I'  => 9,
            'J'  => 10,
            'K'  => 11,
            'L'  => 12,
            'M'  => 13,
            'N'  => 14,
            'O'  => '15 = (13 * 14)',
            'P'  => 16,
            'Q'  => 17,
            'R'  => 18,
            'S'  => '19 = (17 * 18)',
            'T'  => 20,
            'U'  => 21,
            'V'  => 22,
            'W'  => '23 = (20 + 21 + 22)',
            'X'  => 24,
            'Y'  => 25,
            'Z'  => 26,
            'AA' => 27,
            'AB' => '28 = 15 + 19 +23 +27',
        ];
        foreach ($colNums as $col => $num) {
            $sheet->setCellValue("{$col}9", $num);
            $sheet->getStyle("{$col}9")->applyFromArray([
                'font'      => ['name' => $tnr, 'bold' => true, 'size' => 9],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'   => Alignment::VERTICAL_TOP,
                ],
            ]);
            $this->setCellBorder($sheet, "{$col}9");
        }

        // Page setup
        $sheet->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A3);
    }

    // ================================================================
    // HELPER: tulis detail sub-header dengan merge row 7:8
    // Border di-set di KEDUA baris (7 dan 8) agar tidak putus
    // ================================================================

    private function writeDetailHeader(
        Worksheet $sheet,
        string    $col,
        string    $label,
        string    $colorHex,
        string    $fontName
    ): void {
        $sheet->mergeCells("{$col}7:{$col}8");
        $sheet->setCellValue("{$col}7", $label);
        $sheet->getStyle("{$col}7")->applyFromArray([
            'font'      => ['name' => $fontName, 'bold' => true, 'size' => 11],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_TOP,
                'wrapText'   => true,
            ],
        ]);
        $this->setFill($sheet, "{$col}7:{$col}8", $colorHex);
        // Border di row 7 DAN row 8 (penting agar garis bawah tidak hilang)
        $this->setCellBorder($sheet, "{$col}7");
        $this->setCellBorder($sheet, "{$col}8");
    }

    // ================================================================
    // DATA ROWS (Row 10+)
    // ================================================================

    private function writeData(Worksheet $sheet): void
    {
        $tnr = 'Times New Roman';

        // ── Number format Rupiah ──────────────────────────────────────
        // CATATAN PENTING: PHP '\-' di dalam setFormatCode akan di-escape
        // ganda oleh PhpSpreadsheet → gunakan format tanpa backslash.
        //
        // Format:  "Rp "  #,##0  → contoh: Rp 430.000
        // Format:  "Rp "  #,##0.00 → contoh: Rp 430.000,00
        //
        // fmtRp     → kolom M, Q (uang harian per hari, harga kamar)
        // fmtRpCalc → kolom O, S, W, T, U, V, AB (hasil kalkulasi / total)

        $fmtRp     = '"Rp "#,##0';       // bilangan bulat ribuan
        $fmtRpCalc = '"Rp "#,##0';       // sama — konsisten tanpa desimal

        $rowIndex = 1;

        foreach ($this->travelOrders as $order) {
            $employees  = $order->employees;
            $dailyFirst = $order->dailyAllowances->first();
            $accomFirst = $order->accommodations->first();

            $bbm = $toll = $planeCost = null;
            $airlineName = $bookingCode = $ticketNumber = null;

            foreach ($order->transports as $transport) {
                $cat = strtolower($transport->category?->name ?? '');
                if (str_contains($cat, 'tol')) {
                    $toll = ($toll ?? 0) + ($transport->amount ?? 0);
                } elseif (
                    str_contains($cat, 'pesawat') || str_contains($cat, 'kereta') ||
                    str_contains($cat, 'travel')  || str_contains($cat, 'taxi')
                ) {
                    $planeCost    = ($planeCost ?? 0) + ($transport->amount ?? 0);
                    $airlineName  = $transport->airline_name;
                    $bookingCode  = $transport->booking_code;
                    $ticketNumber = $transport->ticket_number;
                } else {
                    $bbm = ($bbm ?? 0) + ($transport->amount ?? 0);
                }
            }

            $representative = $order->representativeAllowance?->amount;
            $employeeList   = $employees->count() > 0 ? $employees : collect([null]);

            foreach ($employeeList as $participant) {
                $employee = $participant?->employee;

                $dailyRow = null;
                if ($employee) {
                    $dailyRow = $order->dailyAllowances->first(
                        fn($d) => str_contains(
                            strtolower($d->employee_name ?? ''),
                            strtolower($employee->full_name ?? '')
                        )
                    );
                }
                $dailyRow = $dailyRow ?? $dailyFirst;

                $r = self::DATA_START_ROW + ($rowIndex - 1);

                // ── Hitung nilai langsung di PHP (tidak pakai formula string)
                //    agar nilai langsung muncul tanpa perlu Excel recalculate ──

                $amountPerDay   = (float) ($dailyRow?->amount_per_day ?: 0);
                $days           = (int)   ($dailyRow?->days ?: 0);
                $totalHarian    = $amountPerDay * $days;

                $pricePerNight  = (float) ($accomFirst?->price_per_night ?: 0);
                $nights         = (int)   ($accomFirst?->duration_nights ?: 0);
                $totalPenginapan = $pricePerNight * $nights;

                $totalTransport = (float) ($bbm ?? 0) + (float) ($toll ?? 0) + (float) ($planeCost ?? 0);

                $rep            = (float) ($representative ?? 0);
                $grandTotal     = $totalHarian + $totalPenginapan + $totalTransport + $rep;

                // ── Isi nilai ─────────────────────────────────────────
                $sheet->setCellValue("A{$r}", $rowIndex);
                $sheet->setCellValue("B{$r}", null);
                $sheet->setCellValue("C{$r}", $order->purpose);
                $sheet->setCellValue("D{$r}", $order->letter_number);
                $sheet->setCellValue("E{$r}", $employee?->full_name ?? '');
                $sheet->setCellValue("F{$r}", $employee?->nip ?? '');
                $sheet->setCellValue("G{$r}", $employee?->golongan ?? '');
                $sheet->setCellValue("H{$r}", $order->departure_to);
                $sheet->setCellValue("I{$r}", $order->departure_place);
                $sheet->setCellValue("J{$r}", $order->duration_days ?? null);
                $sheet->setCellValue("K{$r}", $order->departure_date
                    ? Carbon::parse($order->departure_date)->locale('id')->translatedFormat('d F Y') : '');
                $sheet->setCellValue("L{$r}", $order->return_date
                    ? Carbon::parse($order->return_date)->locale('id')->translatedFormat('d F Y') : '');

                // Uang Harian
                $sheet->setCellValue("M{$r}", $amountPerDay ?: null);
                $sheet->setCellValue("N{$r}", $days ?: null);
                $sheet->setCellValue("O{$r}", $totalHarian ?: null);

                // Penginapan
                $sheet->setCellValue("P{$r}", $accomFirst?->hotel_name);
                $sheet->setCellValue("Q{$r}", $pricePerNight ?: null);
                $sheet->setCellValue("R{$r}", $nights ?: null);
                $sheet->setCellValue("S{$r}", $totalPenginapan ?: null);

                // Transport
                $sheet->setCellValue("T{$r}", $bbm ?: null);
                $sheet->setCellValue("U{$r}", $toll ?: null);
                $sheet->setCellValue("V{$r}", $planeCost ?: null);
                $sheet->setCellValue("W{$r}", $totalTransport ?: null);

                // Info tiket & total
                $sheet->setCellValue("X{$r}", $airlineName);
                $sheet->setCellValue("Y{$r}", $bookingCode);
                $sheet->setCellValue("Z{$r}", $ticketNumber);
                $sheet->setCellValue("AA{$r}", $rep ?: null);
                $sheet->setCellValue("AB{$r}", $grandTotal ?: null);

                // ── Style dasar: font + border semua kolom ────────────
                $sheet->getStyle("A{$r}:AB{$r}")->applyFromArray([
                    'font' => ['name' => $tnr, 'size' => 11],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color'       => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // ── Alignment ─────────────────────────────────────────
                $sheet->getStyle("A{$r}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("C{$r}")->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);

                $sheet->getStyle("E{$r}")->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // ── Number format Rp ──────────────────────────────────
                $sheet->getStyle("M{$r}")->getNumberFormat()->setFormatCode($fmtRp);
                $sheet->getStyle("Q{$r}")->getNumberFormat()->setFormatCode($fmtRp);
                foreach (['O', 'S', 'T', 'U', 'V', 'W', 'AA', 'AB'] as $col) {
                    $sheet->getStyle("{$col}{$r}")->getNumberFormat()->setFormatCode($fmtRpCalc);
                }

                // ── Font merah: Total Uang Harian (O) & Total Penginapan (S) ──
                $sheet->getStyle("O{$r}")->getFont()->getColor()->setRGB('FF0000');
                $sheet->getStyle("S{$r}")->getFont()->getColor()->setRGB('FF0000');

                // ── Row height: otomatis mengikuti konten ────────────
                // setRowHeight(-1) = auto height di PhpSpreadsheet
                $sheet->getRowDimension($r)->setRowHeight(-1);

                $rowIndex++;
            }
        }
    }
}
