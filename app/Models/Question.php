<?php

namespace App\Models;

class Question
{
    private int $categoryId;
    private string $question;
    private int $questionNumber;
    private ?int $id;

    public function __construct(int $categoryId, string $question, int $questionNumber, ?int $id = null)
    {
        $this->categoryId = $categoryId;
        $this->question = $question;
        $this->questionNumber = $questionNumber;
        $this->id = $id;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getQuestionNumber(): int
    {
        return $this->questionNumber;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public static function getQuestionProgress(int $currentQuestionNUmber, int $totalQuestionAmount): int
    {
        return $currentQuestionNUmber/$totalQuestionAmount*100;
    }
}