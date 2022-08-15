<?php

namespace App\Repositories\QuestionAndAnswer;

interface QuestionAndAnswerRepository
{
    public function getAllCategories();
    public function getCategory(int $categoryId);
    public function getQuestion(int $categoryId, int $questionNumber);
    public function getAnswers(int $questionId);
}