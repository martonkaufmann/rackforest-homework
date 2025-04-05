<?php

declare(strict_types=1);

use Rackforest\Controllers\User\ListController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;

$userRoutes = new Routing\RouteCollection();

$userRoutes->add('list', new Routing\Route('/list', ['_controller' => new ListController], methods: [Request::METHOD_GET]));

$userRoutes->addNamePrefix('users');
$userRoutes->addPrefix('users');

return $userRoutes;
