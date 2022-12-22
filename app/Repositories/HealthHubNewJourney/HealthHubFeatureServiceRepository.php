<?php
namespace App\Repositories\HealthHubNewJourney;

use App\Models\HealthHubNewJourney\HealthHubService;
use App\Repositories\BaseRepository;

class HealthHubFeatureServiceRepository extends BaseRepository
{
    public $modelName = HealthHubService::class;

    public function destroy($id)
    {
        return HealthHubService::where('id',$id)->delete();
    }
}
