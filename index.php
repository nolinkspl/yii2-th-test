<?php

require 'vendor/altorouter/AltoRouter.php';
require 'src/config.php';

if ($GLOBALS['config']['is_debug_mode']) {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

$router = new AltoRouter();
$router->setBasePath('');
$router->map('GET', '/',     'www/index.php',           'home');
$router->map('POST','/auth', ['controller' => '/src/Controller/Auth.php', 'action' => 'test'], 'auth');

$match = $router->match();

if ($match === false) {
    echo "// here you can handle 404 \n";
} else {
    if (is_array($match['target'])) {
        $controller = new $match['target']['controller']();
        $actionName = $match['target']['action'];
        $params = $match['params'];
    } else {
        require $match['target'];
    }

}