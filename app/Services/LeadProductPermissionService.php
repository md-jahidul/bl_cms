<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Models\LeadCategory;
use App\Models\LeadRequest;
use App\Repositories\AlFaqRepository;
use App\Repositories\BusinessOthersRepository;
use App\Repositories\BusinessPackageRepository;
use App\Repositories\LeadCategoryRepository;
use App\Repositories\LeadProductPermissionRepository as LPPRepository;
use App\Repositories\LeadProductRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
     * @var UserRepository
     */
    private $userRepository;

    /**
     * DigitalServicesService constructor.
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     * @param LPPRepository $leadProductPermissionRepository
     * @param LeadCategoryRepository $leadCategoryRepository
     * @param LeadProductRepository $leadProductRepository
     * @param BusinessPackageRepository $businessPackageRepository
     * @param BusinessOthersRepository $businessOthersRepository
     */
    public function __construct(
        UserRepository $userRepository,
        ProductRepository $productRepository,
        LPPRepository $leadProductPermissionRepository,
        LeadCategoryRepository $leadCategoryRepository,
        LeadProductRepository $leadProductRepository,
        BusinessPackageRepository $businessPackageRepository,
        BusinessOthersRepository $businessOthersRepository
    )
    {
        $this->userRepository = $userRepository;
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
                        'id' => $leadCategory->id,
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
                        'id' => $leadCategory->id,
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
                        'id' => $leadCategory->id,
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
                        'id' => $leadCategory->id,
                        'title' => $leadCategory->title,
                        'slug' => $leadCategory->slug
                    ],
                    'products' => $products
                ];
                break;
            case "corporate_responsibility":
                $item = [
                    'category' => [
                        'id' => $leadCategory->id,
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

    /**
     * @param $formData
     * @param null $userId
     * @return Application|ResponseFactory|Response
     */
    public function userWisePermissionSave($formData, $userId = null)
    {
        unset($formData['_token']);

        if ($userId) {
            $this->userPermissionDelete($userId);
        }

        foreach ($formData as $field => $data) {
            $leadCategory = $this->leadCategoryRepository->findOneByProperties(['slug' => $field]);
            if ($leadCategory) {
                foreach ($data as $productId) {
                    $this->save([
                        'user_id' => $formData['user_id'],
                        'lead_category_id' => $leadCategory->id,
                        'lead_product_id' => $productId,
                        'created_by' => Auth::id(),
                    ]);
                }
            }
        }
        return response("Product permission save successfully!");
    }

    public function getPermittedUsers()
    {
        $permissions = $this->findAll();
        foreach ($permissions as $permission) {
            $cat[$permission->user_id][] = $permission->lead_category_id;
        }

        if (!empty($cat)) {
            foreach ($cat as $userId => $catIds) {
                $user = $this->userRepository->findOne($userId);
                $leadCategories = LeadCategory::whereIn('id', $catIds)->get();
                $users[] = [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'user_name' => $user->name,
                    'lead_categories' => $leadCategories,
                ];
            }
            return $users;
        }
        return [];
    }

    public function userPermissionEditInfo($userId)
    {
        return $this->lppRepository->findByProperties(['user_id' => $userId]);
    }

    public function userPermissionDelete($userId)
    {
        $permissionData = $this->lppRepository->findByProperties(['user_id' => $userId]);
        foreach ($permissionData as $item) {
            $item->delete();
        }
    }
}
