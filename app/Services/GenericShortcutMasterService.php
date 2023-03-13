<?php

namespace App\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use App\Repositories\GenericShortcutMasterRepository;
use App\Services\MyblHomeComponentService;
use App\Services\ContentComponentService;

class GenericShortcutMasterService
{
    use CrudTrait;

    /**
     * @var GenericShortcutMasterRepository
     * @var MyblHomeComponentService
     * @var ContentComponentService
     */

    protected $genericShortcutMasterRepository;
    protected $myBlHomeComponentService;
    protected $contentComponentService;

    /**
     * @param GenericShortcutMasterRepository $genericShortcutMasterRepository
     * @param MyblHomeComponentService $myBlHomeComponentService
     * @param ContentComponentService $contentComponentService
     */
    public function __construct(
        GenericShortcutMasterRepository $genericShortcutMasterRepository,
        MyblHomeComponentService $myBlHomeComponentService,
        ContentComponentService $contentComponentService
    ) {
        $this->genericShortcutMasterRepository = $genericShortcutMasterRepository;
        $this->myBlHomeComponentService = $myBlHomeComponentService;
        $this->contentComponentService = $contentComponentService;
        $this->setActionRepository($this->genericShortcutMasterRepository);
    }

    public function storeShortcutMaster(array $data)
    {
        DB::transaction(function () use ($data) {
            $shortcut = $this->genericShortcutMasterRepository->create($data);
            $this->saveHomeComponentData($shortcut);
        });
    }

    private function saveHomeComponentData($shortcut)
    {
        $homeComponentData['title_en'] = $shortcut->title_en;
        $homeComponentData['title_bn'] = $shortcut->title_bn;
        $homeComponentData['component_key'] = "generic-shortcut-" . $shortcut->id;

        if ($shortcut->component_for == 'home') {
            $homeComponentData['display_order'] = $this->myBlHomeComponentService->findAll()->max('display_order') + 1;
            $this->myBlHomeComponentService->save($homeComponentData);
        }

        if ($shortcut->component_for == 'content') {
            $homeComponentData['display_order'] = $this->contentComponentService->findAll()->max('display_order') + 1;
            $this->contentComponentService->save($homeComponentData);
        }
    }

    public function updateShortcutMasterData(array $data, $id)
    {
        DB::transaction(function () use ($data, $id) {
            $shortcut = $this->genericShortcutMasterRepository->findOne($id);
            $shortcut->update($data);
            $this->updateHomeComponentData($shortcut);
        });
    }

    private function updateHomeComponentData($shortcut)
    {
        $homeComponentData['title_en'] = $shortcut->title_en;
        $homeComponentData['title_bn'] = $shortcut->title_bn;

        if ($shortcut->component_for == 'home') {
            $component = $this->myBlHomeComponentService->findBy(['component_key' => "generic-shortcut-" . $shortcut->id])->first();
            $component->update($homeComponentData);
        }

        if ($shortcut->component_for == 'content') {
            $component = $this->contentComponentService->findBy(['component_key' => "generic-shortcut-" . $shortcut->id])->first();
            $component->update($homeComponentData);
        }
    }

    public function deleteShortcutMasterData($id)
    {
        DB::transaction(function () use ($id) {
            $shortcut = $this->genericShortcutMasterRepository->findOne($id);
            $shortcut->delete();
            $this->deleteHomeComponentData($shortcut);
        });
    }

    private function deleteHomeComponentData($shortcut)
    {
        if ($shortcut->component_for == 'home') {
            $component = $this->myBlHomeComponentService->findBy(['component_key' => "generic-shortcut-" . $shortcut->id])->first();
            $component->delete();
        }

        if ($shortcut->component_for == 'content') {
            $component = $this->contentComponentService->findBy(['component_key' => "generic-shortcut-" . $shortcut->id])->first();
            $component->delete();
        }
    }
}
