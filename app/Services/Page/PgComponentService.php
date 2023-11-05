<?php

namespace App\Services\Page;

use App\Models\Page\NewPageComponentData;
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
        dd($data);
        DB::transaction(function () use ($data, $id) {
            $components = $this->componentRepository->findAll();

            if (isset($data["attribute"]['image_file'])) {
                $imgUrl = $this->fileUpload($data["attribute"]['image_file']);
                $data["attribute"]['image']['en'] = $imgUrl;
                $data["attribute"]['image']['bn'] = $imgUrl;
            }

            if ($id && !isset($data["attribute"]['image_file'])) {
                $component = $this->findOne($id);
                $data["attribute"]['image']['en'] = $component['attribute']['image']['en'] ?? null;
                $data["attribute"]['image']['bn'] = $component['attribute']['image']['en'] ?? null;
            }

            $componentData = [
                'page_id' => $data['pageId'],
                'name' => strtoupper(str_replace('_', ' ', $data["component_type"])),
                'type' => $data["component_type"],
                'attribute' => $data["attribute"] ?? null,
                'status' => $data['status']
            ];

            if (!$id) {
                $componentData['order'] = $components->count() + 1;
            }
            $componentInfo = $this->componentRepository->createOrUpdate($componentData, $id);
            unset($data['image_file']);
            $componentId = $componentInfo->id;

            if (isset($data['componentData'])){
                foreach (array_values($data['componentData']) as $index => $item) {
                    $tabParentId = 0;
                    foreach ($item as $key => $field) {
                        $valueEn = $field['value_en'] ?? null;
                        $itemEn = is_object($valueEn) ? $this->fileUpload($valueEn) : $valueEn;

                        if ($key != "content" && $key != "is_static_component" && $key != "component_name") {
                            $componentDataInfo = [
                                'id' => $field['id'] ?? null,
                                'component_id' => $componentId,
                                'parent_id' => 0,
                                'key' => $key,
                                'value_en' => $itemEn,
                                'value_bn' => isset($field['value_bn']) && $field['value_bn'] != null ? $field['value_bn'] : $itemEn,
                                'group' => $index + 1,
                            ];
//                            dd($componentDataInfo);
                            $componentDataSave = $this->componentDataRepository->createOrUpdate($componentDataInfo);
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
                                        'group' => $index + 1,
                                    ];
                                    $this->componentDataRepository->save($tabItemData);
                                }
                            }
                        }
                    }
                }
            }
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
            foreach ($data['position'] as $item){
                $comId = $item[0];
                $comPosition = $item[1];
                $pageComponent = $this->componentRepository->findOne($comId);
                $pageComponent->order = $comPosition;
                $pageComponent->update();
            }
        }
    }

    public function deleteDataItem($data)
    {
        $componentData = $this->componentDataRepository->findBy(['component_id' => $data['data-com-id'], 'group' => $data['data-group']]);
        foreach ($componentData as $item) {
            if ($item->key == "image" || $item->key == "image_hover") {
                $this->deleteFile($item->value_en);
            }
            $item->delete();
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
