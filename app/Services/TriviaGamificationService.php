<?php

namespace App\Services;

use App\Models\TriviaGamification;
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
        // $triviaInfo = $this->findOne($data['id']);
        // if (isset($data['banner'])) {
        //     $data['banner'] = 'storage/' . $data['banner']->store('trivia');
        //     if (isset($triviaInfo) && file_exists($triviaInfo->banner)) {
        //         unlink($triviaInfo->banner);
        //     }
        // }
        // return $this->triviaGamificationRepository->saveTriviaInfo($data);

        if (isset($data['banner'])) {
            $data['banner'] = 'storage/' . $data['banner']->store('trivia');
        }
        
        return $this->triviaGamificationRepository->save($data);
    }

    /**
     * @return mixed
     */
    public function updateTriviaInfo($data, $id)
    {
        $triviaInfo = $this->findOne($id);
        if (isset($data['banner'])) {
            $data['banner'] = 'storage/' . $data['banner']->store('trivia');
            if (isset($triviaInfo) && file_exists($triviaInfo->banner)) {
                unlink($triviaInfo->banner);
            }
        }

        return $this->triviaGamificationRepository->update($triviaInfo, $data);
    }

    /**
     * Delete Gamification in the db
     *
     * @param $id
     * @return Response
     * @throws Exception
     */
    public function destroy($id)
    {
        $this->delete($id);
        return new Response("Gamification has been successfully deleted");
    }

    /**
     * Get all Gamification
     *
     * @return array
     */
    public function getDataGamification($request)
    {
        try {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');

            $builder = new TriviaGamification();

            if ($request->type) {
                $builder = $builder->where('type', $request->type);
            }

            $all_items_count = $builder->count();
            $data = $builder->skip($start)->take($length)->orderBy('created_at', 'DESC')->get();
            return [
                'data' => $data,
                'draw' => $draw,
                'recordsTotal' => $all_items_count,
                'recordsFiltered' => $all_items_count
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }
}
