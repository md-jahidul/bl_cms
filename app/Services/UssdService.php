<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\UssdRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class UssdService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $ussdRepository;

    /**
     * DigitalServicesService constructor.
     * @param UssdRepository $ussdRepository
     */
    public function __construct(UssdRepository $ussdRepository)
    {
        $this->ussdRepository = $ussdRepository;
        $this->setActionRepository($ussdRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeUssd($data)
    {
        $this->save($data);
        return new Response("USSD Code has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateUssd($request, $id)
    {
        $data = $this->findOne($id);
        $data->update($request->all());
        return Response('USSD Code has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteUssd($id)
    {
        $data = $this->findOne($id);
        $data->delete();
        return Response('USSD Code has been successfully deleted');
    }
}
