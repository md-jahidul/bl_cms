<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services\BlLab;

use App\Repositories\BlLab\BlLabProgramRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class BlLabProgramService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var BlLabProgramRepository
     */
    private $applyingForRepository;

    /**
     * BlLabProgramService constructor.
     * @param BlLabProgramRepository $applyingForRepository
     */
    public function __construct(BlLabProgramRepository $applyingForRepository)
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
        if (request()->hasFile('icon')) {
            $data['icon'] = $this->upload($data['icon'],'assetlite/images/bl-lab');
        }

        $data['display_order'] = $this->findAll()->count() + 1;
        $data['slug'] = str_replace(" ", "_", strtolower($data['name_en']));

        dd($data['icon']);
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
