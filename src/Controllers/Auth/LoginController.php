<?php

declare(strict_types=1);

namespace Rackforest\Controllers\Auth;

use Smarty\Smarty;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController
{
    public function __invoke(Request $request): Response
    {
        /** @var Smarty $template */
        $template = $request->attributes->get('template');
        /** @var Session */
        $session = $request->getSession();

        if ($session->getFlashBag()->has('form_error')) {
            $error = $session->getFlashBag()->get('form_error')[0];

            $template->assign('error', $error);
        }

        return new Response(
            $template->display('auth/login.tpl')
        );
    }
}
