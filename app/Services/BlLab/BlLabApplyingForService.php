<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services\BlLab;

use App\Repositories\BlLab\BlLabApplyingForRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class BlLabApplyingForService
{
    use CrudTrait;

    /**
     * @var BlLabApplyingForRepository
     */
    private $applyingForRepository;

    /**
     * BlLabApplyingForService constructor.
     * @param BlLabApplyingForRepository $applyingForRepository
     */
    public function __construct(BlLabApplyingForRepository $applyingForRepository)
    {
        $this->applyingForRepository = $applyingForRepository;
        $this->setActionRepository($applyingForRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function store($data)
    {
        $data['alias'] = str_replace(" ", "_", strtolower($data['name_en']));
        $this->save($data);
        return new Response('Added successfully');
    }

    /**
     * Updating the
     * @param $data
     * @return Response
     */
    public function update($data, $id)
    {
        $item = $this->findOne($id);
        $data['alias'] = str_replace(" ", "_", strtolower($data['name_en']));
        $item->update($data);
        return Response('Updated successfully');
    }


    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function delete($id)
    {
        $item = $this->findOne($id);
        $item->delete();
        return Response('Deleted successfully !');
    }
}
