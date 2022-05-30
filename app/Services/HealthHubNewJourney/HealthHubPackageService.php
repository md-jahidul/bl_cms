<?php
namespace App\Services\HealthHubNewJourney;

use App\Repositories\HealthHubNewJourney\HealthHubPackageRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HealthHubPackageService
{
    use CrudTrait;
    private $healthHubPackageRepository;

    public function __construct(HealthHubPackageRepository $healthHubPackageRepository)
    {
        $this->healthHubPackageRepository = $healthHubPackageRepository;
        $this->setActionRepository($healthHubPackageRepository);
    }

    public function findAll()
    {
        return $this->healthHubPackageRepository->findAll();
    }
    public function findOne($id)
    {
        return $this->healthHubPackageRepository->findOne($id);
    }

    public function save(array $data)
    {
        try {
            $file = $data['logo'];
            $path = $file->storeAs(
                'health-hub-feature/package-logo',
                strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                'public'
            );
            $data['logo'] = $path;

            return $this->healthHubPackageRepository->create($data);
        } catch (\Exception $e) {
            Log::error('Error while saving deshboard : ' . $e->getMessage());
            return false;
        }
    }

    public function update(array $data, $id)
    {
        try {
            if(isset($data['logo'])) {
                $file = $data['logo'];
                $path = $file->storeAs(
                    'health-hub-feature/package-logo',
                    strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                    'public'
                );
                $data['logo'] = $path;
            }
            $Service = $this->healthHubPackageRepository->findOne($id);

            return $Service->update($data);
        } catch (\Exception $e) {
            Log::error('Error while Updating Package : ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        $deleted = $this->healthHubPackageRepository->destroy($id);
        return $deleted;
    }

    public function updateDashboardId($id, $dashboardId)
    {
        $service = $this->healthHubPackageRepository->findOne($id);
        return $service->update(['health_hub_dashboard_id' => $dashboardId]);
    }

    public function deleteDashboardId($id)
    {
        $service   = $this->healthHubPackageRepository->findOne($id);
        return $service->update(['health_hub_dashboard_id' => null]);
    }
}
