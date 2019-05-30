<?php

namespace App\Utils;

class Tools
{
    
    /**
     * @return bool
     */
    public static function isValidURL($url) {
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