<?php
namespace App\Services;

use App\Repositories\CustomerRepository;

/**
 * Class BannerService
 * @package App\Services
 */
class CustomerService
{


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
    }



}