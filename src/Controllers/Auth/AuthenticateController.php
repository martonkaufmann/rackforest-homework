<?php

declare(strict_types=1);

namespace Rackforest\Controllers\Auth;

use Rackforest\Repositories\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthenticateController
{
    public function __construct(
        private readonly UserRepository $userRepository = new UserRepository(),
    ) {}

    public function __invoke(Request $request): Response
    {
        $response = new RedirectResponse('/auth/login');
        /** @var Session */
        $session = $request->getSession();
        $user = $this->userRepository->getByUsernamePassword(
            $request->request->get('username'),
            $request->request->get('password'),
        );

        if ($user !== null) {
            $session->set('user', 1);

            return $response->setTargetUrl('/users/list');
        }

        $session->getFlashBag()->add('form_error', 'Invalid credentials provided!');

        return     $response;
    }
}
