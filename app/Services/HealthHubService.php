<?php

namespace App\Services;

use App\Repositories\HealthHubAnalyticRepository;
use App\Repositories\HealthHubRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class HealthHubService
{
    use CrudTrait;
    use FileTrait;

    protected const REDIS_HEALTH_HUB_KEY = "mybl_health_hub_data";

    /**
     * @var HealthHubRepository
     */
    private $healthHubRepository;
    /**
     * @var HealthHubAnalyticRepository
     */
    private $healthHubAnalyticRepository;

    /**
     * HealthHubService constructor.
     * @param HealthHubRepository $healthHubRepository
     */
    public function __construct(
        HealthHubRepository $healthHubRepository,
        HealthHubAnalyticRepository $healthHubAnalyticRepository
    ) {
        $this->healthHubRepository = $healthHubRepository;
        $this->healthHubAnalyticRepository = $healthHubAnalyticRepository;
        $this->setActionRepository($healthHubRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeHealthHub($data)
    {
        $itemCount = $this->findAll()->count();
        if (request()->hasFile('icon')) {
            $data['icon'] = 'storage/' . $data['icon']->store('health-hub');
        }
        $data['display_order'] = $itemCount + 1;
        $this->save($data);
        Redis::del(self::REDIS_HEALTH_HUB_KEY);
        return new Response('Category added successfully!');
    }

    /**
     * @param $data
     * @return Response
     */
    public function updateHealthHub($data, $id)
    {
        $item = $this->healthHubRepository->findOne($id);

        if (request()->hasFile('icon')) {
            $data['icon'] = 'storage/' . $data['icon']->store('manage_image');
            if (!empty($item->icon)) {
                unlink($item->icon);
            }
        }

        $item->update($data);
        Redis::del(self::REDIS_HEALTH_HUB_KEY);
        return new Response('Health hub update successfully!');
    }

    /**
     * @param $data
     * @return Response
     */
    public function itemTableSort($data): Response
    {
        $this->healthHubRepository->itemTableSort($data);
        Redis::del(self::REDIS_HEALTH_HUB_KEY);
        return new Response('Sorted successfully');
    }

    public function analyticReports()
    {
        $analyticData = $this->healthHubRepository->getAnalyticData();

        dd($analyticData);

        $analyticData = $analyticData->map(function ($item) {
            return [
                'icon' => $item->icon,
                'title_en' => $item->title_en,
                'count' => $item->healthHubAnalytics->map(function ($data){
//                    dd($data);
                    return [
                        "unique_hit_count" => $data->distinct('msisdn')->count('msisdn')
                    ];
                }),
            ];
        });


//        $data = $data->groupBy('msisdn')->map(function ($people) {
//            return $people->count();
//        });
//        // or using HigherOrder proxy on the collection
//        $data = $data->groupBy('msisdn')->map->count();
        dd($analyticData);
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function deleteHealthHubItem($id)
    {
        $item = $this->findOne($id);
        if (!empty($item->icon)) {
            unlink($item->icon);
        }
        $item->delete();
        Redis::del(self::REDIS_HEALTH_HUB_KEY);
        return [
            'message' => 'Health hub item deleted successfully!!',
        ];
    }
}
