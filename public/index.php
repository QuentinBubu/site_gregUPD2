<?php

session_start();

require '../vendor/autoload.php';

$router = new AltoRouter();

$router->map('GET', '/', 'accueil');
$router->map('GET', '/espace-admin', 'admin');
$router->map('POST', '/espace-admin', 'admin');
$router->map('GET', '/logout', 'logout');
$router->map('POST', '/password-forget', 'password-forget');

$results = $router->match();
if ($results != null) {
    if (is_callable($results['target'])){
        call_user_func_array($results['target'], $results['params']);
    } else {
        require 'header.html';
        require "./{$results['target']}.php";
    }
} else {
    require './assets/errorPage/404.html';
}