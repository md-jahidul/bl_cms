<?php

namespace App\Services;

use App\Enums\GlobalSettingConst;
use App\Repositories\GlobalSettingRepository;
use App\Repositories\MyBlSpecialTypeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use App\Traits\RedisTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;


class MyBlSpecialTypeService
{
    use CrudTrait;
    use FileTrait;
    use RedisTrait;

    protected $productSpecialTypeRepository;
    protected $globalSettingsRepository;

    public function __construct(MyBlSpecialTypeRepository $productSpecialTypeRepository, GlobalSettingRepository $globalSettingsRepository)
    {
        $this->globalSettingsRepository = $globalSettingsRepository;
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
                    $specialType['icon'] = 'storage/' . $specialType['icon']->storeAs('product-special-type', time() . '-' . bin2hex(random_bytes(4)) . '-' . $specialType['icon']->getClientOriginalName());
                }
                $specialType['display_order'] = $i;
                $specialType['slug'] = str_replace(" ", "_", strtolower($specialType['name_en']));

                $specialType = $this->save($specialType);

            });
            $this->insertIntoGlobalSettings();
            $this->delGlobalSettingCache();
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
                    $data['icon'] = 'storage/' . $data['icon']->storeAs('product-special-type', time() . '-' . bin2hex(random_bytes(4)) . '-' . $data['icon']->getClientOriginalName());
                    $this->deleteFile($productSpecialType->icon);

                }
                $productSpecialType->update($data);
            });

            $this->insertIntoGlobalSettings();
            Redis::del('product-special-types');
            $this->delGlobalSettingCache();

            return true;
        } catch (\Exception $e) {
            Log::error('Product Special Type store failed' . $e->getMessage());
            return false;
        }
    }

    public function insertIntoGlobalSettings()
    {
        $this->globalSettingsRepository->delEntryBySettingsKey('special_types');
        $special_types = $this->productSpecialTypeRepository->findByProperties(['status' => 1], ['name_en',
            'name_bn',
            'slug',
            'icon']);
        $data['settings_value'] = json_encode($special_types, true);
        $data['settings_key'] = 'special_types';
        $data['value_type'] = 'json';
        $data['updated_by'] = Auth::id();
        $this->globalSettingsRepository->create($data);
        $this->delGlobalSettingCache();

    }

    /**
     * @throws \Exception
     */
    public function deleteProductSpecialType($id)
    {
        $productSpecialType = $this->findOne($id);
        $productSpecialType->delete();

        if ($productSpecialType->icon) {
            $this->deleteFile($productSpecialType->icon);
        }

        $this->delSliderRedisCache();
        $this->insertIntoGlobalSettings();
        $this->delGlobalSettingCache();

        return Response('Product Special Type has been successfully deleted');
    }

    public function delSliderRedisCache($redisKey = 'product-special-types')
    {
        Redis::del($redisKey);
    }

    public function delGlobalSettingCache($redisKey = 'product-special-types')
    {
        $this->redisDel(GlobalSettingConst::SETTINGS_REDIS_KEY);
    }
}
