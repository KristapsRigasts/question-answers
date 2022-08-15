<?php

namespace App\Services\QuestionAndAnswer\Show;

class ShowAnswerRequest
{
    private int $questionId;

    public function __construct(int $questionId)
    {
        $this->questionId = $questionId;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }
}