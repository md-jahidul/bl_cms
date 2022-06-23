<?php
namespace App\Services\HealthHubNewJourney;

use App\Repositories\HealthHubNewJourney\HealthHubPartnerRepository;
use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Repositories\HealthHubNewJourney\HealthHubDashboardRepository;
use Illuminate\Support\Facades\Log;

class HealthHubPartnerService
{
    use CrudTrait;
    private $healthHubPartnerRepository;

    public function __construct(HealthHubPartnerRepository  $healthHubPartnerRepository)
    {
        $this->healthHubPartnerRepository = $healthHubPartnerRepository;
    }

    public function findAll($perPage = null, $relation = null, array $orderBy = null)
    {
        return $this->healthHubPartnerRepository->findAll();
    }

    public function  findOne($id, $relation = null)
    {
        return $this->healthHubPartnerRepository->findOne($id);
    }

    public function save(array $data)
    {
        try {
            $file = $data['logo'];
            $path = $file->storeAs(
                'health-hub-feature/partner-logo',
                strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                'public'
            );
            $data['logo'] = $path;
//            dd($data);
            return $this->healthHubPartnerRepository->create($data);
        } catch (\Exception $e) {
//            dd($e->getMessage());
            Log::error('Error while saving deshboard : ' . $e->getMessage());
            return false;
        }
        return $this->healthHubPartnerRepository->create($data);
    }

    public function update(array $data, $id)
    {
        try {
            if(isset($data['logo'])) {
                $file = $data['logo'];
                $path = $file->storeAs(
                    'health-hub-feature/partner-logo',
                    strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                    'public'
                );
                $data['logo'] = $path;
            }
            $partner = $this->healthHubPartnerRepository->findOne($id);

            return $partner->update($data);
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Error while saving deshboard : ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        return $this->healthHubPartnerRepository->destroy($id);
    }
}
