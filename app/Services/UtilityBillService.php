<?php

namespace App\Services;

use App\Repositories\UtilityBillRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UtilityBillService
{
    use CrudTrait;
    private $utilityBillRepository;

    public function __construct(UtilityBillRepository $utilityBillRepository)
    {
        $this->utilityBillRepository = $utilityBillRepository;
        $this->setActionRepository($utilityBillRepository);
    }

    public function save(array $data)
    {
        $data['display_order'] = $this->findAll()->count() + 1;
        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('utility_bill');
        }

        $data['component_key'] = ucfirst($data['title_en']);

        try {
            $this->utilityBillRepository->save($data);

            return true;
        } catch (\Exception $e){
            return false;
        }
    }

    public function findOne($id, $relation = null)
    {
        return $this->utilityBillRepository->findOne($id);
    }

    public function update($id, array $data)
    {
        try {

            $utility = $this->utilityBillRepository->findOne($id);

            if (!empty($data['icon'])) {
                $data['icon'] = 'storage/' . $data['icon']->store('utility_bill');
                if (isset($utility) && file_exists($utility->icon)) {
                    unlink($utility->icon);
                }
            }
            return $utility->update($data);
        } catch (\Exception $e) {

            Log::error('Error while update Utility : ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        return $this->utilityBillRepository->destroy($id);
    }

    public function tableSort($data)
    {
        $this->utilityBillRepository->manageTableSort($data);

        return new Response('Sorted successfully');
    }
}
