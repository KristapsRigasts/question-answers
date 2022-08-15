<?php

namespace App\Services\User\Register;

class RegisterUserRequest
{
    private string $name;
    private int $categoryId;

    public function __construct(string $name, int $categoryId)
    {
        $this->name = $name;
        $this->categoryId = $categoryId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
}