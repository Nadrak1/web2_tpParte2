<?php
require_once 'libs/Router.php';  //CHEQUEAR SI FUNCA
require_once "Controller/gameApiController.php";
require_once "Controller/categoryApiController.php";

// crea el router
$router = new Router();

// define la tabla de ruteo
//                      ---GAMES---
$router->addRoute('videogame', 'GET', 'gameApiController', 'showAllGames');
$router->addRoute('videogame/:ID', 'GET', 'gameApiController', 'getGame');
$router->addRoute('videogame/:ID', 'DELETE', 'gameApiController', 'deleteGame');
$router->addRoute('videogame', 'POST', 'gameApiController', 'createGame');
$router->addRoute('videogame/:ID', 'PUT', 'gameApiController', 'editGame');


// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
