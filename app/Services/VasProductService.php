<?php

namespace App\Services;

use App\Repositories\VasProductRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use App\Traits\RedisTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class VasProductService
{
    use CrudTrait;
    use FileTrait;
    use RedisTrait;

    protected const VAS_PRODUCT_REDIS_KEY = 'vas-product';
    protected $vasProductRepository;
    public function __construct(VasProductRepository $vasProductRepository)
    {
        $this->vasProductRepository = $vasProductRepository;
        $this->setActionRepository($vasProductRepository);
    }

    public function getVasProducts()
    {
        return $this->vasProductRepository->findAll(null,null, ['column'=> 'created_at', 'direction' => 'desc']);
    }

    public function storeVasProducts($request)
    {
        try {
            DB::transaction(function () use ($request) {

                if (request()->hasFile('image')) {
                    $request['image'] = 'storage/' . $request['image']->storeAs('vas-product', time() . '-' . bin2hex(random_bytes(4)) . '-' . $request['image']->getClientOriginalName());
                }
                $this->save($request);

            });
            //$this->redisDel(self::VAS_PRODUCT_REDIS_KEY);
            return true;

        } catch (\Exception $e) {
            Log::error('VAS Product store failed' . $e->getMessage());
            return false;
        }
    }

    public function updateVasProduct($data, $id)
    {
        try {
            $vasProduct = $this->findOne($id);
            DB::transaction(function () use ($data, $id, $vasProduct) {
                if (request()->hasFile('image')) {
                    $data['image'] = 'storage/' . $data['image']->storeAs('vas-product', time() . '-' . bin2hex(random_bytes(4)) . '-' . $data['image']->getClientOriginalName());
                    $this->deleteFile($vasProduct->image);
                }
                $vasProduct->update($data);
            });

            //$this->redisDel(self::VAS_PRODUCT_REDIS_KEY);
            return true;
        } catch (\Exception $e) {
            Log::error('VAS Product Update failed' . $e->getMessage());
            return false;
        }
    }

    public function deleteVasProduct($id)
    {
        $vasProduct = $this->findOne($id);
        $vasProduct->delete();

        if ($vasProduct->image) {
            $this->deleteFile($vasProduct->image);
        }

        //$this->redisDel(self::VAS_PRODUCT_REDIS_KEY);
        return Response('VAS Product has been successfully deleted');
    }
}
