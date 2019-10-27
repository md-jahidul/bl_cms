<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\HelpCenterRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class HelpCenterService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $helpCenterRepository;

    /**
     * DigitalServicesService constructor.
     * @param helpCenterRepository $helpCenterRepository
     */
    public function __construct(HelpCenterRepository $helpCenterRepository)
    {
        $this->helpCenterRepository = $helpCenterRepository;
        $this->setActionRepository($helpCenterRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeHelpCenter($data)
    {
        $data['icon'] = 'storage/'.$data['icon']->store('Help_Center_Icon');
        $this->save($data);
        return new Response("Help Center has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateHelpCenter($request, $helpCenter)
    {
        if(array_key_exists('icon', $request)){
            $request['icon'] = 'storage/'.$request['icon']->store('Help_Center_Icon');
            unlink($helpCenter->icon);
        }else{
            $request['icon'] = $helpCenter->icon;
        }
        $helpCenter->update($request);
        return Response('Help Center has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroyHelpCenter($id)
    {
        $helpCenter = $this->findOne($id);
        unlink($helpCenter->icon);
        $helpCenter->delete();
        return Response('Help Center has been successfully deleted');
    }

}
