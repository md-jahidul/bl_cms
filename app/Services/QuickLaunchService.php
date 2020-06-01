<?php

namespace App\Services;

use App\Http\Helpers;
use App\Repositories\QuickLaunchRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class QuickLaunchService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var QuickLaunchRepository
     */
    protected $quickLaunchRepository;

    /**
     * QuickLaunchService constructor.
     * @param QuickLaunchRepository $quickLaunchRepository
     */
    public function __construct(QuickLaunchRepository $quickLaunchRepository)
    {
        $this->quickLaunchRepository = $quickLaunchRepository;
        $this->setActionRepository($quickLaunchRepository);
    }

    /**
     * @return mixed
     */
    public function itemList($type)
    {
        return $this->quickLaunchRepository->getQuickLaunch($type);
    }

    /**
     * @param $data
     * @param $type
     * @return Response
     */
    public function storeQuickLaunchItem($data, $type)
    {
        $count = count($this->quickLaunchRepository->findAll());
        if (request()->hasFile('image_url')) {
            $data['image_url'] = $this->upload($data['image_url'], 'assetlite/images/quick-launch-items');
        }
        $data['display_order'] = ++$count;
        $data['type'] = $type;
        $this->save($data);
        return new Response('Quick Launch added successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($data)
    {
        $this->quickLaunchRepository->quickLaunchTableSort($data);
        return new Response('update successfully');
    }


    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateQuickLaunch($data, $id)
    {
        $quickLaunch = $this->findOne($id);
        if (request()->hasFile('image_url')) {
            $data['image_url'] = $this->upload($data['image_url'], 'assetlite/images/quick-launch-items');
            $this->deleteFile($quickLaunch->image_url);
        }
        $data['is_external_link'] = isset($data['is_external_link']) ? 1 : 0;
        $quickLaunch->update($data);
        return Response('Quick launch updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteQuickLaunch($id)
    {
        $quickLaunch = $this->findOne($id);
        $this->deleteFile($quickLaunch->image_url);
        $quickLaunch->delete();
        return Response('Quick launch deleted successfully !');
    }
}
