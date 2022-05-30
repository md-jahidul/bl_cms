<?php
namespace App\Services\HealthHubNewJourney;

use App\Repositories\HealthHubNewJourney\HealthHubDashboardRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HealthHubDashboardService
{
    use CrudTrait;
    private $healthHubDashboardRepo;

    public function __construct(HealthHubDashboardRepository $healthHubDashboardRepo)
    {
        $this->healthHubDashboardRepo = $healthHubDashboardRepo;
        $this->setActionRepository($healthHubDashboardRepo);
    }

    public function findAll()
    {
        return $this->healthHubDashboardRepo->findAll();
    }

    public function first(){
        return $this->healthHubDashboardRepo->first();
    }

    public function storeOrUpdate(array $data, $id = null)
    {
        try {
            return DB::transaction(function () use ($data, $id) {

                if(isset($data['home_banner'])){
                    $file = $data['home_banner'];
                    $path = $file->storeAs(
                        'health-hub-feature/dashboard',
                        strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                        'public'
                    );
                    $data['home_banner'] = $path;
                }

                if(isset($data['landing_page_banner'])){
                    $file = $data['landing_page_banner'];
                    $path = $file->storeAs(
                        'health-hub-feature/dashboard',
                        strtotime(now()) . '1.' . $file->getClientOriginalExtension(),
                        'public'
                    );
                    $data['landing_page_banner'] = $path;
                }

                $deshboard = $this->healthHubDashboardRepo->first();

                if (isset($deshboard->id)) {
                    $deshboard->update($data);
                    return 1;
                } else {
                    $deshboard = $this->save($data);
                    return 2;
                }
            });

        } catch (\Exception $e) {
            Log::error('Error while saving deshboard : ' . $e->getMessage());
            return false;
        }
    }

}
