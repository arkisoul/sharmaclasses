<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('utf16_to_utf8')) {
    function utf16_to_utf8($str)
    {
        $c0 = ord($str[0]);
        $c1 = ord($str[1]);

        if ($c0 == 0xFE && $c1 == 0xFF) {
            $be = true;
        } else if ($c0 == 0xFF && $c1 == 0xFE) {
            $be = false;
        } else {
            return $str;
        }

        $str = substr($str, 2);
        $len = strlen($str);
        $dec = '';
        for ($i = 0; $i < $len; $i += 2) {
            $c = ($be) ? ord($str[$i]) << 8 | ord($str[$i + 1]) :
            ord($str[$i + 1]) << 8 | ord($str[$i]);
            if ($c >= 0x0001 && $c <= 0x007F) {
                $dec .= chr($c);
            } else if ($c > 0x07FF) {
                $dec .= chr(0xE0 | (($c >> 12) & 0x0F));
                $dec .= chr(0x80 | (($c >> 6) & 0x3F));
                $dec .= chr(0x80 | (($c >> 0) & 0x3F));
            } else {
                $dec .= chr(0xC0 | (($c >> 6) & 0x1F));
                $dec .= chr(0x80 | (($c >> 0) & 0x3F));
            }
        }
        return $dec;
    }
}

if (!function_exists('convert_file_to_utf8')) {
    function convert_file_to_utf8($csvfile)
    {
        $utfcheck = file_get_contents($csvfile);
        $utfcheck = utf16_to_utf8($utfcheck);
        file_put_contents($csvfile, $utfcheck);
    }

}
