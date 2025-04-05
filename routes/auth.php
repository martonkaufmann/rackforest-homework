<?php

declare(strict_types=1);

use Rackforest\Controllers\Auth\AuthenticateController;
use Rackforest\Controllers\Auth\LoginController;
use Rackforest\Controllers\Auth\LogoutController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;

$authRoutes = new Routing\RouteCollection();

$authRoutes->add('login', new Routing\Route('/login', ['_controller' => new LoginController()], methods: [Request::METHOD_GET]));
$authRoutes->add('logout', new Routing\Route('/logout', ['_controller' => new LogoutController()], methods: [Request::METHOD_POST]));
$authRoutes->add('authenticate', new Routing\Route('/authenticate', ['_controller' => new AuthenticateController()], methods: [Request::METHOD_POST]));

$authRoutes->addNamePrefix('auth');
$authRoutes->addPrefix('auth');

return $authRoutes;
