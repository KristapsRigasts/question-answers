<?php

namespace App\Models;

class Answer
{
    private int $id;
    private int $questionId;
    private string $answerOption;
    private int $answerStatus;

    public function __construct(int $id, int $questionId, string $answerOption, int $answerStatus)
    {
        $this->id = $id;
        $this->questionId = $questionId;
        $this->answerOption = $answerOption;
        $this->answerStatus = $answerStatus;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function getAnswerOption(): string
    {
        return $this->answerOption;
    }

    public function getAnswerStatus(): int
    {
        return $this->answerStatus;
    }
}