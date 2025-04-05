<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Smarty\Smarty;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing;

$smarty = new Smarty();

$smarty->setTemplateDir(__DIR__.'/../templates/');
$smarty->setCompileDir(__DIR__.'/../storage/templates/compiled/');
$smarty->setConfigDir(__DIR__.'/../storage/templates/configs/');
$smarty->setCacheDir(__DIR__.'/../storage/templates/cache');

$request = Request::createFromGlobals();
            $session = new Session();
            $session->start();
            $request->setSession($session);

$routes = include __DIR__.'/../routes/routes.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $request->attributes->set('template', $smarty);

    $response = call_user_func($request->attributes->get('_controller'), $request);
} catch (Routing\Exception\ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
} catch (Throwable $exception) {
    // In development mode expose the exception, otherwise don't show it to the user
    // TODO: Comment
//    if (getenv('APP_ENV') === 'development') {
        throw $exception;
//    }
        
    $response = new Response('An error occurred', 500);
}

$response->send();
