<?php

namespace App\Models;

class Category
{
    private int $id;
    private string $categoryName;
    private int $questionAmount;

    public function __construct(int $id, string $categoryName, int $questionAmount)
    {

        $this->id = $id;
        $this->categoryName = $categoryName;
        $this->questionAmount = $questionAmount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function getQuestionAmount(): int
    {
        return $this->questionAmount;
    }
}