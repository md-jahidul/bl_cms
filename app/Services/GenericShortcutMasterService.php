<?php

namespace App\Services;

use App\Repositories\GenericShortcutMasterRepository;
use App\Traits\CrudTrait;

class GenericShortcutMasterService
{
    use CrudTrait;

    /**
     * @var GenericShortcutMasterRepository
     */
    protected $genericShortcutMasterRepository;

    /**
     * @param GenericShortcutMasterRepository $genericShortcutMasterRepository
     */
    public function __construct(GenericShortcutMasterRepository $genericShortcutMasterRepository)
    {
        $this->genericShortcutMasterRepository = $genericShortcutMasterRepository;
        $this->setActionRepository($this->genericShortcutMasterRepository);
    }
}
