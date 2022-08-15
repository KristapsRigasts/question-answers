<?php

namespace App\Models;

class UserAnswer
{
    private int $userId;
    private int $categoryId;
    private int $questionId;
    private int $answerId;
    private int $answeredStatus;
    private ?int $id;

    public function __construct(int $userId, int $categoryId, int $questionId, int $answerId, int $answeredStatus, ?int $id = null)
    {
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->questionId = $questionId;
        $this->answerId = $answerId;
        $this->answeredStatus = $answeredStatus;
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

    public function getId(): ?int
    {
        return $this->id;
    }
}