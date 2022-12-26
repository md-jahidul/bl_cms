<?php
namespace App\Services;

use App\Models\AlBanner;
use App\Repositories\AlBannerRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;


class AlBannerService
{
    use CrudTrait;
    use FileTrait;
    
    protected $alBannerRepository;

    public function __construct(AlBannerRepository $alBannerRepository)
    {
        $this->alBannerRepository = $alBannerRepository;
        $this->setActionRepository($alBannerRepository);
    }


    public function findBanner($section_type , $section_id)
    {
        return $banner = $this->alBannerRepository->findFirstBanner(['section_type' => $section_type, 'section_id' => $section_id]);

        if ($banner) {
            $banner['other_attributes'] = json_decode($banner['other_attributes']);
            
        } 
        return $banner;

    }

    public function alBannerStore($data)
    {
        if (request()->hasFile('image')) {

            $data['image'] = $this->upload($data['image'], 'assetlite/images/al_banners');
            
        }

        # other attributes to save
        if (!empty($data['other_attributes']) && count($data['other_attributes']) > 0) {
            $data['other_attributes'] = json_encode($data['other_attributes']);
        }

        $this->save($data);
        return response('Banner created successfully!');
    }


    public function alBannerUpdate($data, $id)
    {
        $banner = $this->findOne($id);
        if (request()->hasFile('image')) {

            $data['image'] = $this->upload($data['image'], 'assetlite/images/al_banners'); 
            $this->deleteFile($banner->image);
        }

        # other attributes to save
        if (!empty($data['other_attributes']) && count($data['other_attributes']) > 0) {
            $data['other_attributes'] = json_encode($data['other_attributes']);
        }

        $banner->update($data);
        return response("Banner update successfully!!");
    }



}
