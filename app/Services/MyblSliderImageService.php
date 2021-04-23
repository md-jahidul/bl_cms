<?php

namespace App\Services;

use App\Models\BaseImageCta;
use App\Models\MyBlProduct;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\SliderImageRepository;

class MyblSliderImageService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $sliderRepository
     */
    protected $sliderImageRepository;

    /**
     * AlSliderImageService constructor.
     * @param SliderImageRepository $sliderImageRepository
     */
    public function __construct(SliderImageRepository $sliderImageRepository)
    {
        $this->sliderImageRepository = $sliderImageRepository;
        $this->setActionRepository($sliderImageRepository);
    }


    public function itemList($sliderId, $type)
    {
        return $this->sliderImageRepository->getSliderImage($sliderId, $type);
    }


    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeSliderImage($image)
    {
        try {
            DB::transaction(function () use ($image) {
                $image_data = $this->sliderImageRepository->sliderImage($image['slider_id']);
                if (empty($image_data)) {
                    $i = 1;
                } else {
                    $i = $image_data->sequence + 1;
                }
                $image['image_url'] = 'storage/' . $image['image_url']->store('Slider_image');
                $image['sequence'] = $i;
                if (isset($image['other_attributes'])) {
                    $other_attributes = [
                        'type' => strtolower($image['redirect_url']),
                        'content' => $image['other_attributes']
                    ];
                    // $image['other_attributes'] = json_encode($other_attributes, JSON_UNESCAPED_SLASHES);
                    $image['other_attributes'] = $other_attributes;
                }
//                dd($image);
                $sliderImg = $this->save($image);
//                dd($image['segment_wise_cta']);
                foreach ($image['segment_wise_cta'] as $segmentCTA) {
                    $segmentCTA['banner_id'] = $sliderImg->id;
                    BaseImageCta::create($segmentCTA);
                }
            });
            return new Response("Image has been successfully added");
        } catch (\Exception $e) {
            Log::error('Slider Image store failed' . $e->getMessage());
            return $e->getMessage();
        }
    }

    public function getActiveProducts()
    {
        $builder = new MyBlProduct();
        $builder = $builder->where('status', 1);

        $products = $builder->whereHas(
            'details',
            function ($q) {
                $q->whereIn('content_type', ['data','voice','sms', 'mix']);
            }
        )->get();

        $data = [];

        foreach ($products as $product) {
            $data [] = [
                'id'    => $product->details->product_code,
                'text' =>  $product->details->product_code . ' - (' . strtoupper($product->details->content_type) . ') ' . $product->details->commercial_name_en
            ];
        }

        return $data;
    }

    public function tableSortable($data)
    {
        $this->sliderImageRepository->sliderImageTableSort($data);
        return new Response('Sequence has been successfully update');
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateSliderImage($data, $id)
    {
        try {
            $sliderImage = $this->findOne($id);
            DB::transaction(function () use ($data, $id, $sliderImage) {
                if (isset($data['image_url'])) {
                    $data['image_url'] = 'storage/' . $data['image_url']->store('Slider_image');
                    $this->deleteFile($sliderImage->image_url);
                }
                if (isset($data['other_attributes'])) {
                    $other_attributes = [
                        'type' => strtolower($data['redirect_url']),
                        'content' => $data['other_attributes']
                    ];
                    $data['other_attributes'] = $other_attributes;
                }

                $sliderImage->update($data);

//                dd($image['segment_wise_cta']);
                BaseImageCta::where('banner_id', $id)->delete();

                foreach ($data['segment_wise_cta'] as $segmentCTA) {
                    $segmentCTA['banner_id'] = $id;
                    BaseImageCta::create($segmentCTA);
                }
            });
            return response("Image has has been successfully updated");
        } catch (\Exception $e) {
            Log::error('Slider Image store failed' . $e->getMessage());
            return \response($e->getMessage(), 500);
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteSliderImage($id)
    {
        $sliderImage = $this->findOne($id);
        $sliderImage->delete();
        return Response('Image has been successfully deleted');
    }
}
