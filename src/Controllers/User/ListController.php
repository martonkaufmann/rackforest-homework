<?php

declare(strict_types=1);

namespace Rackforest\Controllers\User;

use Rackforest\Repositories\UserRepository;
use Smarty\Smarty;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class ListController
{
    public function __construct(
        private readonly UserRepository $userRepository = new UserRepository(),
    ) {}

    public function __invoke(Request $request): Response
    {
        /** @var Smarty $template */
        $template = $request->attributes->get('template');
        /** @var Session */
        $session = $request->getSession();

        if (!$session->has('user')) {
            return new RedirectResponse('/auth/login');
        }

        $template->assign(
            'users',
            $this->userRepository->getAll(),
        );

        return new Response(
            $template->display('users/list.tpl'),
        );
    }
}
