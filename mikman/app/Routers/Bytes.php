<?php

namespace App\Routers;

class Bytes
{
    public static function formatUptime($uptime)
    {
        // Pisahkan jam, menit, dan detik
        list($hours, $minutes, $seconds) = explode(":", $uptime);

        // Format ulang waktu dengan menambahkan 0 di depan jika perlu
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }

    public static function bytes($size, $decimals = 0)
    {
        $unit = array(
            '0' => 'Byte',
            '1' => 'KB',
            '2' => 'MB',
            '3' => 'GB',
            '4' => 'TB',
            '5' => 'PB',
            '6' => 'EB',
            '7' => 'ZB',
            '8' => 'YB'
        );
    
        $i = 0;
        while ($size >= 1000 && $i < count($unit) - 1) {
            $size = $size / 1000;
            $i++;
        }
    
        $result = round($size, $decimals) . ' ' . $unit[$i];
      
        return $result;
    }
    
    public static function bytes2($size, $decimals = 0)
    {
        $unit = array(
            '0' => 'Byte',
            '1' => 'KiB',
            '2' => 'MiB',
            '3' => 'GiB',
            '4' => 'TiB',
            '5' => 'PiB',
            '6' => 'EiB',
            '7' => 'ZiB',
            '8' => 'YiB'
        );
    
        $i = 0;
        while ($size >= 1024 && $i < count($unit) - 1) {
            $size = $size / 1024;
            $i++;
        }
    
        return round($size, $decimals) . ' ' . $unit[$i];
    }
        
    public static function bytes3($bytes, $decimal = 2)
    {
        $i = 0;
        while ($bytes > 1024) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, $decimal);
    }
    

   
}
