<?php

namespace App\Utils;

use App\Services\Config;

class Tools
{
    
    /**
     * @return bool
     */
    public static function isValidURL($url) {
        if (parse_url($url, PHP_URL_HOST) == Config::get('host')) return false;
        if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
            $proto = explode('://', $url)[0];
            if (
                $proto == 'http' ||
                $proto == 'https' ||
                $proto == 'steam'
            ) return true;
        }
        return false;
    }

}