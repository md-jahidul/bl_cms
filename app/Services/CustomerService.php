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


    public function getUserList(Request $request, array $user_phone,$notification_id){
        $selectedNumber= $this->customerRepository->getCustomerList($request,$user_phone,$notification_id);
        return [
            'title' => $request->input('title'),
            'body' => $request->input('message'),
            'category_slug' => $request->input('category_slug'),
            'category_name' => $request->input('category_name'),
            "sending_from" => "cms",
            "send_to_type" => "INDIVIDUALS",
            "recipients" => $selectedNumber,
            "is_interactive" => "NO",
            "data" => [
                "cid" => "1",
                "url" => "test.com",
                "component" => "offer",
            ]
        ];

        // $notificationInfo=NotificationDraft::find($notification_id);


        // $orders = DB::table('customers');
        //         // ->orderByRaw('updated_at - created_at DESC')
        //         // ->get();
        // $orders->get();
        //         dd($orders);
        // // dd($notificationInfo);

        // //  $customar= $this->customerService->getUserList();
        // // new Customer();
        // $builder = $this->customerRepository->findBy(['phone','014099900160'])->pluck('name', 'id');
        // // $builder = $builder->where('status', 1);

        // // $products = $builder->whereHas(
        // //     'details',
        // //     function ($q) {
        // //         $q->whereIn('content_type', ['data','voice','sms']);
        // //     }
        // // )->get();

        // // $data = [];

        // // foreach ($products as $product) {
        // //     $data [] = [
        // //         'id'    => $product->details->product_code,
        // //         'text' =>  '(' . strtoupper($product->details->content_type) . ') ' . $product->details->commercial_name_en
        // //     ];
        // // }

        // // return $data;


        // // if(!empty($notificationInfo->customer_type)){
        // //     $customar->where('number_type',$notificationInfo->customer_type);
        // // }

        // // if(!empty($notificationInfo->device_type)){
        // //     $customar->where('device_type',$notificationInfo->device_type);
        // // }

        // // if(count($user_phone)>0){
        // //     $customar->whereIn('phone',$user_phone);
        // // }
        // // $customar->get('phone');

        // // $builder->where('id', '!=', $authUserId);
        // // $builder->pluck('name', 'id');


        // dd($builder);


    }
}
