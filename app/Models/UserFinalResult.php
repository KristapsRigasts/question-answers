<?php

namespace App\Models;

class UserFinalResult
{
    private int $userId;
    private int $categoryId;
    private int $correctAnswerAmount;
    private ?int $id;

    public function __construct(int $userId, int $categoryId, int $correctAnswerAmount, ?int $id = null)
    {
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->correctAnswerAmount = $correctAnswerAmount;
        $this->id = $id;
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

    public function getId(): ?int
    {
        return $this->id;
    }
}