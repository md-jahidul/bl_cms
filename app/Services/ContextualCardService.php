<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\ContextualCardRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class ContextualCardService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $contextualCardRepository;

    /**
     * DigitalServicesService constructor.
     * @param ContextualCardRepository $sliderRepository
     */
    public function __construct(ContextualCardRepository $contextualCardRepository)
    {
        $this->contextualCardRepository = $contextualCardRepository;
        $this->setActionRepository($contextualCardRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeContextualCard($data)
    {
        $data['image'] = 'storage/'.$data['image']->store('banner');
        $this->save($data);
        return new Response("Banner has successfully been created");
    }

    /**
     * Updating the ContextualCard
     * @param $data
     * @return Response
     */
    public function updateContextualCard($data, $contextualCard)
    {

        if(isset($data->image_path)){
            $data = $data->all();
            $data['image_path'] = 'storage/'.$data['image_path']->store('contextualCard');
            unlink($contextualCard->image_path);
            $contextualCard->update($data);
        }else{
            $data->image_path = $contextualCard->image_path;
            $contextualCard->update($contextualCard->all());
        }
        
        return Response('Banner updated successfully !');
        
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteContextualCard($id)
    {
        $contextualCard = $this->findOne($id);
        unlink($contextualCard->image_path);
        $contextualCard->delete();
        return Response('banner deleted successfully !');
    }

}
