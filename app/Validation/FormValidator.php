<?php

namespace App\Validation;

use App\Exceptions\FormValidationException;

class FormValidator
{
    private array $data;
    private array $errors = [];
    private array $rules;

    public function __construct(array $data, array $rules = [])
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function passes(): void
    {
        foreach ($this->rules as $key => $rules)
        {
            foreach ($rules as $rule) {

                $ruleName = 'validate' . ucfirst($rule);

                $this->{$ruleName}($key);
            }
        }

        if (count($this->errors)>0)
        {
            throw new FormValidationException();
        }
    }

    private function validateRequired(string $key): void
    {
        if (empty(trim($this->data[$key])))
        {
            $this->errors[$key][] = "{$key} field is required!";
        }
    }

    private function validateLetters(string $key): void
    {
        if (!preg_match('/^[\p{L} ]+$/u', $this->data[$key])){
            $this->errors[$key][] ="{$key} must contain only letters!";
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}