<?php

namespace App\Services\User\Register;

use App\Models\User;
use App\Repositories\User\UserRepository;


class RegisterUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(RegisterUserRequest $request): int
    {
        return $this->userRepository->addUser(new User(
            $request->getName(),
            $request->getCategoryId()
        ));
    }
}