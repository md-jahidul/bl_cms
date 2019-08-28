<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 28-Aug-19
 * Time: 12:56 PM
 */

namespace App\Repositories;


use App\Models\Question;

class QuestionRepository extends BaseRepository
{
    public $modelName = Question::class;
}