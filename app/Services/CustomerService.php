<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use App\Traits\CrudTrait;
use App\Models\NotificationDraft;
use Illuminate\Support\Facades\DB;
/**
 * Class BannerService
 * @package App\Services
 */
class CustomerService
{

    use CrudTrait;
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;


    /**
     * CustomerService constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->setActionRepository($customerRepository);
    }


    public function getCustomerList(Request $request, array $user_phone,$notification_id){
     return   $selectedNumber= $this->customerRepository->getCustomerList($request,$user_phone,$notification_id);

   }
}
