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
            $items = $builder->skip($start)->take($length)->orderBy('created_at', 'DESC')->get();
            $data = [];
            $items->each(function ($item) use (&$data) {
                $data[] = [
                    'id' => $item->id,
                    "banner" => $item->banner,
                    "pending_bottom_label_en" => $item->pending_bottom_label_en,
                    "pending_bottom_label_bn" => $item->pending_bottom_label_bn,
                    "completed_bottom_label_en" => $item->completed_bottom_label_en,
                    "completed_bottom_label_bn" => $item->completed_bottom_label_bn,
                    "success_left_btn_en" => $item->success_left_btn_en,
                    "success_left_btn_bn" => $item->success_left_btn_bn,
                    "success_left_btn_deeplink" => $item->success_left_btn_deeplink,
                    "success_right_btn_en" => $item->success_right_btn_en,
                    "success_right_btn_bn" => $item->success_right_btn_bn,
                    "success_right_btn_deeplink" => $item->success_right_btn_deeplink,
                    "failed_left_btn_en" => $item->failed_left_btn_en,
                    "failed_left_btn_bn" => $item->failed_left_btn_bn,
                    "failed_left_btn_deeplink" => $item->failed_left_btn_deeplink,
                    "failed_right_btn_en" => $item->failed_right_btn_en,
                    "failed_right_btn_bn" => $item->failed_right_btn_bn,
                    "failed_right_btn_deeplink" => $item->failed_right_btn_deeplink,
                    "success_message_en" => $item->success_message_en,
                    "success_message_bn" => $item->success_message_bn,
                    "failed_message_en" => $item->failed_message_en,
                    "failed_message_bn" => $item->failed_message_bn,
                    "show_answer_btn_en" => $item->show_answer_btn_en,
                    "show_answer_btn_bn" => $item->show_answer_btn_bn,
                    "type" => $item->type,
                    "rule_name" => $item->rule_name,
                    "content_for" => $item->content_for,
                    "status" => ($item->status == '1') ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>InActive</span>",
                ];
            });


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
