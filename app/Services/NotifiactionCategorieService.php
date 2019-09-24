<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\NotifiactionCategorieRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class NotifiactionCategorieService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $notifiactionCategorieRepository;

    /**
     * DigitalServicesService constructor.
     * @param NotifiactionCategorieRepository $sliderRepository
     */
    public function __construct(NotifiactionCategorieRepository $notifiactionCategorieRepository)
    {
        $this->notifiactionCategorieRepository = $notifiactionCategorieRepository;
        $this->setActionRepository($notifiactionCategorieRepository);
    }

    /**
     * Storing the NotifiactionCategorie resource
     * @return Response
     */
    public function storeNotifiactionCategorie($data)
    {
        $data['slug'] =  str_replace(" ","_",strtolower($data['name']));
        //dd($data);
        $this->save($data);
        return new Response("Notifiaction Categorie has successfully been created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateNotifiactionCategorie($data, $id)
    {
        $notifiactionCategorie = $this->findOne($id);
        $data['slug'] =  str_replace(" ","_",strtolower($data['name']));
        $notifiactionCategorie->update($data);
        return Response('Notifiaction Categorie updated successfully !');
        
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteNotifiactionCategorie($id)
    {
        $notifiactionCategorie = $this->findOne($id);
        $notifiactionCategorie->delete();
        return Response('Notifiaction Categorie deleted successfully !');
    }

}
