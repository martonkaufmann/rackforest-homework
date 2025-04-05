<?php

declare(strict_types=1);

use Rackforest\Controllers\User\DeleteController;
use Rackforest\Controllers\User\ListController;
use Rackforest\Controllers\User\ViewController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;

$userRoutes = new Routing\RouteCollection();

$userRoutes->add('list', new Routing\Route('/list', ['_controller' => new ListController()], methods: [Request::METHOD_GET]));
$userRoutes->add('delete', new Routing\Route('/delete', ['_controller' => new DeleteController()], methods: [Request::METHOD_POST]));
$userRoutes->add('view', new Routing\Route('/view/{user}', ['_controller' => new ViewController()], methods: [Request::METHOD_GET], requirements: ['user' => '\d+']));

$userRoutes->addNamePrefix('users');
$userRoutes->addPrefix('users');

return $userRoutes;
