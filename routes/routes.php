<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('dashboard', new Routing\Route('/', ['_controller' => function (Request $request) {
    /** @var Session */
    $session = $request->getSession();

    if (!$session->has('user')) {
        return new RedirectResponse('/auth/login');
    }

    return new RedirectResponse('/users');
} ]));

$routes->addCollection(include __DIR__ . '/auth.php');
$routes->addCollection(include __DIR__ . '/user.php');

return $routes;
