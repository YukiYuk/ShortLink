<?php

namespace App\Services;

class Config
{

    public function __construct() {
        $config = self::read();
        foreach ($config as $k => $v) {
            $this->$k = $v;
        }
    }

    protected static function read() {
        require BASE_PATH.'/config/config.php';
        return $SystemConfig;
    }

    /**
     * @param $key 留空则返回数组
     * @return mixed
     */
    public static function get($key = null) {
        $config = self::read();
        if ($key == null) {
            return $config;
        } else {
            if (isset($config[$key])) {
                return $config[$key];
            } else {
                return null;
            }
        }
    }

    public static function getSsMuConfig() {
        $config = self::read();
        foreach ($config['mu'] as $mu) {
            if ($mu['type'] == 1) return $mu;
        }
        return [];
    }

    public static function getSsrMuConfig() {
        $config = self::read();
        foreach ($config['mu'] as $mu) {
            if ($mu['type'] == 2) return $mu;
        }
        return [];
    }

    /**
     * @return array
     */
    public static function getDbInfo() {
        $config = self::read();
        return array(
            'driver'     => 'mysql',
            'host'       => $config['database']['host'],
            'database'   => $config['database']['name'],
            'username'   => $config['database']['user'],
            'password'   => $config['database']['pass'],
            'charset'    => 'utf8',
            'collation'  => 'utf8_general_ci',
            'prefix'     => ''
        );
    }

}
