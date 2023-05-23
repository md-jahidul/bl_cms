<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\AboutPageRepository;
use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AboutPageService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $prizeService
     */
    protected $aboutPageRepository;

    /**
     * AboutPageService constructor.
     * @param AboutPageRepository $aboutPageRepository
     */
    public function __construct(AboutPageRepository $aboutPageRepository)
    {
        $this->aboutPageRepository = $aboutPageRepository;
        $this->setActionRepository($aboutPageRepository);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findAboutDetail($slug)
    {
        return $this->aboutPageRepository->findDetail($slug);
    }

    /**
     * @param $data
     * @param $fileLocation
     * @return ResponseFactory|Response
     */
    public function aboutPageUpdate($data, $fileLocation)
    {
        $aboutDetail = $this->aboutPageRepository->findDetail($data['slug']);
        if ($aboutDetail != null) {
            if (request()->hasFile('left_side_img')) {
                $data['left_side_img'] = $this->upload($data['left_side_img'], $fileLocation);
                $this->deleteFile($aboutDetail['left_side_img']);
            }
            if (request()->hasFile('right_side_ing')) {
                $data['right_side_ing'] = $this->upload($data['right_side_ing'], $fileLocation);
                $this->deleteFile($aboutDetail['right_side_ing']);
            }

            if (isset($data['remove_img_left'])) {
                $data['left_side_img'] = null;
                $this->deleteFile($aboutDetail['left_side_img']);
            }
            if (isset($data['remove_img_right'])) {
                $data['right_side_ing'] = null;
                $this->deleteFile($aboutDetail['right_side_ing']);
            }

            $aboutDetail->update($data);
        } else {
            return Response('About page not found');
        }
    }

    /**
     * @param $data
     * @return ResponseFactory|Response
     */
    public function updateAboutPage($data)
    {
//        if (isset($data['remove_img_left'])) {
//            $data['left_side_img'] = null;
//        }
//        if (isset($data['right_side_ing'])) {
//            $data['right_side_ing'] = null;
//        }
        dd($data);
        if ($data['slug'] == "priyojon") {
            $this->aboutPageUpdate($data, 'assetlite/images/about-priyojon');
        } elseif ($data['slug'] == "reward_points") {
            $this->aboutPageUpdate($data, 'assetlite/images/about-reward');
        }
        return Response('About page updated successfully');
    }

}
