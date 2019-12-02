<?php

namespace App\Services;

use App\Repositories\PriyojonRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class PriyojonService
{
    use CrudTrait;

    /**
     * @var $priyojonRepository
     */
    protected $priyojonRepository;

    /**
     * PriyojonService constructor.
     * @param PriyojonRepository $priyojonRepository
     */
    public function __construct(PriyojonRepository $priyojonRepository)
    {
        $this->priyojonRepository = $priyojonRepository;
        $this->setActionRepository($priyojonRepository);
    }

    /**
     * @param $parent_id
     * @return mixed
     */
    public function priyojonList($parent_id)
    {
        return $this->priyojonRepository->getChildPriyojons($parent_id);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storePriyojon($data)
    {
        $priyojon_count = count($this->priyojonRepository->getChildPriyojons($data['parent_id']));
        $data['display_order'] = ++$priyojon_count;
        $this->save($data);
        return new Response('Priyojon added successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSort($data)
    {
        $this->priyojonRepository->priyojonTableSort($data);
        return new Response('Footer priyojon landing added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updatePriyojon($data, $id)
    {
        $priyojon = $this->findOne($id);
        $priyojon->update($data);
        return Response('Priyojon updated successfully');
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function deletePriyojon($id)
    {
        $priyojon = $this->findOne($id);
        $priyojon->delete();

        return [
            'message' => 'Priyojon delete successfully',
            'parent_id' => $priyojon->parent_id
        ];
    }
}
