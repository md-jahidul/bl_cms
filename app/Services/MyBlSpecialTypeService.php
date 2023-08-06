<?php

namespace App\Services;

use App\Repositories\MyBlSpecialTypeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class MyBlSpecialTypeService
{
    use CrudTrait;
    use FileTrait;

    protected $productSpecialTypeRepository;

    public function __construct(MyBlSpecialTypeRepository $productSpecialTypeRepository)
    {
        $this->productSpecialTypeRepository = $productSpecialTypeRepository;
        $this->setActionRepository($productSpecialTypeRepository);
    }

    public function getProductSpecialTypes()
    {
        return $this->productSpecialTypeRepository->findAll();
    }

    public function storeProductSpecialType($specialType)
    {
        try {
            DB::transaction(function () use ($specialType) {
                $specual_type_data = $this->productSpecialTypeRepository->productSpecialType();
                $i = 1;
                if (!empty($specual_type_data)) {
                    $i = $specual_type_data->display_order + 1;
                }

                if (request()->hasFile('icon')) {
                    $specialType['icon'] = 'storage/' . $specialType['icon']->storeAs('product-special-type', time().'-'.bin2hex(random_bytes(4)).'-'.$specialType['icon']->getClientOriginalName());
                }
                $specialType['display_order'] = $i;
                $specialType['slug'] = str_replace(" ", "_", strtolower($specialType['name_en']));

                $specialType = $this->save($specialType);

            });
            Redis::del('product-special-types');
            return true;

        } catch (\Exception $e) {
            Log::error('Product Special Type store failed' . $e->getMessage());
            return false;
        }
    }



    public function tableSortable($data)
    {
        $this->productSpecialTypeRepository->productSpecialTypeTableSort($data);
        Redis::del('product-special-types');
        return new Response('Sequence has been successfully update');
    }

    public function updateProductSpecialType($data, $id)
    {
        try {
            $productSpecialType = $this->findOne($id);
            DB::transaction(function () use ($data, $id, $productSpecialType) {
                if (request()->hasFile('icon')) {
                    $data['icon'] = 'storage/' . $data['icon']->storeAs('product-special-type', time().'-'.bin2hex(random_bytes(4)).'-'.$data['icon']->getClientOriginalName());
                    $this->deleteFile($productSpecialType->icon);

                }
                
                $productSpecialType->update($data);
            });
            Redis::del('product-special-types');
            return true;
        } catch (\Exception $e) {
            Log::error('Product Special Type store failed' . $e->getMessage());
            return false;
        }
    }


    public function deleteProductSpecialType($id)
    {
        $productSpecialType = $this->findOne($id);
        $productSpecialType->delete();

        if ($productSpecialType->icon) {
            $this->deleteFile($productSpecialType->icon);
        }

        $this->delSliderRedisCache();
        return Response('Product Special Type has been successfully deleted');
    }

    public function delSliderRedisCache($redisKey = 'product-special-types')
    {
        Redis::del($redisKey);
    }
}
