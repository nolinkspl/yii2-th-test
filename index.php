<?php

use Pimple\Container;

initConfigs();
initContainers();
initRouting();


function initContainers() {
    $container = new Container();

    $container['repository'] = function ($c) {
        return new Service\Repository();
    };

    $container['auth_service'] = function ($c) {
        return new Service\AuthorizationService(
            $c['repository']
        );
    };

    $container['account_service'] = function ($c) {
        return new Service\AccountService(
            $c['repository']
        );
    };

    $container['auth_controller'] = function ($c) {
        return new Controller\Auth(
            $c['auth_service'],
            $c['account_service']
        );
    };
}

function initConfigs() {
    require 'src/config.php';

    if ($GLOBALS['config']['is_debug_mode']) {
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
    }
}

function initRouting() {
    require 'vendor/altorouter/altorouter/AltoRouter.php';

    $router = new AltoRouter();
    $router->setBasePath('');
    $router->map('GET', '/',     'www/index.php',           'home');
    $router->map('POST','/auth', ['controller' => '/src/Controller/Auth.php', 'action' => 'authorization'], 'auth');

    $match = $router->match();

    if ($match === false) {
        echo "// here you can handle 404 \n";
    } else {
        if (is_array($match['target'])) {
            $controller = new $match['target']['controller']();
            $actionName = $match['target']['action'];
            $params = $match['params'];
            /** @TODO something */
        } else {
            require $match['target'];
        }
    }
}