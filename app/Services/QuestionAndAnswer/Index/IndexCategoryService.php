<?php

namespace App\Services\QuestionAndAnswer\Index;

use App\Models\Category;
use App\Repositories\QuestionAndAnswer\QuestionAndAnswerRepository;

class IndexCategoryService
{
    private QuestionAndAnswerRepository $questionAndAnswerRepository;

    public function __construct(QuestionAndAnswerRepository $questionAndAnswerRepository)
    {
        $this->questionAndAnswerRepository = $questionAndAnswerRepository;
    }

    public function execute(IndexCategoryRequest $request): Category
    {
        return $this->questionAndAnswerRepository->getCategory($request->getCategoryId());
    }
}