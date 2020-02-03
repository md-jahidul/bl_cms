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
     * @param $request
     * @return Response
     */
    public function storeAboutUsInfo($request)
    {
        $data = $request->all();

        if (request()->hasFile('content_image')) {
            $data['content_image'] = $this->upload($data['content_image'], 'assetlite/images/about-us/');
        }

        if (request()->hasFile('banner_image')) {
            $data['banner_image'] = $this->upload($data['banner_image'], 'assetlite/images/about-us/');
        }

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
        $aboutUs = $this->findOne($id);

        if (request()->hasFile('content_image')) {
            $data['content_image'] = $this->upload($data['content_image'], 'assetlite/images/about-us/');
            $this->deleteFile($aboutUs->content_image);
        }

        if (request()->hasFile('banner_image')) {
            $data['banner_image'] = $this->upload($data['banner_image'], 'assetlite/images/about-us/');
            $this->deleteFile($aboutUs->banner_image);
        }

        $aboutUs->update($data);
        return Response('About Us Info updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteAboutUsInfo($id)
    {
        $aboutUs = $this->findOne($id);
        $this->deleteFile($aboutUs->content_image);
        $this->deleteFile($aboutUs->banner_image);
        $aboutUs->delete();
        return Response('About Us Info deleted successfully !');
    }
}
