<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\AboutPriyojonRepository;
use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class AboutPriyojonService
{
    use CrudTrait;

    /**
     * @var $prizeService
     */
    protected $aboutPriyojonRepository;

    /**
     * AboutPriyojonService constructor.
     * @param AboutPriyojonRepository $aboutPriyojonRepository
     */
    public function __construct(AboutPriyojonRepository $aboutPriyojonRepository)
    {
        $this->aboutPriyojonRepository = $aboutPriyojonRepository;
        $this->setActionRepository($aboutPriyojonRepository);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findAboutDetail($slug)
    {
        return $this->aboutPriyojonRepository->findDetail($slug);
    }

    public function aboutImgUpload($data, $fileLocation)
    {
        $aboutDetail = $this->aboutPriyojonRepository->findDetail($data['slug']);
        if ($aboutDetail != null) {
            if (!empty($data['left_side_img'])) {
                $url = $this->imageUpload($data, 'left_side_img', "about_image_left", $fileLocation);
                $data['left_side_img'] = "$fileLocation/" . $url;
            }
            if (!empty($data['right_side_ing'])) {
                $url = $this->imageUpload($data, 'right_side_ing', "about_image_right", $fileLocation);
                $data['right_side_ing'] = "$fileLocation/" . $url;
            }
            $aboutDetail->update($data);
            return Response('About priyojon updated successfully');
        }
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateAboutPriyojon($data)
    {

        $this->aboutImgUpload($data, 'images/about-priyojon');

//        $aboutDetail = $this->aboutPriyojonRepository->findDetail($data['slug']);
//        if ($aboutDetail != null) {
//            if (!empty($data['left_side_img'])) {
//                $url = $this->imageUpload($data, 'left_side_img', "about_image_left", 'images/about-priyojon');
//                $data['left_side_img'] = "/images/about-priyojon/" . $url;
//            }
//            if (!empty($data['right_side_ing'])) {
//                $url = $this->imageUpload($data, 'right_side_ing', "about_image_right", 'images/about-priyojon');
//                $data['right_side_ing'] = "/images/about-priyojon/" . $url;
//            }
//            $aboutDetail->update($data);
//            return Response('About priyojon updated successfully');
//        }
        return Response('About page not found!');
    }

    public function updateAboutReward($data)
    {

        return Response('About page not found!');
    }

}
