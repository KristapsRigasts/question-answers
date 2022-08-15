<?php

namespace App\Services\User\FinalResult;

use App\Models\UserFinalResult;
use App\Repositories\User\UserRepository;

class FinalResultService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(FinalResultRequest $request): void
    {
        $this->userRepository->addFinalResult(new UserFinalResult(
            $request->getUserId(),
            $request->getCategoryId(),
            $request->getCorrectAnswerAmount()
        ));
    }
}