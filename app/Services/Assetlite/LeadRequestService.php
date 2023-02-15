<?php

namespace App\Services\Assetlite;

use App\Mail\LeadInfoMail;
use App\Models\LeadCategory;
use App\Models\LeadProductPermission;
use App\Models\LeadRequest;
use App\Models\MyBlProduct;
use App\Models\User;
use App\Repositories\BusinessOthersRepository;
use App\Repositories\BusinessPackageRepository;
use App\Repositories\Contracts\Collection;
use App\Repositories\CorporateInitiativeTabRepository;
use App\Repositories\LeadCategoryRepository;
use App\Repositories\LeadProductRepository;
use App\Repositories\LeadRequestRepository;
use App\Repositories\ProductRepository;
use App\Services\ApiBaseService;
use App\Traits\CrudTrait;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use Carbon\Carbon;
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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

//use Excel;
use Maatwebsite\Excel\Facades\Excel;

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
    /**
     * @var CorporateInitiativeTabRepository
     */
    private $corpInitiativeTabRepository;

    public function __construct(
        LeadRequestRepository $leadRequestRepository,
        LeadCategoryRepository $leadCategoryRepository,
        LeadProductRepository $leadProductRepository,
        BusinessPackageRepository $businessPackageRepository,
        BusinessOthersRepository $businessOthersRepository,
        ProductRepository $productRepository,
        CorporateInitiativeTabRepository $corporateInitiativeTabRepository
    )
    {
        $this->leadRequestRepository = $leadRequestRepository;
        $this->leadCategoryRepository = $leadCategoryRepository;
        $this->leadProductRepository = $leadProductRepository;
        $this->businessPackageRepository = $businessPackageRepository;
        $this->businessOthersRepository = $businessOthersRepository;
        $this->productRepository = $productRepository;
        $this->corpInitiativeTabRepository = $corporateInitiativeTabRepository;
        $this->setActionRepository($leadRequestRepository);
    }

    public function catWiseProduct($item)
    {
        $leadCat = $this->leadCategoryRepository->findOne($item->lead_category_id);

        $leadData = [];
        $leadData['id'] = $item->id;
        $leadData['lead_category'] = $leadCat->title;
        $leadData['form_data'] = $item->form_data;
        $leadData['status'] = $item->status;
        $leadData['created_at'] = explode(" ", $item->created_at)[0];

        switch ($leadCat->slug) {
            case "ecareer_programs":
                $leadProduct = $this->leadProductRepository->findOne($item->lead_product_id);
                break;
            case "postpaid_package":
                $leadProduct = $this->productRepository->getOfferCatWise(4, 'postpaid', $item->lead_product_id);
                break;
            case "business_package":
                $leadProduct = $this->businessPackageRepository->getBusinessPack($item->lead_product_id);
                break;
            case "business_enterprise_solution":
                $leadProduct = $this->businessOthersRepository->getEnterEnterpriseSol($item->lead_product_id);
                break;
            case "corporate_responsibility":
                $leadProduct = $this->corpInitiativeTabRepository->getInitiativeTab($item->lead_product_id);
                break;
            default:
                $leadData = array();
        }
        $leadData['lead_product'] = isset($leadProduct->name) ? $leadProduct->name : null;
        return $leadData;
    }

    public function getLeads($request, $permissions = null)
    {
        $start = $request->get('start');
        $length = $request->get('length');

        if ($permissions) {
            $cat = [];
            $productId = [];
            foreach ($permissions as $permission) {
                $cat[] = $permission->lead_category_id;
                $productId[] = $permission->lead_product_id;
            }
            $categoryId = array_unique($cat);
            $builder = LeadRequest::whereIn('lead_product_id', $productId)
                ->whereIn('lead_category_id', $categoryId);
        } else {
            $builder = new LeadRequest();
        }

        if ($request->lead_category) {
            $builder = $builder->where('lead_category_id', $request->lead_category);
        }

        if ($request->applicant_name) {
            $builder = $builder->where('form_data->name', 'LIKE', "%$request->applicant_name%");
        }

        if ($request->date_range != null) {
            $date = explode('-', $request->date_range);
            $from = str_replace('/', '-', $date[0]) . " " . "00:00:00";
            $to = str_replace('/', '-', $date[1]) . " " . "23:59:00";
            $builder = $builder->whereBetween('created_at', [$from, $to]);
        }

        $all_items_count = $builder->count();

        if ($request->excel_export) {
            $items = $builder->get();
        } else {
            $items = $builder->skip($start)->take($length)->get();
        }

        $data = [];
        foreach ($items as $item) {
            if ($item->lead_category_id || $item->lead_product_id) {
                $data[] = $this->catWiseProduct($item);
            }
        }

        return [
            'count' => $all_items_count,
            'items' => $data
        ];
    }


    /**
     * @return Builder[]|Model[]|array[]
     */
    public function leadRequestedData($request)
    {
        try {
            $permissions = DB::table('lead_product_permissions')->where('user_id', Auth::id())
                ->get();

            $draw = $request->get('draw');

            if (Auth::id() == self::ASSETLITE_SUPER_ADMIN || Auth::id() == self::LEAD_SUPER_ADMIN) {
                $leadRequest = $this->getLeads($request);
            } else {
                if (count($permissions) != 0) {
                    $leadRequest = $this->getLeads($request, $permissions);
                } else {
                    return [
                        'data' => [],
                        'permission' => false,
                        'draw' => $draw,
                        'recordsTotal' => 0,
                        'recordsFiltered' => 0
                    ];
                }
            }

            return [
                'data' => $leadRequest['items'],
                'permission' => true,
                'draw' => $draw,
                'recordsTotal' => $leadRequest['count'],
                'recordsFiltered' => $leadRequest['count']
            ];

        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    public function bindDynamicValues($obj, $json_data = 'other_attributes')
    {
        if (!empty($obj[$json_data])) {
            foreach ($obj[$json_data] as $key => $value) {
                $obj[$key] = $value;
            }
        }
        return $obj;
    }

    /**
     * @param $request
     * @return Application|ResponseFactory|Response
     * @throws IOException
     * @throws WriterNotOpenedException
     */
    public function excelGenerator($request)
    {
        $leadRequest = $this->getLeads($request);
        if ($leadRequest['count'] > 0) {
            // Find Category Wise Product With Form data
            $products = $leadRequest['items'];

            $writer = WriterEntityFactory::createXLSXWriter();
            $fileName = str_replace(' ', '-', $products[0]['lead_category']);
            $writer->openToBrowser($fileName . "-" . date('Y-m-d') . '.xlsx');

            $header_style = (new StyleBuilder())
                ->setFontBold()
                ->setFontSize(10)
                ->setBackgroundColor(Color::rgb(245, 245, 240))
                ->build();

            $data_style = (new StyleBuilder())
                ->setFontSize(9)
                ->build();

            //  Corporate responsibility
            if ($request->lead_category == 5) {
                // Excel Header and Row Value Format
                foreach ($products as $key => $items) {
                    foreach ($items as $field => $val) {
                        if ($field == "form_data") {
                            foreach ($val as $dataKey => $data) {
                                foreach ($data as $fieldKey => $fieldVal) {
                                    $header[] = str_replace('_', ' ', ucwords($fieldKey));
                                    $rowValue[$key][] = $fieldVal;
                                }
                            }
                        }
                    }
                }
                $header = array_unique($header);
                $row = WriterEntityFactory::createRowFromArray($header, $header_style);
                $writer->addRow($row);
                foreach ($rowValue as $product) {
                    $row = WriterEntityFactory::createRowFromArray($product, $data_style);
                    $writer->addRow($row);
                }
            } else {
                // Excel Header Create
                if ($request->lead_category == 4) {
                    $header = [
                        "Id",
                        "Lead category",
                        "Status",
                        "Created at",
                        "Lead product",
                        "Name",
                        "Email",
                        "Phone",
                        "Gender",
                        "Address",
                        "Versity id",
                        "Degree level",
                        "Academic year",
                        "Date of birth",
                        "Type of degree",
                        "Follow facebook",
                        "Follow linkedIn",
                        "University name",
                        "University slug",
                    ];
                } else {
                    foreach ($products as $key => $items) {
                        $bindData = $this->bindDynamicValues($items, 'form_data');
                        unset($bindData['form_data']);
                        foreach ($bindData as $field => $val) {
                            $header[] = str_replace('_', ' ', ucwords($field));
                        }
                    }
                }
                $header = array_unique($header);
                $row = WriterEntityFactory::createRowFromArray(array_values($header), $header_style);
                $writer->addRow($row);
                foreach ($products as $product) {
                    $bindData = $this->bindDynamicValues($product, 'form_data');
                    unset($bindData['form_data']);
                    if ($request->lead_category == 4) {
                        $formData = $product['form_data'];
                        $formattedData = [];
                        $formattedData["id"] = $product['id'];
                        $formattedData["lead_category"] = $product['lead_category'];
                        $formattedData["status"] = $product['status'];
                        $formattedData["created_at"] = $product['created_at'];
                        $formattedData["lead_product"] = $product['lead_product'];
                        $formattedData["name"] = $formData['name'] ?? "N/A";
                        $formattedData["email"] = $formData['email'] ?? "N/A";
                        $formattedData["phone"] = $formData['phone'] ?? "N/A";
                        $formattedData["gender"] = $formData['gender'] ?? "N/A";
                        $formattedData["address"] = $formData['address'] ?? "N/A";
                        $formattedData["versity_id"] = $formData['versity_id'] ?? "N/A";
                        $formattedData["degree_level"] = $formData['degree_level'] ?? "N/A";
                        $formattedData["academic_year"] = $formData['academic_year'] ?? "N/A";
                        $formattedData["date_of_birth"] = $formData['date_of_birth'] ?? "N/A";
                        $formattedData["type_of_degree"] = $formData['type_of_degree'] ?? "N/A";
                        $formattedData["follow_facebook"] = isset($formData['follow_facebook']) ? $formData['follow_facebook'] : "N/A";
                        $formattedData["follow_linkedIn"] = isset($formData['follow_linkedIn']) ? $formData['follow_linkedIn'] : "N/A";
                        $formattedData["university_name"] = $formData['university_name'] ?? "N/A";
                        $formattedData["university_slug"] = $formData['university_slug'] ?? "N/A";
                        $row = WriterEntityFactory::createRowFromArray($formattedData, $data_style);
                        $writer->addRow($row);
                    } else {
                        $row = WriterEntityFactory::createRowFromArray($bindData, $data_style);
                        $writer->addRow($row);
                    }
                }
            }
            $writer->close();
        } else {
            return response('No data available in this category!');
        }
    }

    public function updateStatus($data, $id)
    {
        $leadData = $this->findOne($id);
        $leadData->update($data);
        return response('Status update successfully!');
    }

//    public static function sendMail($data)
//    {
//        Mail::to($data['email'])->send(new LeadInfoMail($data));
//        return response('Mail send successfully');
//    }

    public function downloadPDF($leadId)
    {
        $leadData = $this->findOne($leadId);
        $formData = $this->makeLeadInfoTable($leadData);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($formData);
        return $pdf->stream();
    }

    public function makeLeadInfoTable($data)
    {
        $leadCat = $this->leadCategoryRepository->findOne($data->lead_category_id);

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
                    <span align="left"><strong>' . $leadCat->title . '</strong></span>
                    <span style="float: right"><strong>Date: </strong>' . date('d/m/yy') . '</span>
                  <table width="100%" style="border-collapse: collapse; border: 0px; margin-top: 20px;"><tbody>';

        foreach ($data->form_data as $field => $value) {
            // Corporate Responsibility
            if ($data->lead_category_id == 5) {
                $table .= '<tr style="background: rgba(225,233,221,0.88);">
                                <th colspan="2" style="border: 1px solid; padding:12px; text-align: left">' . str_replace('_', ' ', strtoupper($field)) . '</th>
                           </tr>';
//                $table .= '<tr><th></th></tr>';
                foreach ($value as $subField => $subValue) {
                    $table .= '<tr>
                                 <th style="border: 1px solid; padding:12px; text-align: left">' . str_replace('_', ' ', ucwords($subField)) . '</th>
                                 <td style="border: 1px solid; padding:12px;">' . $subValue . '</td>
                               </tr>';
                }
            } // Other Categories
            else {
                if ($field != "applicant_cv") {
                    $table .= "<tr>";
                    $table .= '<th style="border: 1px solid; padding:12px;" width="30%; text-align: left">' . str_replace('_', ' ', ucwords($field)) . '</th>';
                    $table .= '<td style="border: 1px solid; padding:12px;">' . $value . '</td>';
                    $table .= "</tr>";
                }
            }
        }

        $table .= "</tbody></table>";
        return $table;
    }
}
