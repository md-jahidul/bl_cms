<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\WellcomeInfoRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class WellcomeInfoService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $wellcomeInfoRepository;

    /**
     * DigitalServicesService constructor.
     * @param WellcomeInfoRepository $sliderRepository
     */
    public function __construct(WellcomeInfoRepository $wellcomeInfoRepository)
    {
        $this->wellcomeInfoRepository = $wellcomeInfoRepository;
        $this->setActionRepository($wellcomeInfoRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeWellcomeInfo($data)
    {
        $data['icon'] = 'storage/'.$data['icon']->store('icon');
        $this->save($data);
        return new Response("Wellcome Info has successfully been created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateWellcomeInfo($request, $wellcomeInfo)
    {
        $data = $request->all();
        if(isset($request->all()['icon'])){
            unlink($wellcomeInfo->icon);
            $data['icon'] = 'storage/'.$request->all()['icon']->store('icon');
            $wellcomeInfo->update($data);
        }else{
            $data['icon'] = $wellcomeInfo->icon;
            $wellcomeInfo->update($data);
        }
        return Response('Wellcome Info updated successfully !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteWellcomeInfo($id)
    {
        // $slider = $this->findOne($id);
        // $slider->delete();
        // return Response('Slider deleted successfully !');
    }

}
