<?php

namespace App\Api\Action\User;

use App\Entity\User;
use App\Service\User\UserCreateService;
use Symfony\Component\HttpFoundation\Request;

class Create
{

    private UserCreateService $userCreateService;

    public function __construct(UserCreateService $userCreateService)
    {
        $this->userCreateService = $userCreateService;
    }

    public function __invoke(Request $request): User
    {
        return $this->userCreateService->create($request);
    }
}
