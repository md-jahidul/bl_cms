<?php


namespace App\Services;

use App\Repositories\ContextualCardIconRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class ContextualCardIconService
{
    use CrudTrait;

    /**
     * @var $contextualCardIconRepository
     */
    protected $contextualCardIconRepository;

    /**
     * ContextualCardIconRepository constructor.
     * @param ContextualCardIconRepository $contextualCardIconRepository
     */
    public function __construct(ContextualCardIconRepository $contextualCardIconRepository)
    {
        $this->contextualCardIconRepository = $contextualCardIconRepository;
        $this->setActionRepository($contextualCardIconRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeContextualCardIcon($data)
    {
        $data['icon'] = 'storage/' . $data['icon']->store('contextualcardicon');
        $this->save($data);
        return new Response("Contextual Card Icon has been successfully created");
    }


    /**
     * Updating the ContextualCard
     * @param $data
     * @return Response
     */
    public function updateContextualCard($data, $id)
    {

        $contextualCard = $this->findOne($id);
        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('contextualcardicon');
//            unlink($contextualCard->icon);
            $contextualCard->update($data);
        } else {
            $data['icon'] = $contextualCard->icon;
            $contextualCard->update($data);
        }

        return Response('Contextual Card Icon has been successfully updated');
    }

}
