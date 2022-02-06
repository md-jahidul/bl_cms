<?php

namespace App\Services;

use App\Repositories\HealthHubRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
     * HealthHubService constructor.
     * @param HealthHubRepository $healthHubRepository
     */
    public function __construct(
        HealthHubRepository $healthHubRepository
    ) {
        $this->healthHubRepository = $healthHubRepository;
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

        $data['created_by'] = Auth::user()->id;
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

        $componentTypeURL = isset($data['other_info']['content']);
        if ($componentTypeURL) {
            $url = $data['other_info']['content'];
            if (substr($url, 0, 8) != "https://") {
                $data['other_info']['content'] = "https://" . str_replace(' ', '', $url);
            }
        }

        $data['updated_by'] = Auth::user()->id;
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
