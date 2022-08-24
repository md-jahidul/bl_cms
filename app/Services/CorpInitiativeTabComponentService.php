<?php

namespace App\Services;

//use App\Repositories\AppServiceProductegoryRepository;

use App\Repositories\CorpInitiativeTabComponentRepository;
use App\Repositories\CorpIntBatchComTabRepository;
use App\Repositories\CorpIntComponentMultiItemRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

use App\Repositories\ComponentRepository;
use Illuminate\Support\Facades\Auth;

class CorpInitiativeTabComponentService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var CorpInitiativeTabComponentRepository
     */
    private $tabComponentRepository;
    /**
     * @var CorpIntComponentMultiItemRepository
     */
    private $itemRepository;
    /**
     * @var CorpIntBatchComTabRepository
     */
    private $batchComTabRepository;

    /**
     * AppServiceProductService constructor.
     * @param CorpInitiativeTabComponentRepository $tabComponentRepository
     * @param CorpIntComponentMultiItemRepository $itemRepository
     * @param CorpIntBatchComTabRepository $batchComTabRepository
     */
    public function __construct(
        CorpInitiativeTabComponentRepository $tabComponentRepository,
        CorpIntComponentMultiItemRepository $itemRepository,
        CorpIntBatchComTabRepository $batchComTabRepository
    )
    {
        $this->tabComponentRepository = $tabComponentRepository;
        $this->itemRepository = $itemRepository;
        $this->batchComTabRepository = $batchComTabRepository;
        $this->setActionRepository($tabComponentRepository);
    }

    public function componentList($tabId)
    {
        return $this->tabComponentRepository->list($tabId);
    }

    public function findComponent($tabId)
    {
        return $this->tabComponentRepository->tabComponent($tabId);
    }

    public function componentStore($data, $tabId)
    {
        $directory = 'assetlite/images/corporate-responsibility/initiative';
        if (
            $data['component_type'] == "news_component" ||
            $data['component_type'] == "young_future" &&
            isset($data['single_base_image'])
        ) {
            $data['single_base_image'] = $this->upload($data['single_base_image'], $directory);
        }
        $results = [];
        if (isset($data['multi_item']) && !empty($data['multi_item'])) {
            $request_multi = $data['multi_item'];
            $item_count = isset($data['multi_item_count']) ? $data['multi_item_count'] : 0;
            for ($i = 1; $i <= $item_count; $i++) {
                foreach ($data['multi_item'] as $key => $value) {
//                    $sub_data = [];
                    $check_index = explode('-', $key);
                    if ($check_index[1] == $i) {
                        if (request()->hasFile('multi_item.' . $key)) {
                            $value = $this->upload($value, $directory);
                        }
                        // This section For Batch Component
                        if ($check_index[0] == "data") {
                            foreach ($value as $dataKey => $dataValue) {
                                foreach ($dataValue as $itemKey => $dataItem) {
                                    if (request()->hasFile("multi_item.$key.$dataKey.$itemKey")) {
                                        $dataItem = $this->upload($dataItem, $directory);
                                    }
                                    $value[$dataKey][$itemKey] = $dataItem;
                                }
                            }
                            $value = array_values($value);
                        }

                        $results[$i][$check_index[0]] = $value;
                    }
                }
            }
        }

        if (count($results) > 0) {
            $data['multiple_attributes'] = array_values($results);
        }

        $countComponents = $this->tabComponentRepository->list($tabId);
        $data['component_order'] = count($countComponents) + 1;
        $data['initiative_tab_id'] = $tabId;

//        $data['base_image'] = isset($data['single_base_image']) ? $data['single_base_image'] : '';
//        $data['alt_text_en'] = isset($data['single_alt_text_en']) ? $data['single_alt_text_en'] : '';
//        $data['alt_text_bn'] = isset($data['single_alt_text_bn']) ? $data['single_alt_text_bn'] : '';
//        $data['image_name_en'] = isset($data['single_image_name_en']) ? $data['single_image_name_en'] : '';
//        $data['image_name_bn'] = isset($data['single_image_name_bn']) ? $data['single_image_name_bn'] : '';
//        dd($data);
        $tabComponent = $this->save($data);
        if (
            $data['component_type'] != "batch_component" &&
            $data['component_type'] != "news_component" &&
            $data['component_type'] != "young_future"
            && isset($data['base_image'])
        ) {
            foreach ($data['base_image'] as $key => $img) {
                if (!empty($img)) {
                    $baseImgUrl = $this->upload($img, 'assetlite/images/corporate-responsibility/initiative');
                }
                $imgData = [
                    'corp_int_tab_com_id' => $tabComponent->id,
                    'title_en' => isset($data['multi_title_en'][$key]) ? $data['multi_title_en'][$key] : null,
                    'title_bn' => isset($data['multi_title_bn'][$key]) ? $data['multi_title_bn'][$key] : null,
                    'details_en' => isset($data['details_en'][$key]) ? $data['details_en'][$key] : null,
                    'details_bn' => isset($data['details_bn'][$key]) ? $data['details_bn'][$key] : null,
                    'alt_text_en' => $data['alt_text_en'][$key],
                    'alt_text_bn' => $data['multi_alt_text_bn'][$key],
                    'image_name_en' => str_replace(' ', '-', strtolower($data['img_name_en'][$key])),
                    'image_name_bn' => str_replace(' ', '-', strtolower($data['img_name_bn'][$key])),
                    'base_image' => $baseImgUrl,
                ];
                $this->itemRepository->save($imgData);
            }
        }

        if ($data['component_type'] == 'batch_component') {
            foreach ($data['batch'] as $tabKey => $batchTab) {
                $batchTab['corp_int_tab_com_id'] = $tabComponent->id;
                $batch = $this->batchComTabRepository->save($batchTab);
                foreach ($batchTab['items'] as $itemKey => $item) {
                    $directory = 'assetlite/images/corporate-responsibility/initiative/component';
                    if (!empty($item['image'])) {
                        $item['base_image'] = $this->upload($item['image'], $directory);
                    }
                    $item['corp_int_tab_com_id'] = $tabComponent->id;
                    $item['image_name_en'] = $item['img_name_en'];
                    $item['image_name_bn'] = $item['img_name_bn'];
                    $item['batch_com_id'] = $batch->id;
                    $this->itemRepository->save($item);
                }
            }
        }
        return response('Component create successfully!');
    }


    public function componentUpdate($data, $id)
    {
        $component = $this->findOne($id);
        $directory = 'assetlite/images/corporate-responsibility/initiative';
        if (
            $data['component_type'] == "batch_component" ||
            $data['component_type'] == "news_component" ||
            $data['component_type'] == "young_future" &&
            isset($data['single_base_image'])
        ) {
            $data['single_base_image'] = $this->upload($data['single_base_image'], $directory);
        }

        if ($data['component_type'] == 'batch_component') {
            foreach ($data['batch'] as $tabKey => $batchTab) {
                $batchId = isset($batchTab['batch_tab_id']) ? $batchTab['batch_tab_id'] : null;
                $batchTabData = $this->batchComTabRepository->findOne($batchId);
                if ($batchTabData) {
                    $batchTabData->update($batchTab);
                } else {
                    $batchTab['corp_int_tab_com_id'] = $id;
                    $newBatchId = $this->batchComTabRepository->save($batchTab);
                }

                foreach ($batchTab['items'] as $itemKey => $item) {
                    $itemId = isset($item['batch_tab_com_id']) ? $item['batch_tab_com_id'] : '';
                    $itemData = $this->itemRepository->findOne($itemId);
                    $directory = 'assetlite/images/corporate-responsibility/initiative/component';
                    if (!empty($item['image'])) {
                        $oldImg = isset($item['old_image']) ? $item['old_image'] : null;
                        $this->deleteFile($oldImg);
                        $item['base_image'] = $this->upload($item['image'], $directory);
                    }
                    $item['image_name_en'] = $item['img_name_en'];
                    $item['image_name_bn'] = $item['img_name_bn'];

                    if ($itemData) {
                        $itemData->update($item);
                    } else {
                        $item['corp_int_tab_com_id'] = $id;
                        $item['batch_com_id'] = isset($batchId) ? $batchId : $newBatchId->id;
                        $this->itemRepository->save($item);
                    }
                }
            }
        }

        // Multiple Image
        if (
            $data['component_type'] != "batch_component" &&
            $data['component_type'] != "news_component" &&
            $data['component_type'] != "young_future"
            && isset($data['base_image'])
        ) {
            $this->itemRepository->deleteAllById($id);
            foreach ($data['base_image'] as $key => $img) {
                if (is_object($img)) {
                    $oldImgPath = isset($data['old_img_url'][$key]) ? $data['old_img_url'][$key] : null;
                    $this->deleteFile($oldImgPath);
                    $img = $this->upload($img, $directory);
                }
                $imgData = [
                    'corp_int_tab_com_id' => $id,
                    'title_en' => isset($data['multi_title_en'][$key]) ? $data['multi_title_en'][$key] : null,
                    'title_bn' => isset($data['multi_title_bn'][$key]) ? $data['multi_title_bn'][$key] : null,
                    'details_en' => isset($data['details_en'][$key]) ? $data['details_en'][$key] : null,
                    'details_bn' => isset($data['details_bn'][$key]) ? $data['details_bn'][$key] : null,

                    'alt_text_en' => $data['alt_text_en'][$key],
                    'alt_text_bn' => $data['alt_text_bn'][$key],
                    'img_name_en' => str_replace(' ', '-', strtolower($data['img_name_en'][$key])),
                    'img_name_bn' => str_replace(' ', '-', strtolower($data['img_name_bn'][$key])),
                    'image_name_en' => $data['img_name_en'][$key],
                    'image_name_bn' => $data['img_name_bn'][$key],
                    'base_image' => $img,
                ];
                $this->itemRepository->save($imgData);
            }
        }


        // get original data
        $new_multiple_attributes = $component->multiple_attributes;
        //contains all the inputs from the form as an array
        $checkMultiAttr = isset($data['multiple_attributes']) ? $data['multiple_attributes'] : '';
        $input_multiple_attributes = isset($results) ? array_values($results) : $checkMultiAttr;

        //loop over the product array
        if ($input_multiple_attributes) {
            foreach ($input_multiple_attributes as $parentKey => $inputData) {
                // For Single Object
                $new_multiple_attributes[$parentKey] = $inputData;
            }
        }

        $data['multiple_attributes'] = $new_multiple_attributes;

        $component->update($data);
        return response("Component update successfully!!");
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($data)
    {
        $this->tabComponentRepository->componentTableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteComponent($id)
    {
        $component = $this->findOne($id);
        $component->delete();
        return Response('Component deleted successfully !');
    }
}
