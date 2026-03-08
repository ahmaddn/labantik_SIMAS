<?php

namespace App\Exports;

use App\Models\M_Official_Travel_Orders;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Collection;

class PerjalananDinasExport implements WithEvents, WithTitle
{
    protected Collection $travelOrders;
    protected string $dateFrom;
    protected string $dateTo;

    // Row offset: baris data mulai dari row 10 (1-indexed)
    // Row 1  = Judul
    // Row 3  = Nama OPD
    // Row 5-8 = Header kolom
    // Row 9  = Nomor kolom
    // Row 10+ = Data
    const DATA_START_ROW = 10;

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
        $this->setColumnWidths($sheet);
        $this->writeHeader($sheet);
        $this->writeData($sheet);
    }

    // ================================================================
    // COLUMN WIDTHS (matching original template)
    // ================================================================

    private function setColumnWidths(Worksheet $sheet): void
    {
        $widths = [
            'A' => 9.18,
            'B' => 15.27,
            'C' => 61.18,
            'D' => 15.27,
            'E' => 13,
            'F' => 13,
            'G' => 13,
            'H' => 13,
            'I' => 13,
            'J' => 13,
            'K' => 13,
            'L' => 13,
            'M' => 13,
            'N' => 13,
            'O' => 13,
            'P' => 13,
            'Q' => 13,
            'R' => 13,
            'S' => 13,
            'T' => 13,
            'U' => 13,
            'V' => 13,
            'W' => 13,
            'X' => 21.27,
            'Y' => 18.82,
            'Z' => 13,
            'AA' => 15.27,
            'AB' => 19.73,
        ];
        foreach ($widths as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }
    }

    // ================================================================
    // HEADER (Rows 1–9)
    // ================================================================

    private function writeHeader(Worksheet $sheet): void
    {
        $tnr  = 'Times New Roman';
        $thin = Border::BORDER_THIN;

        // ── Row 1: Judul ──────────────────────────────────────────────
        $sheet->mergeCells('A1:AB1');
        $sheet->setCellValue('A1', 'Rekap Perjadin Dalam dan Luar Kota Tahun Anggaran 2025');
        $sheet->getStyle('A1')->applyFromArray([
            'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_TOP],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(14);

        // ── Row 3: Nama OPD ───────────────────────────────────────────
        $sheet->setCellValue('B3', 'Nama OPD :');
        $sheet->setCellValue('C3', 'SMKN 1 TALAGA');
        $sheet->getStyle('B3:C3')->applyFromArray([
            'font' => ['name' => $tnr, 'size' => 11],
        ]);
        $sheet->getRowDimension(3)->setRowHeight(40.5);

        // ── Row 5–8: Column Headers ───────────────────────────────────

        // Kolom A–L: merge 5-8 masing-masing
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
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true],
                'borders'   => ['allBorders' => ['borderStyle' => $thin]],
            ]);
        }

        // M5:AB5 – "Rincian Biaya"
        $sheet->mergeCells('M5:AB5');
        $sheet->setCellValue('M5', 'Rincian Biaya');
        $sheet->getStyle('M5')->applyFromArray([
            'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_TOP],
            'borders'   => ['allBorders' => ['borderStyle' => $thin]],
        ]);

        // Row 6: Sub-group headers
        $yellow = ['type' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFFF00']];
        $blue   = ['type' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF9DC3E6']]; // theme 4 tint 0.6 ≈
        $green  = ['type' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFA9D18E']]; // theme 9 tint 0.6 ≈

        $subGroups = [
            ['M6:O6', 'M6', 'Uang Harian', $yellow],
            ['P6:S6', 'P6', 'Penginapan',  $blue],
            ['T6:Z6', 'T6', 'Transport',   $green],
        ];
        foreach ($subGroups as [$merge, $cell, $label, $fill]) {
            $sheet->mergeCells($merge);
            $sheet->setCellValue($cell, $label);
            $sheet->getStyle($cell)->applyFromArray([
                'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
                'fill'      => $fill,
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_TOP],
                'borders'   => ['allBorders' => ['borderStyle' => $thin]],
            ]);
        }

        // AA6:AA8 – Uang Representatif
        $sheet->mergeCells('AA6:AA8');
        $sheet->setCellValue('AA6', 'Uang Representatif (jika ada)');
        $sheet->getStyle('AA6')->applyFromArray([
            'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true],
            'borders'   => ['allBorders' => ['borderStyle' => $thin]],
        ]);

        // AB6:AB8 – Jumlah Total
        $sheet->mergeCells('AB6:AB8');
        $sheet->setCellValue('AB6', "Jumlah Total\n(Rp)");
        $sheet->getStyle('AB6')->applyFromArray([
            'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true],
            'borders'   => ['allBorders' => ['borderStyle' => $thin]],
        ]);

        // Row 7–8: Detail sub-headers
        $detailCols = [
            ['M', 'M7:M8', 'Perhari',                              $yellow],
            ['N', 'N7:N8', 'Jumlah hari',                          $yellow],
            ['O', 'O7:O8', "Total\n(Rp)",                          $yellow],
            ['P', 'P7:P8', 'Nama Hotel',                           $blue],
            ['Q', 'Q7:Q8', 'Harga Kamar/per malam',               $blue],
            ['R', 'R7:R8', 'Lama Menginap (malam)',               $blue],
            ['S', 'S7:S8', "Total\n(Rp)",                          $blue],
            ['T', 'T7:T8', 'BBM',                                  $green],
            ['U', 'U7:U8', 'Tol',                                  $green],
            ['V', 'V7:V8', 'Biaya Pesawat/Kereta/Travel/Taxi',    $green],
            ['W', 'W7:W8', "Total\n(Rp)",                          $green],
            ['X', 'X7:X8', 'Nama Maskapai (jika menggunakan pesawat)', $green],
            ['Y', 'Y7:Y8', 'Kode booking pesawat',                $green],
            ['Z', 'Z7:Z8', 'No Tiket Pesawat',                    $green],
        ];
        foreach ($detailCols as [$col, $merge, $label, $fill]) {
            $sheet->mergeCells($merge);
            $sheet->setCellValue("{$col}7", $label);
            $sheet->getStyle("{$col}7")->applyFromArray([
                'font'      => ['name' => $tnr, 'bold' => true, 'size' => 11],
                'fill'      => $fill,
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true],
                'borders'   => ['allBorders' => ['borderStyle' => $thin]],
            ]);
        }

        $sheet->getRowDimension(5)->setRowHeight(14.15);
        $sheet->getRowDimension(6)->setRowHeight(14.65);
        $sheet->getRowDimension(7)->setRowHeight(14.65);
        $sheet->getRowDimension(8)->setRowHeight(37.15);

        // ── Row 9: Nomor Kolom ────────────────────────────────────────
        $colNums = [
            'A' => 1,
            'B' => 2,
            'C' => 3,
            'D' => 4,
            'E' => 5,
            'F' => 6,
            'G' => 7,
            'H' => 8,
            'I' => 9,
            'J' => 10,
            'K' => 11,
            'L' => 12,
            'M' => 13,
            'N' => 14,
            'O' => '15 = (13 * 14)',
            'P' => 16,
            'Q' => 17,
            'R' => 18,
            'S' => '19 = (17 * 18)',
            'T' => 20,
            'U' => 21,
            'V' => 22,
            'W' => '23 = (20 + 21 + 22)',
            'X' => 24,
            'Y' => 25,
            'Z' => 26,
            'AA' => 27,
            'AB' => '28 = 15 + 19 +23 +27',
        ];
        foreach ($colNums as $col => $num) {
            $sheet->setCellValue("{$col}9", $num);
            $sheet->getStyle("{$col}9")->applyFromArray([
                'font'      => ['name' => $tnr, 'bold' => true, 'size' => 9],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_TOP],
                'borders'   => ['allBorders' => ['borderStyle' => $thin]],
            ]);
        }
        $sheet->getRowDimension(9)->setRowHeight(12);

        // Page setup
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
    }

    // ================================================================
    // DATA ROWS (Row 10+)
    // ================================================================

    private function writeData(Worksheet $sheet): void
    {
        $tnr  = 'Times New Roman';
        $thin = Border::BORDER_THIN;

        // Format currency seperti template asli
        $fmtCurrency  = '_-* #,##0.00_-;\-* #,##0.00_-;_-* "-"??_-;_-@_-';
        $fmtCurrency2 = '_-* #,##0.00_-;\-* #,##0.00_-;_-* "-"_-;_-@_-';

        // Warna kolom sesuai gambar
        $fillYellow  = ['type' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFFF00']]; // Uang Harian M,N
        $fillOrange  = ['type' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFC000']]; // Total Uang Harian O & Jumlah Total AB
        $fillBlue    = ['type' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF9DC3E6']]; // Penginapan P,Q,R
        $fillBlueDark = ['type' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF2E75B6']]; // Total Penginapan S
        $fillGreen   = ['type' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFA9D18E']]; // Transport T,U,V,X,Y,Z
        $fillGreenDark = ['type' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF70AD47']]; // Total Transport W

        // Map warna per kolom di baris data
        $colFills = [
            'M'  => $fillYellow,
            'N'  => $fillYellow,
            'O'  => $fillOrange,
            'P'  => $fillBlue,
            'Q'  => $fillBlue,
            'R'  => $fillBlue,
            'S'  => $fillBlueDark,
            'T'  => $fillGreen,
            'U'  => $fillGreen,
            'V'  => $fillGreen,
            'W'  => $fillGreenDark,
            'X'  => $fillGreen,
            'Y'  => $fillGreen,
            'Z'  => $fillGreen,
            'AB' => $fillOrange,
        ];

        $rowIndex = 1;

        foreach ($this->travelOrders as $order) {
            $employees = $order->employees;

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

            foreach ($employeeList as $participan) {
                $employee = $participan?->employee;

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

                // ── Isi sel ──────────────────────────────────────────
                $sheet->setCellValue("A{$r}", $rowIndex);
                $sheet->setCellValue("B{$r}", null);
                $sheet->setCellValue("C{$r}", $order->purpose);
                $sheet->setCellValue("D{$r}", $order->letter_number);
                $sheet->setCellValue("E{$r}", $employee?->full_name ?? '');
                $sheet->setCellValue("F{$r}", $employee?->nip ?? '');
                $sheet->setCellValue("G{$r}", $employee?->golongan ?? '');
                $sheet->setCellValue("H{$r}", $order->departure_to);
                $sheet->setCellValue("I{$r}", $order->departure_place);
                $sheet->setCellValue("J{$r}", $order->duration_days);
                $sheet->setCellValue("K{$r}", $order->departure_date
                    ? Carbon::parse($order->departure_date)->translatedFormat('d F Y') : '');
                $sheet->setCellValue("L{$r}", $order->return_date
                    ? Carbon::parse($order->return_date)->translatedFormat('d F Y') : '');

                $sheet->setCellValue("M{$r}", $dailyRow?->amount_per_day ?: null);
                $sheet->setCellValue("N{$r}", $dailyRow?->days ?: null);
                $sheet->setCellValue("O{$r}", "=M{$r}*N{$r}");

                $sheet->setCellValue("P{$r}", $accomFirst?->hotel_name);
                $sheet->setCellValue("Q{$r}", $accomFirst?->price_per_night ?: null);
                $sheet->setCellValue("R{$r}", $accomFirst?->duration_nights ?: null);
                $sheet->setCellValue("S{$r}", "=Q{$r}*R{$r}");

                $sheet->setCellValue("T{$r}", $bbm);
                $sheet->setCellValue("U{$r}", $toll);
                $sheet->setCellValue("V{$r}", $planeCost);
                $sheet->setCellValue("W{$r}", "=SUM(T{$r}:V{$r})");

                $sheet->setCellValue("X{$r}", $airlineName);
                $sheet->setCellValue("Y{$r}", $bookingCode);
                $sheet->setCellValue("Z{$r}", $ticketNumber);
                $sheet->setCellValue("AA{$r}", $representative);
                $sheet->setCellValue("AB{$r}", "=O{$r}+S{$r}+W{$r}+AA{$r}");

                // ── Base styling semua kolom ──────────────────────────
                $allCols = array_merge(range('A', 'Z'), ['AA', 'AB']);
                foreach ($allCols as $col) {
                    $sheet->getStyle("{$col}{$r}")->applyFromArray([
                        'font'    => ['name' => $tnr, 'size' => 11],
                        'borders' => ['allBorders' => ['borderStyle' => $thin]],
                    ]);
                }

                // ── Warna per kolom ───────────────────────────────────
                foreach ($colFills as $col => $fill) {
                    $sheet->getStyle("{$col}{$r}")->applyFromArray(['fill' => $fill]);
                }

                // Warna font putih untuk kolom Total yang gelap (S dan W)
                foreach (['S', 'W'] as $col) {
                    $sheet->getStyle("{$col}{$r}")->getFont()
                        ->setColor(new Color('FFFFFFFF'));
                }

                // ── Alignment ────────────────────────────────────────
                $sheet->getStyle("A{$r}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("C{$r}")->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

                // ── Number format ─────────────────────────────────────
                foreach (['M', 'AB'] as $col) {
                    $sheet->getStyle("{$col}{$r}")
                        ->getNumberFormat()->setFormatCode($fmtCurrency);
                }
                foreach (['O', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'AA'] as $col) {
                    $sheet->getStyle("{$col}{$r}")
                        ->getNumberFormat()->setFormatCode($fmtCurrency2);
                }

                $sheet->getRowDimension($r)->setRowHeight(28);

                $rowIndex++;
            }
        }
    }
}
