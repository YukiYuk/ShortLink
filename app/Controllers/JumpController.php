<?php

namespace App\Controllers;

use App\Models\Link;
use App\Models\Statistics;

class JumpController
{
    
    public function redirect($request, $response, $args) {

        $link = Link::where('token', $args['token'])->first();
        if ($link == null) {
            header('HTTP/1.1 404');
        } else {
            header('Location: '.$link->target);
            $pid = pcntl_fork();
            if ($pid == -1) {
                die('could not fork');
            } else if ($pid) {
                //pcntl_wait($status);
            } else {
                $stat = new Statistics;
                $stat->link_id = $link->id;
                $stat->target = $link->target;
                $stat->ip = REAL_IP;
                $stat->ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
                $stat->log_time = time();
                $stat->save();
                exit;
            }
        }

    }

}