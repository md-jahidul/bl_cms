<?php

namespace App\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use App\Repositories\GenericShortcutMasterRepository;
use App\Services\MyblHomeComponentService;
use App\Services\ContentComponentService;
use Illuminate\Support\Facades\Redis;

class GenericShortcutMasterService
{
    use CrudTrait;

    /**
     * @var GenericShortcutMasterRepository
     * @var MyblHomeComponentService
     * @var ContentComponentService
     * @var NonBlComponentService
     */

    protected $genericShortcutMasterRepository;
    protected $myBlHomeComponentService;
    protected $contentComponentService;
    protected $nonBlComponentService;

    /**
     * @param GenericShortcutMasterRepository $genericShortcutMasterRepository
     * @param MyblHomeComponentService $myBlHomeComponentService
     * @param ContentComponentService $contentComponentService
     */
    public function __construct(
        GenericShortcutMasterRepository $genericShortcutMasterRepository,
        MyblHomeComponentService $myBlHomeComponentService,
        ContentComponentService $contentComponentService,
        NonBlComponentService $nonBlComponentService
    ) {
        $this->genericShortcutMasterRepository = $genericShortcutMasterRepository;
        $this->myBlHomeComponentService = $myBlHomeComponentService;
        $this->contentComponentService = $contentComponentService;
        $this->nonBlComponentService = $nonBlComponentService;
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
        $homeComponentData['component_key'] = "generic_shortcut_" . $shortcut->id;
        $homeComponentData['is_api_call_enable'] = 1;
        $homeComponentData['is_eligible'] = 0;

        if ($shortcut->component_for === 'home') {
            $homeComponentData['display_order'] = $this->myBlHomeComponentService->findAll()->max('display_order') + 1;
            $this->myBlHomeComponentService->save($homeComponentData);
            Redis::del('mybl_home_component');
        }

        if ($shortcut->component_for === 'content') {
            $homeComponentData['display_order'] = $this->contentComponentService->findAll()->max('display_order') + 1;
            $this->contentComponentService->save($homeComponentData);
            Redis::del('content_component');
        }

        if ($shortcut->component_for === 'non_bl') {
            $homeComponentData['display_order'] = $this->nonBlComponentService->findAll()->max('display_order') + 1;
            $this->nonBlComponentService->save($homeComponentData);
            Redis::del('non_bl_component');
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
            $component = $this->myBlHomeComponentService->findBy(['component_key' => "generic_shortcut_" . $shortcut->id])->first();
            $component->update($homeComponentData);
            Redis::del('mybl_home_component');
        }

        if ($shortcut->component_for == 'content') {
            $component = $this->contentComponentService->findBy(['component_key' => "generic_shortcut_" . $shortcut->id])->first();
            $component->update($homeComponentData);
            Redis::del('content_component');
        }

        if ($shortcut->component_for == 'non_bl') {
            $component = $this->nonBlComponentService->findBy(['component_key' => "generic_shortcut_" . $shortcut->id])->first();
            $component->update($homeComponentData);
            Redis::del('non_bl_component');
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
            $component = $this->myBlHomeComponentService->findBy(['component_key' => "generic_shortcut_" . $shortcut->id])->first();
            $component->delete();
            Redis::del('mybl_home_component');
        }

        if ($shortcut->component_for == 'content') {
            $component = $this->contentComponentService->findBy(['component_key' => "generic_shortcut_" . $shortcut->id])->first();
            $component->delete();
            Redis::del('content_component');
        }

        if ($shortcut->component_for == 'non_bl') {
            $component = $this->nonBlComponentService->findBy(['component_key' => "generic_shortcut_" . $shortcut->id])->first();
            $component->delete();
            Redis::del('non_bl_component');
        }
    }
}
