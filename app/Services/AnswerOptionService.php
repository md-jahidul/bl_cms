<?php


namespace App\Services;

use App\Repositories\AnswerOptionRepository;
use App\Traits\CrudTrait;

class AnswerOptionService
{
    use CrudTrait;
    /**
     * @var $answerOptionRepository
     */
    protected $answerOptionRepository;

    /**
     * AnswerOptionService constructor.
     * @param AnswerOptionRepository $answerOptionRepository
     */
    public function __construct(AnswerOptionRepository $answerOptionRepository)
    {
        $this->answerOptionRepository = $answerOptionRepository;
        $this->setActionRepository($answerOptionRepository);
    }
}
