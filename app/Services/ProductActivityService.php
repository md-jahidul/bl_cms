<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Models\ProductActivity;
use App\Repositories\AboutPageRepository;
use App\Repositories\PrizeRepository;
use App\Repositories\ProductActivityRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductActivityService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $prizeService
     */
    protected $aboutPageRepository;
    /**
     * @var ProductActivityRepository
     */
    private $productActivityRepository;

    /**
     * AboutPageService constructor.
     * @param ProductActivityRepository $productActivityRepository
     */
    public function __construct(ProductActivityRepository $productActivityRepository)
    {
        $this->productActivityRepository = $productActivityRepository;
        $this->setActionRepository($productActivityRepository);
    }

    public function getAll()
    {
        return new ProductActivity();
    }

    /**
     * @param Builder $itemBuilder
     * @param Request $request
     * @return array
     */
    public function prepareDataForDatatable(Builder $itemBuilder, Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $all_items_count = $itemBuilder->count();
        $items = $itemBuilder->with('user')->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'user' => $item->user->name,
                'product_code' => $item->product_code,
                'activity_type' => $item->activity_type,
                'created_at' => $item->created_at
            ];
        });

        return $response;
    }
}
