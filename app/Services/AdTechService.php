<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services;

use App\Repositories\AdTechRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdTechService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var AdTechRepository
     */
    private $adTechRepository;

    /**
     * AdTechService constructor.
     * @param AdTechRepository $adTechRepository
     */
    public function __construct(AdTechRepository $adTechRepository)
    {
        $this->adTechRepository = $adTechRepository;
        $this->setActionRepository($adTechRepository);
    }

    public function getAdTechByRefType($referenceType, $referenceId = null)
    {
        return $this->adTechRepository->findOneByProperties(['reference_type' => $referenceType, 'reference_id' => $referenceId]);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeAdTech($data, $referenceType, $referenceId = null)
    {
        $adTech = $this->adTechRepository->findOneByProperties(['reference_type' => $referenceType, 'reference_id' => $referenceId]);

        if (request()->hasFile('img_url')) {
            isset($adTech->img_url) ?? $this->deleteFile($adTech->img_url);
            $data['img_url'] = $this->upload($data['img_url'], 'assetlite/images/ad-tech');
        }

        $data['is_external_url'] = isset($data['is_external_url']) ? 1 : 0;
        $data['reference_type'] = $referenceType;
        if (isset($adTech)){
            $adTech->update($data);
        } else {
            $this->save($data);
        }

        return new Response('Ad Tech banner added successfully');
    }

}
