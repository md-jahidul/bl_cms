<?php
namespace App\Repositories\HealthHubNewJourney;

use App\Models\HealthHubNewJourney\HealthHubDashboard;
use App\Repositories\BaseRepository;

class HealthHubDashboardRepository extends BaseRepository
{
    public $modelName = HealthHubDashboard::class;

    public function first(){
        return (HealthHubDashboard::first());
    }
}
