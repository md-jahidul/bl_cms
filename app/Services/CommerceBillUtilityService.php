<?php

namespace App\Services;

use App\Repositories\CommerceBillUtilityRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CommerceBillUtilityService
{
    use CrudTrait;
    private $commerceBillUtilityRepository;

    public function __construct(CommerceBillUtilityRepository $commerceBillUtilityRepository)
    {
        $this->commerceBillUtilityRepository = $commerceBillUtilityRepository;
        $this->setActionRepository($commerceBillUtilityRepository);
    }

    public function save(array $data)
    {
        $data['display_order'] = $this->findAll()->count() + 1;
        if (isset($data['logo'])) {
            $data['logo'] = 'storage/' . $data['logo']->store('commerce_bill_utility');
        }
        $string = strtolower($data['name_en']);
        $data['slug'] = str_replace(" ", "_", $string);

        try {
            $this->commerceBillUtilityRepository->save($data);

            return true;
        } catch (\Exception $e){

            return false;
        }
    }

    public function findOne($id, $relation = null)
    {
        return $this->commerceBillUtilityRepository->findOne($id);
    }

    public function update($id, array $data)
    {
        $string = strtolower($data['name_en']);
        $data['slug'] = str_replace(" ", "_", $string);

        try {

            $utility = $this->commerceBillUtilityRepository->findOne($id);

            if (!empty($data['logo'])) {
                $data['logo'] = 'storage/' . $data['logo']->store('commerce_bill_category');
                if (isset($utility) && file_exists($utility->logo)) {
                    unlink($utility->logo);
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
        return $this->commerceBillUtilityRepository->destroy($id);
    }

    public function tableSort($data)
    {
        $this->commerceBillUtilityRepository->manageTableSort($data);

        return new Response('Sorted successfully');
    }
}
