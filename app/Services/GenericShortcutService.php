<?php

namespace App\Services;

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

        return $this->save($data);
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

        return $shortcut->update($data);
    }
}
