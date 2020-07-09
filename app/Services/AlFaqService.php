<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AlFaqService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $alFaqRepository;

    /**
     * DigitalServicesService constructor.
     * @param AlFaqRepository $sliderRepository
     */
    public function __construct(AlFaqRepository $alFaqRepository)
    {
        $this->alFaqRepository = $alFaqRepository;
        $this->setActionRepository($alFaqRepository);
    }

    /**
     * Storing the alFaq resource
     * @return Response
     */
    public function storeAlFaq($data)
    {
        $data['image_path'] = 'storage/' . $data['image_path']->store('banner');
        $this->save($data);
        return new Response("Banner has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateFaq($data, $id)
    {
        $faq = $this->findOne($id);
        $data['updated_by'] = Auth::id();
        unset($data['files']);
        $faq->update($data);
        return Response('Faq has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteFaq($id)
    {
        $faq = $this->findOne($id);
        $faq->delete();
        return Response('Faq has been successfully deleted');
    }
}
