<?php

namespace App\Services;

use App\Http\Helpers;
use App\Repositories\AboutUsRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class AboutUsService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var AboutUsRepository
     */
    protected $aboutUsRepository;

    /**
     * AboutUsService constructor.
     * @param AboutUsRepository $aboutUsRepository
     */
    public function __construct(AboutUsRepository $aboutUsRepository)
    {
        $this->aboutUsRepository = $aboutUsRepository;
        $this->setActionRepository($aboutUsRepository);
    }

    /**
     * @return mixed
     */
    public function getAboutUsInfo()
    {
        return $this->aboutUsRepository->getAboutUsInfo();
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeAboutUsInfo($data)
    {
        $count = count($this->aboutUsRepository->findAll());
        if (request()->hasFile('image_url')) {
            $data['image_url'] = $this->upload($data['image_url'], 'assetlite/images/quick-launch-items/');
        }
        $data['display_order'] = ++$count;
        $this->save($data);
        return new Response('About Us Info added successfully');
    }


    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateAboutUsInfo($data, $id)
    {
        $quickLaunch = $this->findOne($id);
        if (request()->hasFile('image_url')) {
            $data['image_url'] = $this->upload($data['image_url'], 'assetlite/images/quick-launch-items/');
            $this->deleteFile($quickLaunch->image_url);
        }
        $quickLaunch->update($data);
        return Response('About Us Info updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteAboutUsInfo($id)
    {
        $quickLaunch = $this->findOne($id);
        $this->deleteFile($quickLaunch->image_url);
        $quickLaunch->delete();
        return Response('About Us Info deleted successfully !');
    }
}
