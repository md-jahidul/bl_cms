<?php

namespace App\Services\Banglalink;

use App\Repositories\Contracts\Collection;
use App\Repositories\LeadRequestRepository;
use App\Services\ApiBaseService;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class FnfService
 * @package App\Services\Banglalink
 */
class LeadRequestService
{
    use CrudTrait;

    /***
     * @var LeadRequestRepository
     */
    protected $leadRequestRepository;

    public function __construct(LeadRequestRepository $leadRequestRepository)
    {
        $this->leadRequestRepository = $leadRequestRepository;
        $this->setActionRepository($leadRequestRepository);
    }

    /**
     * @return Collection|LengthAwarePaginator|Builder[]|\Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function leadRequestedData()
    {
        return $this->findAll();
    }
}
