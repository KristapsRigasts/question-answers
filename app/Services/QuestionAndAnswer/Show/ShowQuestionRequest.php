<?php

namespace App\Services\QuestionAndAnswer\Show;

class ShowQuestionRequest
{
    private int $categoryId;
    private int $questionId;

    public function __construct(int $categoryId, int $questionId)
    {
        $this->categoryId = $categoryId;
        $this->questionId = $questionId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }
}