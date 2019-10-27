<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 28-Aug-19
 * Time: 12:56 PM
 */

namespace App\Repositories;

use App\Models\AnswerOption;
use App\Models\Option;
use App\Models\Question;
use App\Traits\CrudTrait;

class QuestionRepository extends BaseRepository
{
    public $modelName = Question::class;

    public function createQuestion($request)
    {
        $question_data = $request->only('question_text', 'point', 'tag_id');
        if (!empty($question_data)) {
            $questionId = $this->model->create($question_data);
        }
        return $questionId->id;
    }

    public function questionUpdate($request, $id)
    {
        $question_data = $request->only('question_text', 'point', 'tag_id');
        if (!empty($question_data)) {
            $question = $this->model->findOrfail($id);
            $question->update($question_data);
        }
        return $question->id;
    }
}
