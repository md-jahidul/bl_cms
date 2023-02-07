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
        $triviaInfo = $this->findOne($data['id']);
        if (isset($data['banner'])) {
            $data['banner'] = 'storage/' . $data['banner']->store('trivia');
            if (isset($triviaInfo) && file_exists($triviaInfo->banner)) {
                unlink($triviaInfo->banner);
            }
        }
        
        return $this->triviaGamificationRepository->saveTriviaInfo($data);
    }
}
