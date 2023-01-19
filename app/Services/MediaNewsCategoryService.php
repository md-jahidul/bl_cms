<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\MediaNewsCategoryRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MediaNewsCategoryService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $sliderRepository
     */
    protected $mediaNewsCategoryRepository;

    /**
     * DigitalServicesService constructor.
     * @param MediaNewsCategoryRepository $mediaNewsCategoryRepository
     */
    public function __construct(MediaNewsCategoryRepository $mediaNewsCategoryRepository)
    {
        $this->mediaNewsCategoryRepository = $mediaNewsCategoryRepository;
        $this->setActionRepository($mediaNewsCategoryRepository);
    }

    // /**
    //  * Storing the alFaq resource
    //  * @param $data
    //  * @return Response
    //  */
    // public function storePNE($data, $referenceType = null)
    // {
    //     // $originalDate = "2010-03-21";
    //     // $newDate = date("d-m-Y", strtotime($originalDate));
    //     // $from = "2020-05-21";
    //     // $to = "2020-07-30";

    //     $dirPath = 'assetlite/images/media';
    //     if (request()->hasFile('thumbnail_image')) {
    //         $data['thumbnail_image'] = $this->upload($data['thumbnail_image'], $dirPath);
    //     }
    //     if (request()->hasFile('details_image')) {
    //         $data['details_image'] = $this->upload($data['details_image'], $dirPath);
    //     }
    //     unset($data['file']);
    //     $data['created_by'] = Auth::id();
    //     $data['reference_type'] = $referenceType;
    //     $this->save($data);
    //     return new Response("Item has been successfully created");
    // }

    // /**
    //  * Updating the banner
    //  * @param $data
    //  * @return Response
    //  */
    // public function updatePNE($data, $id)
    // {
    //     $mediaPNE = $this->findOne($id);

    //     $dirPath = 'assetlite/images/media';
    //     if (request()->hasFile('thumbnail_image')) {
    //         $data['thumbnail_image'] = $this->upload($data['thumbnail_image'], $dirPath);
    //         $this->deleteFile($mediaPNE->thumbnail_image);
    //     }
    //     if (request()->hasFile('details_image')) {
    //         $data['details_image'] = $this->upload($data['details_image'], $dirPath);
    //     }

    //     unset($data['files']);
    //     $data['show_in_home'] = (isset($data['show_in_home'])) ? 1 : 0;
    //     $data['updated_by'] = Auth::id();
    //     $mediaPNE->update($data);
    //     return Response('Update successfully!');
    // }

    // public function findByReferenceType($referenceType)
    // {
    //     return $this->mediaNewsCategoryRepository->findByProperties(['reference_type' => $referenceType]);
    // }

    // /**
    //  * @param $id
    //  * @return ResponseFactory|Response
    //  * @throws \Exception
    //  */
    // public function deletePNE($id)
    // {
    //     $mediaPNE = $this->findOne($id);
    //     $this->deleteFile($mediaPNE->thumbnail_image);
    //     $mediaPNE->delete();
    //     return Response('Item has been successfully deleted');
    // }
}
