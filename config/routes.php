<?php

use App\Router\Route;
use App\Router\Router;
use App\Controller\HomeController;
use App\Controller\MediaController;
use App\Controller\UserController;

// Création de l'instance du Router
$router = new Router();

// Liste des routes
$router->addRoute(new Route('/', HomeController::class, 'index'));
$router->addRoute(new Route('/changeAvailable', HomeController::class, 'changeAvailable'));

$router->addRoute(new Route('/login', UserController::class, 'login'));
$router->addRoute(new Route('/register', UserController::class, 'register'));
$router->addRoute(new Route('/logout', UserController::class, 'logout'));

// Retourne le router configuré
return $router;
