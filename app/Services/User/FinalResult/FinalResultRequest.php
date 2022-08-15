<?php

namespace App\Services\User\FinalResult;

class FinalResultRequest
{
    private int $userId;
    private int $categoryId;
    private int $correctAnswerAmount;

    public function __construct(int $userId, int $categoryId, int $correctAnswerAmount)
    {
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->correctAnswerAmount = $correctAnswerAmount;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getCorrectAnswerAmount(): int
    {
        return $this->correctAnswerAmount;
    }
}