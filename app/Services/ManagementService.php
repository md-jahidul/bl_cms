<?php

namespace App\Services;

use App\Http\Helpers;
use App\Repositories\AboutUsLandingRepository;
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
     * @var AboutUsLandingRepository
     */
    private $aboutUsLandingRepository;

    /**
     * QuickLaunchService constructor.
     * @param ManagementRepository $managementRepository
     */
    public function __construct(
        ManagementRepository $managementRepository,
        AboutUsLandingRepository $aboutUsLandingRepository
    ) {
        $this->managementRepository = $managementRepository;
        $this->aboutUsLandingRepository = $aboutUsLandingRepository;
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

        $data['display_order'] = ++$count;

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
     * @return bool|null
     * @throws Exception
     */
    public function deleteManagementInfo($id)
    {
        $management = $this->findOne($id);
        $this->deleteFile($management->profile_image);
        $this->deleteFile($management->banner_image);

        return $management->delete();
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($data)
    {
        $this->managementRepository->sortManangementInfo($data);
        return new Response('update successfully');
    }

    public function landingComponentSave($data)
    {
        $componentData = $this->aboutUsLandingRepository->findOneByProperties(['component_type' => "management"]);
        $data['component_type'] = "management";
        if (!$componentData) {
            return $this->aboutUsLandingRepository->save($data);
        } else {
            return $componentData->update($data);
        }
    }
}
