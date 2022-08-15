<?php

namespace App\Repositories\User;

use App\Connection;
use App\Models\User;
use App\Models\UserAnswer;
use App\Models\UserFinalResult;

class PDOUserRepository implements UserRepository
{

    public function addUser(User $user): int
    {
        Connection::connection()
            ->insert('users',[
                'user_name' => $user->getName(),
                'category_id' => $user->getCategoryId()
            ]);

        return intval(Connection::connection()->lastInsertId());
    }

    public function addUserAnswer(UserAnswer $userAnswer): void
    {
        Connection::connection()
            ->insert('user_answers', [
                'user_id' => $userAnswer->getUserId(),
                'category_id' => $userAnswer->getCategoryId(),
                'question_id' => $userAnswer->getQuestionId(),
                'answer_id' => $userAnswer->getAnswerId(),
                'answered_status' => $userAnswer->getAnsweredStatus()
            ]);
    }

    public function addFinalResult(UserFinalResult $userFinalResult): void
    {
        Connection::connection()
            ->insert('user_final_results', [
                'user_id' => $userFinalResult->getUserId(),
                'category_id' => $userFinalResult->getCategoryId(),
                'correct_answer_amount' => $userFinalResult->getCorrectAnswerAmount()
            ]);
    }

    public function getUser(int $userId): User
    {
        $userQuery = Connection::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->where('id = ?')
            ->setParameter(0, $userId)
            ->fetchAssociative();

        return new User($userQuery['user_name'], $userQuery['category_id']);
    }
}