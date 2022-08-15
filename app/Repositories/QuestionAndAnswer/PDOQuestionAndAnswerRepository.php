<?php

namespace App\Repositories\QuestionAndAnswer;

use App\Connection;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;

class PDOQuestionAndAnswerRepository implements QuestionAndAnswerRepository
{
    public function getAllCategories(): array
    {
        $categoriesQuery = Connection::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('category')
            ->fetchAllAssociative();

        $categories = [];

        foreach ($categoriesQuery as $category) {
            $categories[] = new Category(
                $category['id'],
                $category['category_name'],
                $category['category_question_amount']
            );
        }
        return $categories;
    }

    public function getCategory(int $categoryId): Category
    {
        $categoryQuery = Connection::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('category')
            ->where('id = ?')
            ->setParameter(0, $categoryId)
            ->fetchAssociative();

        return New Category(
            $categoryQuery['id'],
            $categoryQuery['category_name'],
            $categoryQuery['category_question_amount']
        );
    }

    public function getQuestion(int $categoryId, int $questionNumber): Question
    {
        $questionQuery = Connection::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('questions')
            ->where('category_id = ?')
            ->andWhere('question_number = ?')
            ->setParameters([0 => $categoryId, 1 => $questionNumber])
            ->executeQuery()
            ->fetchAssociative();

        return new Question(
            $questionQuery['category_id'],
            $questionQuery['question'],
            $questionQuery['question_number'],
            $questionQuery['id']
        );
    }

    public function getAnswers(int $questionId): array
    {
        $answerQuery = Connection::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('answer_options')
            ->where('question_id = ?')
            ->setParameter(0, $questionId)
            ->executeQuery()
            ->fetchAllAssociative();

        $answers = [];

        foreach ($answerQuery as $answer) {
            $answers[] = new Answer(
                $answer['id'],
                $answer['question_id'],
                $answer['answer_option'],
                $answer['answer_status']
            );
        }
        return $answers;
    }


}