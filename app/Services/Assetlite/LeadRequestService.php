<?php

namespace App\Services\Banglalink;

use App\Mail\LeadInfoMail;
use App\Models\LeadCategory;
use App\Models\LeadProductPermission;
use App\Models\LeadRequest;
use App\Repositories\Contracts\Collection;
use App\Repositories\LeadRequestRepository;
use App\Services\ApiBaseService;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
     * @return Collection|\Illuminate\Contracts\Foundation\Application|LengthAwarePaginator|\Illuminate\Contracts\Routing\ResponseFactory|Builder[]|\Illuminate\Database\Eloquent\Collection|Model[]|\Illuminate\Http\Response
     */
    public function leadRequestedData()
    {
        try {
            $permissions = DB::table('lead_product_permissions')->where('user_id', Auth::id())
                ->get();

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

    public function sendMail($data)
    {
        Mail::to($data['email'])->send(new LeadInfoMail($data));
        return response('Mail send successfully');
    }
}
