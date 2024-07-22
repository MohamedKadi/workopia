<?php
require '../helpers.php';
require basePath('Database.php');
require basePath('Router.php');



//Instatiating the router
$router = new Router();

//Get route
$routes = require basePath('routes.php');

//Get current uri & http method
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

//route the request
$router->route($uri, $method);
