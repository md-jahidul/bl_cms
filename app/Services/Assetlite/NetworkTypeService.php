<?php

namespace App\Services\Assetlite;

use App\Http\Resources\NetworkTypeResource;
use App\Repositories\NetworkTypeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Exception;

/**
 * Class NetworkTypeService
 * @package App\Services
 */
class NetworkTypeService
{
    use CrudTrait;
    use FileTrait;
    /**
     * @var NetworkTypeRepository
     */
    protected $networkTypeRepository;


    /**
     * BannerService constructor.
     * @param NetworkTypeRepository $bannerRepository
     */
    public function __construct(NetworkTypeRepository $networkTypeRepository)
    {
        $this->networkTypeRepository = $networkTypeRepository;
        $this->setActionRepository($networkTypeRepository);
    }

    /**
     * Storing the slider resource
     * @return Response
     */
    public function storeNetworkType($data)
    {
        $networkTypes = $this->findAll();
        if (request()->hasFile('image_url')) {
            $data['image_url'] = $this->upload($data['image_url'], 'assetlite/images/network-types');
        }
        $data['display_order'] = $networkTypes->count() + 1;
        $this->save($data);
        return new Response('Network Types added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateNetworkType($data, $id)
    {
        $networkType = $this->findOne($id);

        if (request()->hasFile('image_url')) {
            $imageUrl = $this->upload($data['image_url'], 'assetlite/images/network-types');
            $data['image_url'] = $imageUrl;
            if(!empty($networkType->image_url)){
                $this->deleteFile($networkType->image_url);
            }
        }
        $networkType->update($data);
        return Response('Network Types updated successfully !');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($position)
    {
        $this->networkTypeRepository->sortData($position);
        return new Response('update successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteNetworkType($id)
    {
        $buinessType = $this->findOne($id);
        $buinessType->delete();
        return Response('Network Types deleted successfully !');
    }


}
