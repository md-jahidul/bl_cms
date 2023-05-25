<?php

namespace App\Services;

use App\Repositories\InternetGiftContentRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class InternetGiftContentService
{
    use CrudTrait;
    use FileTrait;

    protected $internetGiftContentRepository;

    public function __construct(InternetGiftContentRepository $internetGiftContentRepository)
    {
        $this->internetGiftContentRepository = $internetGiftContentRepository;
        $this->setActionRepository($internetGiftContentRepository);
    }

    public function getGiftContent()
    {
        return $this->internetGiftContentRepository->getGiftContent();
    }

    public function storeInternetGiftContent($giftContent)
    {
        try {
            DB::transaction(function () use ($giftContent) {
                $image_data = $this->internetGiftContentRepository->giftContent();
                $i = 1;
                if (!empty($image_data)) {
                    $i = $image_data->display_order + 1;
                }
                if (request()->hasFile('icon')) {
                    $giftContent['icon'] = 'storage/' . $giftContent['icon']->store('internet-gift-content');
                }
                if (request()->hasFile('banner')) {
                    $giftContent['banner'] = 'storage/' . $giftContent['banner']->store('internet-gift-content');
                }
                $giftContent['display_order'] = $i;
                $giftContent['slug'] = str_replace(" ", "_", strtolower($giftContent['name_en']));

                $giftContent = $this->save($giftContent);

            });
            Redis::del('internet-gift-contents');
            return true;

        } catch (\Exception $e) {
            Log::error('Internet Gift Content store failed' . $e->getMessage());
            return false;
        }
    }



    public function tableSortable($data)
    {
        $this->internetGiftContentRepository->internetGiftContentTableSort($data);
        Redis::del('internet-gift-contents');
        return new Response('Sequence has been successfully update');
    }

    public function updateInternetGiftContent($data, $id)
    {
        try {
            $giftContent = $this->findOne($id);
            DB::transaction(function () use ($data, $id, $giftContent) {
                if (request()->hasFile('icon')) {
                    $data['icon'] = 'storage/' . $data['icon']->store('internet-gift-content');
                    $this->deleteFile($giftContent->icon);
                }
                if (request()->hasFile('banner')) {
                    $data['banner'] = 'storage/' . $data['banner']->store('internet-gift-content');
                    $this->deleteFile($giftContent->banner);
                }
                // $data['slug'] = str_replace(" ", "-", strtolower($data['slug']));

                
                $giftContent->update($data);
            });
            Redis::del('internet-gift-contents');
            return true;
        } catch (\Exception $e) {
            Log::error('Content store failed' . $e->getMessage());
            return false;
        }
    }


    public function deleteInternetGiftCOntent($id)
    {
        $giftContent = $this->findOne($id);
        $giftContent->delete();

        if ($giftContent->icon) {
            $this->deleteFile($giftContent->icon);
        }
        if ($giftContent->banner) {
            $this->deleteFile($giftContent->banner);
        }

        $this->delSliderRedisCache();
        return Response('Content has been successfully deleted');
    }

    public function delSliderRedisCache($redisKey = 'internet-gift-contents')
    {
        Redis::del($redisKey);
    }
}
