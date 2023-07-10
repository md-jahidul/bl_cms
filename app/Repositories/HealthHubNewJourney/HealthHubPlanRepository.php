<?php
namespace App\Repositories\HealthHubNewJourney;

use App\Models\HealthHubNewJourney\HealthHubPackage;
use App\Models\HealthHubNewJourney\HealthHubPlan;
use App\Repositories\BaseRepository;

class HealthHubPlanRepository extends BaseRepository
{
    public $modelName = HealthHubPlan::class;

    public function destroy($id)
    {
        return HealthHubPlan::where('id',$id)->delete();
    }
}
