<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class PrizeService
{

    use CrudTrait;

    /**
     * @var $prizeService
     */
    protected $prizeService;

    /**
     * PrizeService constructor.
     * @param PrizeRepository $prizeRepository
     */
    public function __construct(PrizeRepository $prizeRepository)
    {
        $this->prizeService = $prizeRepository;
        $this->setActionRepository($prizeRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storePrize($data)
    {
        $this->save($data);
        return new Response('Prize added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updatePrize($data, $id)
    {
        $prize = $this->findOne($id);
        $prize->update($data);
        return Response('Prize updated successfully');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deletePrize($id)
    {
        $prize = $this->findOne($id);
        $prize->delete();
        return Response('Prize deleted successfully !');
    }
}
