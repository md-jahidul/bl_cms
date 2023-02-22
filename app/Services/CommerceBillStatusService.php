<?php

namespace App\Services;

use App\Repositories\CommerceBillStatusRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class CommerceBillStatusService
{
    use CrudTrait;
    private $commerceBillStatusRepository;

    public function __construct(CommerceBillStatusRepository $commerceBillStatusRepository)
    {
        $this->commerceBillStatusRepository = $commerceBillStatusRepository;
        $this->setActionRepository($commerceBillStatusRepository);
    }

    public function getPaginatedBills()
    {
        $orderBy = ['column' => 'created_at', 'direction' => 'DESC'];
        return $this->commerceBillStatusRepository->findAll(30, null, $orderBy);
    }
}
