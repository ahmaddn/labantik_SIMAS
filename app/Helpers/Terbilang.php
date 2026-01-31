<?php

namespace App\Helpers;

class Terbilang
{
    public static function convert($angka)
    {
        $angka = abs($angka);
        $huruf = [
            '',
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan',
            'sepuluh',
            'sebelas'
        ];

        $temp = '';

        if ($angka < 12) {
            $temp = ' ' . $huruf[$angka];
        } else if ($angka < 20) {
            $temp = self::convert($angka - 10) . ' belas';
        } else if ($angka < 100) {
            $temp = self::convert($angka / 10) . ' puluh' . self::convert($angka % 10);
        } else if ($angka < 200) {
            $temp = ' seratus' . self::convert($angka - 100);
        } else if ($angka < 1000) {
            $temp = self::convert($angka / 100) . ' ratus' . self::convert($angka % 100);
        } else if ($angka < 2000) {
            $temp = ' seribu' . self::convert($angka - 1000);
        } else if ($angka < 1000000) {
            $temp = self::convert($angka / 1000) . ' ribu' . self::convert($angka % 1000);
        } else if ($angka < 1000000000) {
            $temp = self::convert($angka / 1000000) . ' juta' . self::convert($angka % 1000000);
        }

        return trim($temp);
    }
}
