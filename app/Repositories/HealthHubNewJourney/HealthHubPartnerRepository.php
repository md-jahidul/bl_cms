<?php
namespace App\Repositories\HealthHubNewJourney;

use App\Models\HealthHubNewJourney\HealthHubDashboard;
use App\Models\HealthHubNewJourney\HealthHubPartner;
use App\Repositories\BaseRepository;

class HealthHubPartnerRepository extends BaseRepository
{
    public $modelName = HealthHubPartner::class;

    public function destroy($id)
    {
        return HealthHubPartner::where('id',$id)->delete();
    }
}
