<?php
namespace App\Repositories\HealthHubNewJourney;

use App\Models\HealthHubNewJourney\HealthHubPackage;
use App\Repositories\BaseRepository;

class HealthHubPackageRepository extends BaseRepository
{
    public $modelName = HealthHubPackage::class;

    public function destroy($id)
    {
        return HealthHubPackage::where('id',$id)->delete();
    }
}
