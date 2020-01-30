<?php

namespace App\Services;

use App\Http\Helpers;
use App\Repositories\ManagementRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ManagementService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var ManagementRepository
     */
    protected $managementRepository;

    /**
     * QuickLaunchService constructor.
     * @param ManagementRepository $managementRepository
     */
    public function __construct(ManagementRepository $managementRepository)
    {
        $this->managementRepository = $managementRepository;
        $this->setActionRepository($managementRepository);
    }

    /**
     * @return mixed
     */
    public function getManagementInfo()
    {
        return $this->managementRepository->getManagementInfo();
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeManagementInfo($data)
    {
        $count = count($this->managementRepository->findAll());
        if (request()->hasFile('image_url')) {
            $data['image_url'] = $this->upload($data['image_url'], 'assetlite/images/quick-launch-items/');
        }
        $data['display_order'] = ++$count;
        $this->save($data);
        return new Response('ManagementInfo added successfully');
    }


    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateManagementInfo($data, $id)
    {
        $quickLaunch = $this->findOne($id);
        if (request()->hasFile('image_url')) {
            $data['image_url'] = $this->upload($data['image_url'], 'assetlite/images/quick-launch-items/');
            $this->deleteFile($quickLaunch->image_url);
        }
        $quickLaunch->update($data);
        return Response('ManagementInfo updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteManagementInfo($id)
    {
        $quickLaunch = $this->findOne($id);
        $this->deleteFile($quickLaunch->image_url);
        $quickLaunch->delete();
        return Response('ManagementInfo deleted successfully !');
    }
}
