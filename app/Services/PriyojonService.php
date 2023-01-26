<?php

namespace App\Services;

use App\Repositories\PriyojonRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class PriyojonService
{
    use CrudTrait;
    use FileTrait;

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
//        $data['parent_id'] = $data['parent_id'];

//        dd($data);
        $this->save($data);
        return new Response('Priyojon menu added successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSort($data)
    {
        $this->priyojonRepository->priyojonTableSort($data);
        return new Response('Priyojon landing added successfully');
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

    public function bannerUpload($data, $id)
    {
        $priyojonData = $this->findOne($id);

//        dd($priyojonData);

        $dirPath = 'assetlite/images/banner/priyojon';
        if (request()->has('banner_image_url')) {
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], $dirPath);
        }
        if (request()->has('banner_mobile_view')) {
            $data['banner_mobile_view'] = $this->upload($data['banner_mobile_view'], $dirPath);
        }

        if (!request()->has('is_images')) {
            $data['is_images'] = 0;
            $data['banner_image_url'] = null;
        }
        
        $priyojonData->update($data);
        return Response('Priyojon updated successfully');
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function deleteMenu($id)
    {
        $priyojon = $this->findOne($id);
        $priyojon->delete();
        return Response('Priyojon delete successfully');
    }
}
