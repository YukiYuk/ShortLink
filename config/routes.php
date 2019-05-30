<?php

use App\Services\Config;
use Slim\App;
use Slim\Container;

$debug = Config::get('debug');

$container = new Container(array(
    'settings' => array(
        'debug' => $debug,
        'displayErrorDetails' => $debug
    )
));

$app = new App($container);

$app->redirect('/', '/create.html', 302);

$app->group('/api', function () {
    $this->post('/create', 'App\Controllers\ApiController:create');
});

$app->get('/{token}', 'App\Controllers\JumpController:redirect');

$app->run();
