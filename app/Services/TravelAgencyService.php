<?php

namespace App\Services;

use App\Repositories\TravelAgencyRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TravelAgencyService
{
    use CrudTrait;
    private $travelAgencyRepository;

    public function __construct(TravelAgencyRepository $travelAgencyRepository)
    {
        $this->travelAgencyRepository = $travelAgencyRepository;
        $this->setActionRepository($travelAgencyRepository);
    }

    public function save(array $data)
    {
        $data['display_order'] = $this->findAll()->count() + 1;

        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('travel');
        }

        $data['component_key'] = ucfirst($data['title_en']);

        try {
            $this->travelAgencyRepository->save($data);

            return true;
        } catch (\Exception $e){
            dd($e->getMessage());
            return false;
        }
    }

    public function findOne($id, $relation = null)
    {
        return $this->travelAgencyRepository->findOne($id);
    }

    public function update($id, array $data)
    {
        try {

            $utility = $this->travelAgencyRepository->findOne($id);

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
        return $this->travelAgencyRepository->destroy($id);
    }

    public function tableSort($data)
    {
        $this->travelAgencyRepository->manageTableSort($data);

        return new Response('Sorted successfully');
    }
}
