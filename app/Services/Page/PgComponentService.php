<?php

namespace App\Services\Page;

use App\Repositories\Page\PageRepository;
use App\Repositories\Page\PgComponentDataRepository;
use App\Repositories\Page\PgComponentRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;

class PgComponentService
{
    use CrudTrait;
    use FileTrait;
    private $pageRepository;
    private $componentRepository;
    private $componentDataRepository;

    /**
     * PageService constructor.
     * @param PageRepository $pageRepository
     */
    public function __construct(
        PageRepository $pageRepository,
        PgComponentRepository $componentRepository,
        PgComponentDataRepository $componentDataRepository
    ) {

        $this->componentRepository = $componentRepository;
        $this->pageRepository = $pageRepository;
        $this->componentDataRepository = $componentDataRepository;
        $this->setActionRepository($componentRepository);
    }

    public function storeUpdatePageComponent($data, $id = null)
    {
//        dd($data);
        DB::transaction(function () use ($data, $id) {
            if ($id) {
                if (isset($data['removedImages'])) {
                    $oldImgArray = explode(',', $data['removedImages']);
                    foreach ($oldImgArray as $item){
                        if (!empty($item)){
                            $this->deleteFile($item);
                        }
                    }
                }
                $this->componentDataRepository->deleteComponentData($id);
                $componentId = $id;
            } else {
                $components = $this->componentRepository->findAll();
                $componentData = [
                    'page_id' => $data['pageId'],
                    'name' => strtoupper(str_replace('_', ' ', $data["component_type"])),
                    'type' => $data["component_type"],
                    'attribute' => $data["attribute"],
                    'status' => $data['status'],
                    'order' => $components->count() + 1
                ];

                $componentInfo = $this->save($componentData);
                $componentId = $componentInfo->id;
            }

//            $componentDataInfo = [];
            foreach ($data['componentData'] as $index => $item) {
                $tabParentId = 0;
                foreach ($item as $key => $field) {
                    $valueEn = $field['value_en'] ?? null;
                    if ($key != "content" && $key != "is_static_component" && $key != "component_name") {
                        $componentDataInfo = [
                            'component_id' => $componentId,
                            'parent_id' => 0,
                            'key' => $key,
                            'value_en' => is_object($valueEn) ? $this->fileUpload($valueEn) : $valueEn,
                            'value_bn' => $field['value_bn'] ?? null,
                            'group' => (int) $field['group'] ?? 0,
                        ];
                        $componentDataSave = $this->componentDataRepository->save($componentDataInfo);
                    }

                    if (isset($field['is_tab'])) {
                        $tabParentId = $componentDataSave->id ?? 0;
                    }

                    if ($key == "is_static_component" || $key == "component_name") {
                        $componentDataInfo = [
                            'component_id' => $componentId,
                            'parent_id' => $tabParentId,
                            'key' => $key,
                            'value_en' => is_object($valueEn) ? $this->fileUpload($valueEn) : $valueEn,
                            'value_bn' => $field['value_bn'] ?? null,
                            'group' => $field['group'] ?? 0,
                        ];
                        $componentDataSave = $this->componentDataRepository->save($componentDataInfo);
                    }

                    if ($key == "content") {
                        foreach ($field as  $tabItems) {
                            foreach ($tabItems as $tabItemKey => $tabItem) {
                                $valueEn = $tabItem['value_en'] ?? null;
                                $tabItemData = [
                                    'component_id' => $componentId,
                                    'parent_id' => $tabParentId,
                                    'key' => $tabItemKey,
                                    'value_en' => is_object($valueEn) ? $this->fileUpload($valueEn) : $valueEn,
                                    'value_bn' => $tabItem['value_bn'] ?? null,
                                    'group' => $tabItem['group'] ?? 0,
                                ];
                                $this->componentDataRepository->save($tabItemData);
                            }
                        }
                    }
                }

            }

//            dd($data);
//            dd($data, $componentDataInfo);
//            return $this->componentDataRepository->saveMany($componentDataInfo);
        });
    }

    public function fileUpload($file)
    {
        if (is_object($file)){
            return $this->upload($file, 'images/page-component', '');
        }
        return null;
    }

    public function saveSortedData($data)
    {
        if (!empty($data)) {
            foreach ($data as $item){
                $pageComponent = $this->componentRepository->findOne($item['id']);
                $pageComponent->order = $item['position'];
                $pageComponent->update();
            }
        }
    }

    public function destroy($id)
    {
        $pageComponent = $this->findOne($id,['componentData' => function ($q){
            $q->where('key', 'image');
        }]);

        // Delete Component Images
        if (!empty($pageComponent->componentData)) {
            foreach ($pageComponent->componentData as $item){
                $this->deleteFile($item->value_en);
            }
        }
        $pageComponent->delete();
    }
}
