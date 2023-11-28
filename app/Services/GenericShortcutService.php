<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\GenericShortcutRepository;
use App\Traits\CrudTrait;

class GenericShortcutService
{
    use CrudTrait;

    /**
     * @var GenericShortcutRepository
     */
    protected $genericShortcutRepository;

    /**
     * @param GenericShortcutRepository $genericShortcutRepository
     */
    public function __construct(GenericShortcutRepository $genericShortcutRepository)
    {
        $this->genericShortcutRepository = $genericShortcutRepository;
        $this->setActionRepository($this->genericShortcutRepository);
    }

    public function saveGenericShortcut(array $data)
    {
        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('generic_shortcuts');
        }

        if (isset($data['other_info'])) {
            $data['other_info'] = json_encode([
                'type' => strtolower($data['component_identifier']),
                'content' => $data['other_info']
            ]);
        }

        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code); 
        unset($data['android_version_code'], $data['ios_version_code']);


        $data['sort_order'] = $this->genericShortcutRepository->getMaxSortOrder($data) + 1;

        return $this->save($data);
    }
    public function editGenericShortcut($id)
    {
        $shortcut = $this->findOne($id);
        $android_version_code = implode('-', [$shortcut['android_version_code_min'], $shortcut['android_version_code_max']]);
        $ios_version_code = implode('-', [$shortcut['ios_version_code_min'], $shortcut['ios_version_code_max']]);
        $shortcut->android_version_code = $android_version_code;
        $shortcut->ios_version_code = $ios_version_code;

        return $shortcut;
    }

    public function updateGenericShortcut(array $data, $id): bool
    {
        $shortcut = $this->findOne($id);

        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('generic_shortcuts');
            if (isset($shortcut) && file_exists($shortcut->icon)) {
                unlink($shortcut->icon);
            }
        }

        if (isset($data['other_info'])) {
            $data['other_info'] = json_encode([
                'type' => strtolower($data['component_identifier']),
                'content' => $data['other_info']
            ]);
        } else {
            $data['other_info'] = null;
        }

        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code); 
        unset($data['android_version_code'], $data['ios_version_code']);

        return $shortcut->update($data);
    }
}
