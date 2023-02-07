<?php

namespace App\Services;

use App\Repositories\AboutUsRepository;
use App\Repositories\TriviaGamificationRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class TriviaGamificationService
{
    use CrudTrait;

    /**
     * @var TriviaGamificationRepository
     */
    protected $triviaGamificationRepository;

    public function __construct(TriviaGamificationRepository $triviaGamificationRepository)
    {
        $this->triviaGamificationRepository = $triviaGamificationRepository;
        $this->setActionRepository($this->triviaGamificationRepository);
    }

    /**
     * @return mixed
     */
    public function saveTriviaInfo($data)
    {
        return $this->triviaGamificationRepository->saveTriviaInfo($data);
    }
}
