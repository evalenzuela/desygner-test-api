<?php

namespace App\Service\User;

use App\Entity\User;
use App\Exception\User\UserAlreadyExistsException;
use App\Repository\UserRepository;
use App\Service\Password\HasherService;
use App\Service\Request\RequestService;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class UserCreateService
{

    private UserRepository $userRepository;
    private HasherService $hasherService;

    public function __construct(UserRepository $userRepository, HasherService $hasherService)
    {
        $this->userRepository = $userRepository;
        $this->hasherService = $hasherService;
    }

    public function create(Request $request): User
    {
        $firstName = RequestService::getField($request, 'firstName', true);
        $lastName = RequestService::getField($request, 'lastName', true);
        $email = RequestService::getField($request, 'email', true);
        $password = RequestService::getField($request, 'password', true);

        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);

        $user->setPassword($this->hasherService->generateHashedPassword($user, $password));

        try {
            $this->userRepository->add($user);
        } catch (ORMException $e) {
            throw UserAlreadyExistsException::fromEmail($email);
        }

        return $user;
    }
}
