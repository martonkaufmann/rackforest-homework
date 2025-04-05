<?php

declare(strict_types=1);

namespace Rackforest\Controllers\User;

use Rackforest\Repositories\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class DeleteController
{
    public function __construct(
        private readonly UserRepository $userRepository = new UserRepository,
    ) {}

    public function __invoke(Request $request): Response
    {
        $response = new RedirectResponse('/auth/login');
        /** @var Session */
        $session = $request->getSession();

        if (!$session->has('user')) {
            return $response;
        }

        $this->userRepository->delete(
            (int)$request->request->get('user')
        );

        return $response->setTargetUrl('/users/list');
    }
}
