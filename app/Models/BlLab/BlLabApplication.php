<?php

namespace App\Models\BlLab;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BlLabApplication extends Model
{
    public function summary(): HasOne
    {
        return $this->hasOne(BlLabSummary::class, 'bl_lab_app_id', 'id');
    }

    public function personal(): HasOne
    {
        return $this->hasOne(BlLabPersonalInfo::class, 'bl_lab_app_id', 'id');
    }

    public function startup(): HasOne
    {
        return $this->hasOne(BlLabStartupInfo::class, 'bl_lab_app_id', 'id');
    }
}
