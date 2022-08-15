<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\UserAnswer;
use App\Models\UserFinalResult;

interface UserRepository
{
    public function addUser(User $user);
    public function addUserAnswer(UserAnswer $userAnswer);
    public function addFinalResult(UserFinalResult $userFinalResult);
    public function getUser(int $userId);

}
