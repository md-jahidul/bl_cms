<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\NotifiactionRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class NotifiactionService
{

    use CrudTrait;
    /**
     * @var $notifiactionRepository
     */
    protected $notifiactionRepository;

    /**
     * notifiactionRepository constructor.
     * @param NotifiactionRepository $notifiactionRepository
     */
    public function __construct(NotifiactionRepository $notifiactionRepository)
    {
        $this->notifiactionRepository = $notifiactionRepository;
        $this->setActionRepository($notifiactionRepository);
    }

    /**
     * Storing the Notifiaction resource
     * @return Response
     */
    public function storeNotifiaction($data)
    {
        $this->save($data);
        return new Response("Notification has successfully been created");
    }

    /**
     * Updating the Notifiaction
     * @param $data
     * @return Response
     */
    public function updateNotifiaction($data, $id)
    {
        $notifiaction = $this->findOne($id);
        $notifiaction->update($data);
        return Response('Notifiaction updated successfully !');
        
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteNotifiaction($id)
    {
        $notifiaction = $this->findOne($id);
        $notifiaction->delete();
        return Response('Notifiaction deleted successfully !');
    }

}
