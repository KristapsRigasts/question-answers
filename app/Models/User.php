<?php

namespace App\Models;


class User
{
    private string $name;
    private int $categoryId;
    private ?int $id;

    public function __construct(string $name, int $categoryId, ?int $id = null )
    {
        $this->name = $name;
        $this->categoryId = $categoryId;
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public static function userOrCategoryIsSet(): bool
    {
        $registered = false;
        if (isset($_SESSION['userId']) || isset($_SESSION['categoryId'])) {
            $registered = true;
        }
        return $registered;
    }
}