<?php

namespace App\Services\QuestionAndAnswer\Show;

use App\Models\Question;
use App\Repositories\QuestionAndAnswer\QuestionAndAnswerRepository;

class ShowQuestionService
{
    private QuestionAndAnswerRepository $questionAndAnswerRepository;

    public function __construct(QuestionAndAnswerRepository $questionAndAnswerRepository)
    {
        $this->questionAndAnswerRepository = $questionAndAnswerRepository;
    }

    public function execute(ShowQuestionRequest $request): Question
    {
        return $this->questionAndAnswerRepository->getQuestion($request->getCategoryId(), $request->getQuestionId());
    }
}