<?php

namespace App\Services\User\Answer;

use App\Models\UserAnswer;
use App\Repositories\User\UserRepository;

class AnswerUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(AnswerUserRequest $request): void
    {
        $this->userRepository->addUserAnswer(new UserAnswer(
            $request->getUserId(),
            $request->getCategoryId(),
            $request->getQuestionId(),
            $request->getAnswerId(),
            $request->getAnsweredStatus()
        ));
    }
}