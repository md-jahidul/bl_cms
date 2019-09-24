<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\BannerRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class BannerService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $bannerRepository;

    /**
     * DigitalServicesService constructor.
     * @param BannerRepository $sliderRepository
     */
    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
        $this->setActionRepository($bannerRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeBanner($data)
    {
        $data['image_path'] = 'storage/'.$data['image_path']->store('banner');
        $this->save($data);
        return new Response("Banner has successfully been created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateBanner($data, $banner)
    {

        if(isset($data->image_path)){
            $data = $data->all();
            $data['image_path'] = 'storage/'.$data['image_path']->store('banner');
            unlink($banner->image_path);
            $banner->update($data);
        }else{
            $data->image_path = $banner->image_path;
            $banner->update($data->all());
        }
        
        return Response('Banner updated successfully !');
        
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteBanner($id)
    {
        $banner = $this->findOne($id);
        unlink($banner->image_path);
        $banner->delete();
        return Response('banner deleted successfully !');
    }

}
