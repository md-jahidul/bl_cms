<?php

namespace App\Services\Banglalink;

use App\Mail\LeadInfoMail;
use App\Models\LeadCategory;
use App\Models\LeadProductPermission;
use App\Models\LeadRequest;
use App\Repositories\BusinessOthersRepository;
use App\Repositories\BusinessPackageRepository;
use App\Repositories\Contracts\Collection;
use App\Repositories\LeadCategoryRepository;
use App\Repositories\LeadProductRepository;
use App\Repositories\LeadRequestRepository;
use App\Repositories\ProductRepository;
use App\Services\ApiBaseService;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Class FnfService
 * @package App\Services\Banglalink
 */
class LeadRequestService
{
    use CrudTrait;

    protected const ASSETLITE_SUPER_ADMIN = 5;
    protected const LEAD_SUPER_ADMIN = 9;

    /***
     * @var LeadRequestRepository
     */
    protected $leadRequestRepository;
    /**
     * @var LeadCategoryRepository
     */
    private $leadCategoryRepository;
    /**
     * @var LeadProductRepository
     */
    private $leadProductRepository;
    /**
     * @var LeadProductRepository
     */
    private $businessPackageRepository;
    /**
     * @var LeadProductRepository
     */
    private $businessOthersRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(
        LeadRequestRepository $leadRequestRepository,
        LeadCategoryRepository $leadCategoryRepository,
        LeadProductRepository $leadProductRepository,
        BusinessPackageRepository $businessPackageRepository,
        BusinessOthersRepository $businessOthersRepository,
        ProductRepository $productRepository
    )
    {
        $this->leadRequestRepository = $leadRequestRepository;
        $this->leadCategoryRepository = $leadCategoryRepository;
        $this->leadProductRepository = $leadProductRepository;
        $this->businessPackageRepository = $businessPackageRepository;
        $this->businessOthersRepository = $businessOthersRepository;
        $this->productRepository = $productRepository;
        $this->setActionRepository($leadRequestRepository);
    }

    public function catWiseProduct($item)
    {
        $leadCat = $this->leadCategoryRepository->findOne($item->lead_category_id);

        $leadData = [];

        switch ($leadCat->slug) {
            case "ecareer_programs";
                $leadProduct = $this->leadProductRepository->findOne($item->lead_product_id);
                $leadData['id'] = $item->id;
                $leadData['lead_cat'] = $leadCat->title;
                $leadData['lead_product'] = ($leadProduct->title) ? $leadProduct->title : null;
                $leadData['form_data'] = $item->form_data;
                $leadData['status'] = $item->status;
                break;
            case "postpaid_package";
                $leadProduct = $this->productRepository->getOfferCatWise(4, 'postpaid', $item->lead_product_id);
                $leadData['id'] = $item->id;
                $leadData['lead_cat'] = $leadCat->title;
                $leadData['lead_product'] = isset($leadProduct->name) ? $leadProduct->name : null;
                $leadData['form_data'] = $item->form_data;
                $leadData['status'] = $item->status;
                break;
            case "business_package";
                $leadProduct = $this->businessPackageRepository->getBusinessPack($item->lead_product_id);
                $leadData['id'] = $item->id;
                $leadData['lead_cat'] = $leadCat->title;
                $leadData['lead_product'] = isset($leadProduct->name) ? $leadProduct->name : null;
                $leadData['form_data'] = $item->form_data;
                $leadData['status'] = $item->status;
                break;
            case "business_enterprise_solution";
                $leadProduct = $this->businessOthersRepository->getEnterEnterpriseSol($item->lead_product_id);
                $leadData['id'] = $item->id;
                $leadData['lead_cat'] = $leadCat->title;
                $leadData['lead_product'] = isset($leadProduct->name) ? $leadProduct->name : null;
                $leadData['form_data'] = $item->form_data;
                $leadData['status'] = $item->status;
                break;
            default:
                $leadData = array();
        }

        return $leadData;
    }


    /**
     * @return Collection|Application|LengthAwarePaginator|ResponseFactory|Builder[]|\Illuminate\Database\Eloquent\Collection|Model[]|Response
     */
    public function leadRequestedData()
    {
        try {
            $permissions = DB::table('lead_product_permissions')->where('user_id', Auth::id())
                ->get();

            if (Auth::id() == self::ASSETLITE_SUPER_ADMIN || Auth::id() == self::LEAD_SUPER_ADMIN) {
                $leadRequest = LeadRequest::all();

                $data = [];
                foreach ($leadRequest as $item) {
                    if ($item->lead_category_id || $item->lead_product_id) {
                        $data[] = $this->catWiseProduct($item);
                    }
                }

//                dd($data);

                return [
                    'data' => $data,
                ];
            } else {
                if (count($permissions) != 0) {
                    foreach ($permissions as $permission) {
                        $cat[] = $permission->lead_category_id;
                        $productId[] = $permission->lead_product_id;
                    }
                    $categoryId = array_unique($cat);
                    $data = LeadRequest::whereIn('lead_product_id', $productId)
                        ->whereIn('lead_category_id', $categoryId)
                        ->with(['leadCategory', 'leadProduct'])
                        ->get();
                    return [
                        'data' => $data,
                    ];
                } else {
                    $response = [
                        'data' => [],
                        'response' => "No products found or you do not have permission!"
                    ];
                    return $response;
                }
            }


        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }


//        foreach ($permissions as $item){
//            $data[] = LeadRequest::where('lead_product_id', $item->lead_product_id)
//                ->where('lead_category_id', $item->lead_category_id)
//                ->with('leadCategory')
//                ->with('leadProduct')
//                ->first();
//        }
//        return $data;
        return $this->findAll();
    }

    public function updateStatus($data, $id)
    {
        $leadData = $this->findOne($id);
        $leadData->update($data);
        return response('Status update successfully!');
    }

    public static function sendMail($data)
    {
        Mail::to($data['email'])->send(new LeadInfoMail($data));
        return response('Mail send successfully');
    }

    public function downloadPDF($leadId)
    {
        $leadData = $this->findOne($leadId);
        $formData = $this->makeLeadInfoTable($leadData->form_data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($formData);
        return $pdf->stream();
    }

    public function makeLeadInfoTable($data)
    {
        $table = "<style>
                  @font-face {
                    font-family: 'Helvetica';
                    font-weight: normal;
                    font-style: normal;
                    font-variant: normal;
                  }
                  body {
                    font-family: Helvetica, sans-serif;
                  }
                  </style>";

        $table .= '<h3 align="center">Applicant Data</h3>
                  <table width="100%" style="border-collapse: collapse; border: 0px;"><tbody>';
        foreach ($data as $field => $value) {
            if ($field != "applicant_cv") {
                $table .= "<tr>";
                $table .= '<th style="border: 1px solid; padding:12px;" width="30%">' . str_replace('_', ' ', strtoupper($field)) . '</th>';
                $table .= '<td style="border: 1px solid; padding:12px;">' . $value . '</td>';
                $table .= "</tr>";
            }
        }
        $table .= "</tbody></table>";
        return $table;
    }
}
