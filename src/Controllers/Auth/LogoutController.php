<?php

declare(strict_types=1);

namespace Rackforest\Controllers\Auth;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class LogoutController
{
    public function __construct(
    ) {}

    public function __invoke(Request $request): Response
    {
        /** @var Session */
        $session = $request->getSession();
        $session->invalidate();

        return     new RedirectResponse('/auth/login');
    }
}
