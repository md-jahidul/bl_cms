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
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AboutPageService
{
    use CrudTrait;

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
            if (!empty($data['left_side_img'])) {
                $url = $this->imageUpload($data, 'left_side_img', "about_image_left", $fileLocation);
                $data['left_side_img'] = "$fileLocation/" . $url;
            }
            if (!empty($data['right_side_ing'])) {
                $url = $this->imageUpload($data, 'right_side_ing', "about_image_right", $fileLocation);
                $data['right_side_ing'] = "$fileLocation/" . $url;
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
        if ($data['slug'] == "priyojon") {
            $this->aboutPageUpdate($data, '/images/about-priyojon');
        } elseif ($data['slug'] == "reword_points") {
            $this->aboutPageUpdate($data, '/images/about-reward');
        }
        return Response('About page updated successfully');
    }

}
