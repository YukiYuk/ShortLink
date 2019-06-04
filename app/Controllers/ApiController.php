<?php

namespace App\Controllers;

use App\Models\Link;
use App\Services\Config;
use App\Utils\Tools;
use App\Utils\Random;

class ApiController
{
    
    public function create($request, $response, $args) {

        $post = $request->getParsedBody();

        $errcode = (isset($_GET['c']) && $_GET['c'] == true) ? true : false ;

        if (!isset($post['target'])) {
            if ($errcode) header('HTTP/1.1 400');
            header('Content-Type: application/json');
            die(json_encode(array(
                'ok' => false,
                'msg' => 'bad request',
                'data' => null
            )));
        }

        $count = Link::where('create_time', '>', (time() - 60))->where('creator_ip', REAL_IP)->count();
        if ($count > Config::get('rate_limit')) {
            if ($errcode) header('HTTP/1.1 429');
            header('Content-Type: application/json');
            header('Retry-After: 60');
            die(json_encode(array(
                'ok' => false,
                'msg' => 'exceed rate limit',
                'data' => null
            )));
        }

        if (!Tools::isValidURL($post['target'])) {
            if ($errcode) header('HTTP/1.1 400');
            header('Content-Type: application/json');
            die(json_encode(array(
                'ok' => false,
                'msg' => 'bad url',
                'data' => null
            )));
        }

        $link = Link::where('target', $post['target'])->first();
        if ($link == null) {
            try {
                $link = new Link;
                $link->token = Random::str(Config::get('token_length'));
                $link->target = $post['target'];
                $link->create_time = time();
                $link->creator_ip = REAL_IP;
                $link->creator_ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
                $link->save();
            } catch (\Exception $e) {
                if ($errcode) header('HTTP/1.1 500');
                header('Content-Type: application/json');
                die(json_encode(array(
                    'ok' => false,
                    'msg' => 'internal error, please try again.',
                    'data' => null
                )));
            }
        }

        header('Content-Type: application/json');
        die(json_encode(array(
            'ok' => true,
            'msg' => '',
            'data' => Config::get('base_url')."/$link->token"
        )));

    }

}