<?php

namespace App\Services\User\Result;

use App\Models\User;
use App\Repositories\User\UserRepository;

class ResultUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(ResultUserRequest $request): User
    {
        return $this->userRepository->getUser($request->getUserId());
    }
}