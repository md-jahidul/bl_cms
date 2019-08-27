<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 1:14 PM
 */

namespace App\Repositories;


use App\Models\Campaign;

class CampaignRepository extends BaseRepository
{
    public $modelName = Campaign::class;
}