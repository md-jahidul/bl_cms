<?php
namespace App\Services\HealthHubNewJourney;

use App\Repositories\HealthHubNewJourney\HealthHubPlanRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HealthHubPlanService
{
    use CrudTrait;
    private $healthHubPlanRepository;

    public function __construct(HealthHubPlanRepository $healthHubPlanRepository)
    {
        $this->healthHubPlanRepository = $healthHubPlanRepository;
        $this->setActionRepository($healthHubPlanRepository);
    }

    public function findAll()
    {
        return $this->healthHubPlanRepository->findAll();
    }
    public function findOne($id)
    {
        return $this->healthHubPlanRepository->findOne($id);
    }

    public function save(array $data)
    {
        try {
            $file = $data['logo'];
            $path = $file->storeAs(
                'health-hub-feature/plan-logo',
                strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                'public'
            );
            $data['logo'] = $path;

            return $this->healthHubPlanRepository->create($data);
        } catch (\Exception $e) {
            dd($e->getMessage());
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
                    'health-hub-feature/plan-logo',
                    strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                    'public'
                );
                $data['logo'] = $path;
            }
            $Service = $this->healthHubPlanRepository->findOne($id);

            return $Service->update($data);
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Error while saving deshboard : ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        return $this->healthHubPlanRepository->destroy($id);
    }
}
