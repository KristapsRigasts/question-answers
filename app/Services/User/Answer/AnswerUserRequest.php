<?php

namespace App\Services\User\Answer;

class AnswerUserRequest
{
    private int $userId;
    private int $categoryId;
    private int $questionId;
    private int $answerId;
    private int $answeredStatus;

    public function __construct(int $userId, int $categoryId, int $questionId, int $answerId, int $answeredStatus)
    {
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->questionId = $questionId;
        $this->answerId = $answerId;
        $this->answeredStatus = $answeredStatus;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function getAnswerId(): int
    {
        return $this->answerId;
    }

    public function getAnsweredStatus(): int
    {
        return $this->answeredStatus;
    }
}