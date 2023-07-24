<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services\BlLab;

use App\Repositories\BlLab\BlLabIndustryRepository;
use App\Repositories\BlLab\BlLabProfessionRepository;
use App\Repositories\BlLab\BlLabProgramRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class BlLabProfessionService
{
    use CrudTrait;

    /**
     * @var BlLabProfessionRepository
     */
    private $blLabProfessionRepository;

    /**
     * BlLabProfessionService constructor.
     * @param BlLabProfessionRepository $blLabProfessionRepository
     */
    public function __construct(BlLabProfessionRepository $blLabProfessionRepository)
    {
        $this->blLabProfessionRepository = $blLabProfessionRepository;
        $this->setActionRepository($blLabProfessionRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function store($data)
    {
        $data['slug'] = str_replace(" ", "_", strtolower($data['name_en']));
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
