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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

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
        $data['image_url'] = 'storage/' . $data['image_url']->store('contextualcard');
        $this->save($data);
        return new Response("Contextual Card has been successfully created");
    }

    /**
     * Updating the ContextualCard
     * @param $data
     * @return Response
     */
    public function updateContextualCard($data, $id)
    {

        $contextualCard = $this->findOne($id);
        if (isset($data['image_url'])) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('contextualCard');
            unlink($contextualCard->image_url);
            $contextualCard->update($data);
        } else {
            $data['image_url'] = $contextualCard->image_url;
            $contextualCard->update($data);
        }

        return Response('Contextual Card has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteContextualCard($id)
    {
        $contextualCard = $this->findOne($id);
        unlink($contextualCard->image_url);
        $contextualCard->delete();
        return Response('Contextual Card has been successfully deleted');
    }

    public function prepareDataForDatatable(Request $request)
    {
        $items = $this->contextualCardRepository->findAll();

        return Datatables::collection($items)->addIndexColumn()
            ->make(true);
    }
}
