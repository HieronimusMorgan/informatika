<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('format_indo')) {

    function format_indo($date) {
        // array hari dan bulan
        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $result = $tgl . " " . $Bulan[(int) $bulan - 1] . " " . $tahun;

        return $result;
    }

    function format_back($date) {

        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $bulan = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
        $tgl = substr($date, 0, 2);
        $bln = substr($date, 3);
        $tahun = "";
        if (substr($date, 3, 7) == $Bulan[0]) {
            $bln = $bulan[0];
            $tahun = substr($date, 11, 4);
        } elseif ((substr($date, 3, 8) == $Bulan[1])) {
            $bln = $bulan[1];
            $tahun = substr($date, 12, 4);
        } elseif ((substr($date, 3, 5) == $Bulan[2])) {
            $bln = $bulan[2];
            $tahun = substr($date, 9, 4);
        } elseif ((substr($date, 3, 5) == $Bulan[3])) {
            $bln = $bulan[3];
            $tahun = substr($date, 9, 4);
        } elseif ((substr($date, 3, 3) == $Bulan[4])) {
            $bln = $bulan[4];
            $tahun = substr($date, 7, 4);
        } elseif ((substr($date, 3, 4) == $Bulan[5])) {
            $bln = $bulan[5];
            $tahun = substr($date, 8, 4);
        } elseif ((substr($date, 3, 4) == $Bulan[6])) {
            $bln = $bulan[6];
            $tahun = substr($date, 8, 4);
        } elseif ((substr($date, 3, 7) == $Bulan[7])) {
            $bln = $bulan[7];
            $tahun = substr($date, 11, 4);
        } elseif ((substr($date, 3, 9) == $Bulan[8])) {
            $bln = $bulan[8];
            $tahun = substr($date, 13, 4);
        } elseif ((substr($date, 3, 7) == $Bulan[9])) {
            $bln = $bulan[9];
            $tahun = substr($date, 11, 4);
        } elseif ((substr($date, 3, 8) == $Bulan[10])) {
            $bln = $bulan[10];
            $tahun = substr($date, 12, 4);
        } elseif ((substr($date, 3, 8) == $Bulan[11])) {
            $bln = $bulan[11];
            $tahun = substr($date, 12, 4);
        }
        $result = $tahun . "-" . $bln . "-" . $tgl;
        return $result;
    }

    function format_normal($date) {
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);

        $result = $bulan . "/" . $tgl . "/" . $tahun;
        return $result;
    }

}