<?php

namespace App\Services\QuestionAndAnswer\Show;

use App\Repositories\QuestionAndAnswer\QuestionAndAnswerRepository;

class ShowAnswerService
{
    private QuestionAndAnswerRepository $questionAndAnswerRepository;

    public function __construct(QuestionAndAnswerRepository $questionAndAnswerRepository)
    {
        $this->questionAndAnswerRepository = $questionAndAnswerRepository;
    }

    public function execute(ShowAnswerRequest $request): array
    {
        return $this->questionAndAnswerRepository->getAnswers($request->getQuestionId());
    }


}