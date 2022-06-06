<?php


namespace App\Services;


use App\Repositories\PrefillRechargeAmountRepository;
use App\Traits\CrudTrait;

class BalanceTransferService
{
    use CrudTrait;

    /**
     * @var PrefillRechargeAmountRepository
     */
    private $prefillRepository;

    /**
     * BalanceTransferService constructor.
     * @param PrefillRechargeAmountRepository $prefillRepository
     */
    public function __construct(PrefillRechargeAmountRepository $prefillRepository)
    {
        $this->prefillRepository = $prefillRepository;
        $this->setActionRepository($prefillRepository);
    }

    /**
     * Fetch lists of prefill amounts with type balance_transfer
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function amountList()
    {
        return $this->findBy(['type' => 'balance_transfer']);
    }

    /**
     * Saves or updates prefill amounts
     * @param array $data
     * @return bool
     */
    public function savePrefillAmounts(array $data)
    {
        try {
            foreach ($data['amount'] as $key => $datum) {
                if (isset($data['prefill_id'][$key])) {
                    $prefillData = $this->findOne($data['prefill_id'][$key]);
                    $prefillData->update(['amount' => $datum, 'sort' => $key + 1]);
                } else {
                    $insertData = [
                        'sort' => $key + 1,
                        'amount' => $datum,
                        'type' => 'balance_transfer'
                    ];
                    $this->save($insertData);
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }

}
