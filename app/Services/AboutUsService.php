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

//        if (!empty($data['banner_image'])) {
//            $data['banner_image'] = $this->upload($data['banner_image'], 'assetlite/images/about-us/');
//        }

        //only rename
//        if ($data['old_banner_name'] != $data['banner_name']) {
//
//            if (empty($data['banner_image']) && $data['old_web_img'] != "") {
//                $fileName = $data['banner_name'] . '-web';
//                $directoryPath = 'assetlite/images/about-us/';
//                $data['banner_image'] = $this->rename($data['old_web_img'], $fileName, $directoryPath);
//                $status = $data['banner_image'];
//            }
//
//            if (empty($data['banner_image_mobile']) && $data['old_mob_img'] != "") {
//                $fileName = $data['banner_name'] . '-mobile';
//                $directoryPath = 'assetlite/images/about-us/';
//                $data['banner_image_mobile'] = $this->rename($data['old_mob_img'], $fileName, $directoryPath);
//                $status = $data['banner_image_mobile'];
//            }
//        }


        unset($data['old_web_img']);
        unset($data['old_mob_img']);
        unset($data['old_banner_name']);

        $this->save($data);
        return new Response('About Us Info added successfully');
    }


    /**
     * @param $request
     * @param $aboutUs
     * @return ResponseFactory|Response
     */
    public function updateAboutUsInfo($request, $aboutUs)
    {
        $data = $request->all();

        if (request()->hasFile('content_image')) {
            $data['content_image'] = $this->upload($data['content_image'], 'assetlite/images/about-us');
            $this->deleteFile($aboutUs->content_image);
        }

        if (request()->hasFile('banner_image')) {
            $data['banner_image'] = $this->upload($data['banner_image'], 'assetlite/images/about-us/');
            $this->deleteFile($aboutUs->banner_image);
        }

//        if (!empty($data['banner_image'])) {
//            if ($data['old_web_img'] != "") {
//                $this->deleteFile($data['old_web_img']);
//            }
//            $photoName = $data['banner_name'] . '-web';
//            $data['banner_image'] = $this->upload($data['banner_image'], 'assetlite/images/about-us', $photoName);
//            $status = $data['banner_image'];
//        }

//        if (!empty($data['banner_image_mobile'])) {
//            if ($data['old_mob_img'] != "") {
//                $this->deleteFile($data['old_mob_img']);
//            }
//            $photoName = $data['banner_name'] . '-mobile';
//            $data['banner_image_mobile'] = $this->upload($data['banner_image_mobile'], 'assetlite/images/about-us', $photoName);
//        }

        //only rename
//        if ($data['old_banner_name'] != $data['banner_name']) {
//            if (empty($data['banner_image']) && $data['old_web_img'] != "") {
//                $fileName = $data['banner_name'] . '-web';
//
//                $directoryPath = 'assetlite/images/about-us';
//                $data['banner_image'] = $this->rename($data['old_web_img'], $fileName, $directoryPath);
//            }
//            if (!empty($data['banner_image_mobile']) && $data['old_mob_img'] != "") {
//                $fileName = $data['banner_name'] . '-mobile';
//                $directoryPath = 'assetlite/images/about-us';
//                $data['banner_image_mobile'] = $this->rename($data['old_mob_img'], $fileName, $directoryPath);
//            }
//        }

        unset($data['old_web_img']);
        unset($data['old_mob_img']);
        unset($data['old_banner_name']);


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
