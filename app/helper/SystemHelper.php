<?php

use Illuminate\Support\Facades\DB;


function isMobile() {
    return preg_match('/(android|iphone|ipad|ipod|webos|blackberry|iemobile|opera mini|windows phone)/i', request()->userAgent());
}

function cevir($s)
{
    $tr = array('ş', 'Ş', 'ı', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'Ç', 'ç');
    $eng = array('s', 's', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c');
    $s = str_replace($tr, $eng, $s);
    $s = strtolower($s);
    $s = preg_replace('/&.+?;/', '', $s);
    $s = preg_replace('/[^%a-z0-9 _-]/', '', $s);
    $s = preg_replace('/\s+/', '-', $s);
    $s = preg_replace('|-+|', '-', $s);
    $s = trim($s, '-');
    return $s;
}


function cevir2($s)
{
    $tr = array('ş', 'Ş', 'ı', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'Ç', 'ç');
    $eng = array('s', 's', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c');
    $s = str_replace($tr, $eng, $s);
    $s = strtolower($s);
    $s = preg_replace('/&.+?;/', '', $s);
    $s = preg_replace('/[^%a-z0-9 _-]/', '', $s);
    $s = preg_replace('/\s+/', '_', $s);
    $s = preg_replace('|-+|', '_', $s);
    $s = trim($s, '_');
    return $s;
}


function statusButtonTable($status)
{
    if ($status == 1) {
        return '<span class="badge text-bg-success">Aktif</span>';
    } else {
        return '<span class="badge  text-bg-danger">Pasif</span>';
    }

}
