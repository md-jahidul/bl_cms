<?php
namespace App\Services\HealthHubNewJourney;


use App\Repositories\HealthHubNewJourney\HealthHubFeatureServiceRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HealthHubFeatureService
{
    use CrudTrait;
    private $healthHubServiceRepository;

    public function __construct(HealthHubFeatureServiceRepository $healthHubServiceRepository)
    {

        $this->healthHubServiceRepository = $healthHubServiceRepository;
    }

    public function findAll()
    {
        return $this->healthHubServiceRepository->findAll();
    }

    public function findOne($id)
    {
        return $this->healthHubServiceRepository->findOne($id);
    }

    public function save(array $data)
    {
        try {
            $file = $data['logo'];
            $path = $file->storeAs(
                'health-hub-feature/service-logo',
                strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                'public'
            );
            $data['logo'] = $path;

            return $this->healthHubServiceRepository->create($data);
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
                    'health-hub-feature/service-logo',
                    strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                    'public'
                );
                $data['logo'] = $path;
            }
            $Service = $this->healthHubServiceRepository->findOne($id);

            return $Service->update($data);
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Error while saving deshboard : ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        return $this->healthHubServiceRepository->delete($id);
    }
}
