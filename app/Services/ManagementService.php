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
        if (request()->hasFile('profile_image')) {
            $data['profile_image'] = $this->upload($data['profile_image'], 'assetlite/images/about-us/');
        }

        if (request()->hasFile('banner_image')) {
            $data['banner_image'] = $this->upload($data['banner_image'], 'assetlite/images/about-us/');
        }
        $this->save($data);
        return new Response('ManagementInfo added successfully');
    }


    /**
     * @param $request
     * @param $management
     * @return bool
     */
    public function updateManagementInfo($request, $management)
    {
        $data = $request->all();

        if (request()->hasFile('image_url')) {
            $data['image_url'] = $this->upload($data['image_url'], 'assetlite/images/about-us/');
            $this->deleteFile($management->image_url);
        }

        if (request()->hasFile('profile_image')) {
            $data['profile_image'] = $this->upload($data['profile_image'], 'assetlite/images/about-us/');
            $this->deleteFile($management->profile_image);
        }

        if (request()->hasFile('banner_image')) {
            $data['banner_image'] = $this->upload($data['banner_image'], 'assetlite/images/about-us/');
            $this->deleteFile($management->banner_image);
        }

        return $management->update($data);
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteManagementInfo($id)
    {
        $management = $this->findOne($id);
        $this->deleteFile($management->image_url);

        return $management->delete();
      //  return Response('ManagementInfo deleted successfully !');
    }
}
