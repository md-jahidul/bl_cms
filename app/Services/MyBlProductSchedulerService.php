<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Repositories\MyblCashBackProductRepository;
use App\Services\BlApiHub\BaseService;
use App\Traits\CrudTrait;
use App\Models\NotificationDraft;
use Illuminate\Support\Facades\DB;
/**
 * Class BannerService
 * @package App\Services
 */
class MyBlProductSchedulerService
{
    use CrudTrait;

    private $myblProductScheduleRepository;

    public function __construct(MyblCashBackProductRepository $myblProductScheduleRepository)
    {
        $this->myblProductScheduleRepository = $myblProductScheduleRepository;
    }
}
