<?php

namespace App\Services\BlApiHub;

use App\Models\MyBlProduct;
use App\Repositories\CustomerRepository;

/**
 * Class ProductLoanService
 * @package App\Services\Banglalink
 */
class ProductLoanService extends BaseService
{
    protected $responseFormatter;
    protected const CUSTOMER_INFO_API_ENDPOINT = "/customer-information/customer-information";
    protected const BALANCE_API_ENDPOINT = "/customer-information/customer-information";
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;


    protected $customerService;
    protected $balanceService;


    public function __construct()
    {

        $this->responseFormatter = new BaseService();
    }

    /**
     * @param $customer_id
     * @return string
     */
    private function getLoanInfoUrl($customer_id)
    {
        return self::CUSTOMER_INFO_API_ENDPOINT . '/' . $customer_id . '/available-loan-products';
    }
    /**
     * @param $customer_id
     * @return array
     */
    public function hasMALoan($customer_id)
    {
        $response = $this->get($this->getLoanInfoUrl($customer_id));

        $data = json_decode($response['response']);
        $formatted_data = $this->prepareLoanData($data);
        $has_ma_loan = false;
        $amount = 0;
        foreach ($formatted_data as $val) {
            if ($val['type'] == 'balance') {
                $has_ma_loan = true;
                $amount = $val['amount'];
                break;
            }
        }

        return [
            'is_eligible' => $has_ma_loan,
            'amount' => $amount
        ];
    }


    /**
     * @param $loans
     * @return array
     */
    public function prepareLoanData($loans)
    {
        $data = [];

        foreach ($loans as $loan) {
            $product = MyBlProduct::with('details')->where('product_code', $loan->code)->first();
            if ($product) {
                $data [] = array(
                    'product_code' => $product->product_code,
                    'type' => ($product->details->content_type == 'data loan') ? 'internet' : 'balance',
                    'amount' => ($product->details->content_type == 'data loan') ?
                        $product->details->internet_volume_mb : $product->details->mrp_price,
                    'title' => $product->details->name,
                    'price' => $product->details->mrp_price,
                    'validity' => $product->details->validity,
                    'validity_unit' => $product->details->validity_unit
                );
            }
        }

        return $data;
    }
}
