<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqRepository;
use App\Repositories\BusinessOthersRepository;
use App\Repositories\BusinessPackageRepository;
use App\Repositories\LeadCategoryRepository;
use App\Repositories\LeadProductPermissionRepository as LPPRepository;
use App\Repositories\LeadProductRepository;
use App\Repositories\ProductRepository;
use App\Traits\CrudTrait;

class LeadProductPermissionService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $alFaqRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var LPPRepository
     */
    private $lppRepository;
    /**
     * @var LeadCategoryRepository
     */
    private $leadCategoryRepository;
    /**
     * @var LeadProductRepository
     */
    private $leadProductRepository;
    /**
     * @var BusinessPackageRepository
     */
    private $businessPackageRepository;
    /**
     * @var BusinessOthersRepository
     */
    private $businessOthersRepo;

    /**
     * DigitalServicesService constructor.
     * @param ProductRepository $productRepository
     * @param LPPRepository $leadProductPermissionRepository
     * @param LeadCategoryRepository $leadCategoryRepository
     * @param LeadProductRepository $leadProductRepository
     * @param BusinessPackageRepository $businessPackageRepository
     * @param BusinessOthersRepository $businessOthersRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        LPPRepository $leadProductPermissionRepository,
        LeadCategoryRepository $leadCategoryRepository,
        LeadProductRepository $leadProductRepository,
        BusinessPackageRepository $businessPackageRepository,
        BusinessOthersRepository $businessOthersRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->lppRepository = $leadProductPermissionRepository;
        $this->leadCategoryRepository = $leadCategoryRepository;
        $this->leadProductRepository = $leadProductRepository;
        $this->businessPackageRepository = $businessPackageRepository;
        $this->businessOthersRepo = $businessOthersRepository;
        $this->setActionRepository($leadProductPermissionRepository);
    }

    public function postpaidPackage()
    {
        return $this->productRepository->getOfferCatWise(4, 'postpaid');
    }

    public function eCareerPrograms()
    {
        return $this->leadProductRepository->getProduct();
    }

    public function businessPackage()
    {
        return $this->businessPackageRepository->getBusinessPack();
    }

    public function businessEnterpriseSolution()
    {
        return $this->businessOthersRepo->getEnterEnterpriseSol();
    }

    public function categoryWiseProduct($leadCategory)
    {
        $item = [];
        switch ($leadCategory->slug) {
            case "postpaid_package":
                $products = $this->postpaidPackage();
                $item = [
                    'category' => [
                        'title' => $leadCategory->title,
                        'slug' => $leadCategory->slug
                    ],
                    'products' => $products
                ];
                break;
            case "ecareer_programs":
                $products = $this->eCareerPrograms();
                $item = [
                    'category' => [
                        'title' => $leadCategory->title,
                        'slug' => $leadCategory->slug
                    ],
                    'products' => $products
                ];
                break;

            case "business_package":
                $products = $this->businessPackage();
                $item = [
                    'category' => [
                        'title' => $leadCategory->title,
                        'slug' => $leadCategory->slug
                    ],
                    'products' => $products
                ];
                break;
            case "business_enterprise_solution":
                $products = $this->businessEnterpriseSolution();
                $item = [
                    'category' => [
                        'title' => $leadCategory->title,
                        'slug' => $leadCategory->slug
                    ],
                    'products' => $products
                ];
                break;
            case "corporate_responsibility":
                $item = [
                    'category' => [
                        'title' => $leadCategory->title,
                        'slug' => $leadCategory->slug
                    ],
                    'products' => []
                ];
                break;
            default:
        }
        return $item;
    }

    public function getCatAndProducts()
    {
        $leadCategories = $this->leadCategoryRepository->findAll();
        foreach ($leadCategories as $leadCategory) {
            $data[] = $this->categoryWiseProduct($leadCategory);
        }
        return $data;
    }

    public function userWisePermissionSave()
    {

    }
}
