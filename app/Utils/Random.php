<?php

namespace App\Utils;

class Random
{
    
    public static function hex($len = 16) {
        $binlen = ceil($len/2);
        $r = bin2hex(openssl_random_pseudo_bytes($binlen));
        return substr($r, 0, $len);
    }

    public static function str($len = 16) {
        $list = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i = 0; $i < $len; $i++) {
            $str .= $list[mt_rand(0, strlen($list) - 1)];
        }
        return $str;
    }

}