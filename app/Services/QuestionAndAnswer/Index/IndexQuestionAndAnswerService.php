<?php

namespace App\Services\QuestionAndAnswer\Index;

use App\Repositories\QuestionAndAnswer\QuestionAndAnswerRepository;

class IndexQuestionAndAnswerService
{
    private QuestionAndAnswerRepository $questionAndAnswerRepository;

    public function __construct(QuestionAndAnswerRepository $questionAndAnswerRepository)
    {
        $this->questionAndAnswerRepository = $questionAndAnswerRepository;
    }

    public function execute(): array
    {
        return $this->questionAndAnswerRepository->getAllCategories();
    }

}
