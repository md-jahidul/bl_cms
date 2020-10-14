<?php

namespace App\Services;

//use App\Repositories\AppServiceProductegoryRepository;

use App\Repositories\CorpInitiativeTabComponentRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

use App\Repositories\ComponentRepository;

class CorpInitiativeTabComponentService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var CorpInitiativeTabComponentRepository
     */
    private $tabComponentRepository;

    /**
     * AppServiceProductService constructor.
     * @param CorpInitiativeTabComponentRepository $tabComponentRepository
     */
    public function __construct(CorpInitiativeTabComponentRepository $tabComponentRepository)
    {
        $this->tabComponentRepository = $tabComponentRepository;
        $this->setActionRepository($tabComponentRepository);
    }

    public function componentList($tabId)
    {
        return $this->tabComponentRepository->list($tabId);
    }


    public function componentStore($data, $tabId)
    {
        $directory = 'assetlite/images/corporate-responsibility/initiative';
        if (!empty($data['multiple_attributes']['image'])) {
            $data['multiple_attributes']['image'] = $this->upload($data['multiple_attributes']['image'], $directory);
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
        $this->save($data);
        return response('Component create successfully!');
    }


    public function componentUpdate($data, $id)
    {
        $component = $this->findOne($id);
        $directory = 'assetlite/images/corporate-responsibility/initiative';
        if (!empty($data['multiple_attributes']['image'])) {
            $data['multiple_attributes']['image'] = $this->upload($data['multiple_attributes']['image'], $directory);
            $filePath = isset($component->multiple_attributes['image']) ? $component->multiple_attributes['image'] : null;
            $this->deleteFile($filePath);
        }

        if (isset($data['multi_item']) && !empty($data['multi_item'])) {
            $request_multi = $data['multi_item'];
            $item_count = isset($data['multi_item_count']) ? $data['multi_item_count'] : 0;
            for ($i = 1; $i <= $item_count; $i++) {
                foreach ($data['multi_item'] as $key => $value) {
                    $sub_data = [];
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

        // get original data
        $new_multiple_attributes = $component->multiple_attributes;

        //contains all the inputs from the form as an array
        $input_multiple_attributes = isset($results) ? array_values($results) : $data['multiple_attributes'];

        //loop over the product array
        if ($input_multiple_attributes) {
            foreach ($input_multiple_attributes as $parentKey => $inputData) {
                // For Multiple Object
                if (is_array($inputData)) {
                    foreach ($inputData as $key => $value) {
                        // For Batch Component
                        if ($key == "data") {
                            foreach ($value as $dataKey => $dataItem) {
                                foreach ($dataItem as $dataSubKey => $dataSub) {
                                    $new_multiple_attributes[$parentKey][$key][$dataKey][$dataSubKey] = $dataSub;
                                }
                            }
                        } else {
                            // set the new value
                            $new_multiple_attributes[$parentKey][$key] = $value;
                        }
                    }
                } else {
                    // For Single Object
                    $new_multiple_attributes[$parentKey] = $inputData;
                }
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
