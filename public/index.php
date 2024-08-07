<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
require '../helpers.php';
//require basePath('Framework/Database.php');
//require basePath('Framework/Router.php');
use Framework\Router;

/*
spl_autoload_register(function ($class) {
    $path = basePath('Framework/' . $class . '.php');
    if (file_exists($path)) {
        require $path;
    }
});
*/

//Instatiating the router
$router = new Router();

//Get route
$routes = require basePath('routes.php');

//Get current uri & http method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //parse kt3wna lakan url localhost/listing?id=22 ktkhdm 3kss qbl ila kan nfs url mki3rfoch router ki3rf 7ed /listing

//route the request
$router->route($uri);
