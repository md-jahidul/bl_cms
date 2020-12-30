<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\BandhoSimImageRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class BandhoSimImageService
{
    use CrudTrait;

    protected $bandhoSimImageRepository;

    /**
     * DigitalServicesService constructor.
     * @param BandhoSimImageRepository $bandhoSimImageRepository
     */
    public function __construct(BandhoSimImageRepository $bandhoSimImageRepository)
    {
        $this->bandhoSimImageRepository = $bandhoSimImageRepository;
        $this->setActionRepository($bandhoSimImageRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeBandhoSimImage($data)
    {
        if (isset($data['image'])) {
            $data['image_url'] = 'storage/' . $data['image']->store('bandhosimimage');
         }

        $this->save($data);
        return new Response("Bandho sime image has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateBandhoSimImage($data, $banner)
    {
        if (isset($data->image)) {
            $data = $data->all();
            $data['image_url'] = 'storage/' . $data['image']->store('bandhosimimage');

            if (File::exists($banner->image_url)) {
                unlink($banner->image_url);
            }
            $banner->update($data);
        } else {
            $data['id']=1;
            $data->image_url = $banner->image_url;
            $banner->update($data);
        }

        return Response('Bandho sim has been successfully updated');
    }



    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteBandhoSimImage($id)
    {
        $banner = $this->findOne($id);
        unlink($banner->image_path);
        $banner->delete();
        return Response('banner has been successfully deleted');
    }
}
