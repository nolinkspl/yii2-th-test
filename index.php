<?php

require 'vendor/altorouter/AltoRouter.php';

$router = new AltoRouter();

$router->map('GET', '/',     'www/index.php',           'home');
$router->map('POST','/auth', 'src/Controller/Auth.php', 'auth');

$match = $router->match();

if($match) {
    require $match['target'];
} else {
    header("HTTP/1.0 404 Not Found");
}