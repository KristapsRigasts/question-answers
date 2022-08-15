<?php

namespace App\Controllers;

use App\Exceptions\FormValidationException;
use App\Models\Question;
use App\Models\User;
use App\Redirect;
use App\Services\QuestionAndAnswer\Index\IndexCategoryRequest;
use App\Services\QuestionAndAnswer\Index\IndexCategoryService;
use App\Services\QuestionAndAnswer\Index\IndexQuestionAndAnswerService;
use App\Services\QuestionAndAnswer\Show\ShowAnswerRequest;
use App\Services\QuestionAndAnswer\Show\ShowAnswerService;
use App\Services\QuestionAndAnswer\Show\ShowQuestionRequest;
use App\Services\QuestionAndAnswer\Show\ShowQuestionService;
use App\Services\User\Answer\AnswerUserRequest;
use App\Services\User\Answer\AnswerUserService;
use App\Services\User\FinalResult\FinalResultRequest;
use App\Services\User\FinalResult\FinalResultService;
use App\Services\User\Register\RegisterUserRequest;
use App\Services\User\Register\RegisterUserService;
use App\Services\User\Result\ResultUserRequest;
use App\Services\User\Result\ResultUserService;
use App\Validation\FormValidator;
use App\View;

class QuestionAnswerController
{
    private IndexQuestionAndAnswerService $indexQuestionAndAnswerService;
    private RegisterUserService $registerUserService;
    private IndexCategoryService $indexCategoryService;
    private ShowQuestionService $showQuestionService;
    private ShowAnswerService $showAnswerService;
    private AnswerUserService $answerUserService;
    private FinalResultService $finalResultService;
    private ResultUserService $resultUserService;

    public function __construct(IndexQuestionAndAnswerService $indexQuestionAndAnswerService,
                                RegisterUserService $registerUserService,
                                IndexCategoryService $indexCategoryService,
                                ShowQuestionService $showQuestionService,
                                ShowAnswerService $showAnswerService,
                                AnswerUserService $answerUserService,
                                FinalResultService $finalResultService,
                                ResultUserService $resultUserService)
    {
        $this->indexQuestionAndAnswerService = $indexQuestionAndAnswerService;
        $this->registerUserService = $registerUserService;
        $this->indexCategoryService = $indexCategoryService;
        $this->showQuestionService = $showQuestionService;
        $this->showAnswerService = $showAnswerService;
        $this->answerUserService = $answerUserService;
        $this->finalResultService = $finalResultService;
        $this->resultUserService = $resultUserService;
    }

    public function index(): View
    {
        session_destroy();
        /* gathering all available question categories */
        $categories = $this->indexQuestionAndAnswerService->execute();

        return new View('QuestionsAnswers/index', ['categories' => $categories]);
    }

    public function register(): Redirect
    {
        /* data validation for required and only letters can be used when providing username */
        try {
            $validator = (new FormValidator($_POST, [
                'name' => ['required', 'letters'],
                'question_category' => ['required']
            ]));
            $validator->passes();
        /* storing username and chosen question category */
            $userId = $this->registerUserService->execute(new RegisterUserRequest(
                trim($_POST['name']),
                $_POST['question_category']
            ));
            $_SESSION['userId'] = $userId;

            if (isset($_SESSION['questionNumber'])) {
                unset($_SESSION['questionNumber']);
            }

            $category = $this->indexCategoryService->execute(new IndexCategoryRequest($_POST['question_category']));
            $_SESSION['categoryId'] = $_POST['question_category'];
            $_SESSION['questionAmount'] = $category->getQuestionAmount();

            return new Redirect('/question');

        } catch (FormValidationException $exception) {
        /* if validation fails returned to page where user must declare correct name or choose question category */
            $_SESSION['errors'] = $validator->getErrors();
            $_SESSION['inputs'] = $_POST;

            return new Redirect('/');
        }
    }

    public function show()
    {
        /* checks if user has declared username or category if not returned to declare username and question category */
        if (!User::userOrCategoryIsSet())
        {
           return new Redirect('/');
        }
        /* checks if user has answered to all chosen category questions */
        if (isset($_SESSION['questionNumber']) && $_SESSION['questionNumber'] === $_SESSION['questionAmount'])
        {
            return new Redirect('/result');
        }

        if (!isset($_SESSION['questionNumber'])){
            $_SESSION['questionNumber'] = 1;
        } else {
            $_SESSION['questionNumber'] += 1;
        }
        $categoryId = $_SESSION['categoryId'];
        $questionNumber = $_SESSION['questionNumber'];

        $question = $this->showQuestionService->execute(new ShowQuestionRequest(
            $categoryId,
            $questionNumber
        ));

        $_SESSION['questionId'] = $question->getId();

        $answers = $this->showAnswerService->execute(new ShowAnswerRequest(
            $question->getId()
        ));
        /* shuffle answers in different order */
       shuffle($answers);

        $questionAmount = $_SESSION['questionAmount'];
        $actualQuestionNumber = $_SESSION['questionNumber'];
        /* calculating progress % */
        $percent = Question::getQuestionProgress($actualQuestionNumber,$questionAmount);

        return new View('QuestionsAnswers/show', [
            'question' => $question,
            'answers' => $answers,
            'questionAmount' => $questionAmount,
            'actualQuestionNumber' => $actualQuestionNumber,
            'percent' => $percent
            ]);

    }

    public function answer(): Redirect
    {
        /* answer id and answer status (correct or wrong) */
        $answerAndStatus = $_POST['answer'];
        [$answerId, $answerStatus] = explode('-', $answerAndStatus);

        /* if answer is correct initializing correct answer count or incrementing it */
        if (!isset($_SESSION['correctAnswer']) && intval($answerStatus) === 1) {
            $_SESSION['correctAnswer'] = 1;
        } else if (intval($answerStatus) === 1) {
            $_SESSION['correctAnswer'] += 1;
        }

        /* storing user answered category id, question id, chosen answer id and answer status */
        $this->answerUserService->execute(new AnswerUserRequest(
            $_SESSION['userId'],
            $_SESSION['categoryId'],
            $_SESSION['questionId'],
            $answerId,
            $answerStatus
        ));

        return new Redirect('/question');
    }

    public function result()
    {
        if (!User::userOrCategoryIsSet())
        {
            return new Redirect('/');
        }

        $totalQuestionAmount = $_SESSION['questionAmount'];
        $correctAnswerAmount = $_SESSION['correctAnswer'] ?? 0;

        /* storing user final result with correct answer amount */
        $this->finalResultService->execute(new FinalResultRequest(
            $_SESSION['userId'],
            $_SESSION['categoryId'],
            $correctAnswerAmount
        ));

        $user = $this->resultUserService->execute(new ResultUserRequest($_SESSION['userId']));
        $userName = htmlspecialchars($user->getName());

        session_destroy();

        return new View('QuestionsAnswers/result',[
            'userName' => $userName,
            'totalQuestionAmount' => $totalQuestionAmount,
            'correctAnswerAmount' => $correctAnswerAmount
            ]);
    }
}