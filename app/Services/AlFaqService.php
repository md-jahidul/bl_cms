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
use Illuminate\Contracts\Routing\ResponseFactory;
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

    public function getFaqs($slug)
    {
        // return $this->alFaqRepository->findByProperties(['slug' => $slug]);
        $orderBy = ['column' => 'display_order', 'direction' => 'asc'];
        return $this->alFaqRepository->findBy(['slug' => $slug],'',$orderBy);
    }

    /**
     * Storing the alFaq resource
     * @param $data
     * @param $slug
     * @return Response
     */
    public function storeAlFaq($data, $slug)
    {
        $data['created_by'] = Auth::id();
        $data['slug'] = $slug;
        unset($data['files']);

        $countFaqs = $this->alFaqRepository->findAll();
        $data['display_order'] = count($countFaqs) + 1;
        
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
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteFaq($id)
    {
        $faq = $this->findOne($id);
        $faq->delete();
        return Response('Faq has been successfully deleted');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($data)
    {
        // return new Response($data['position']);
        
        $this->alFaqRepository->faqTableSort($data);
        return new Response('update successfully');
    }
}
