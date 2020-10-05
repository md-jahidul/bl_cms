<?php

namespace App\Models;

use App\CustomerContactBackup;
use Illuminate\Database\Eloquent\Model;

class MyBlContactRestoreLog extends Model
{
    protected $fillable = [
        'contact_backup_id',
        'message',
        'date_time',
        'platform',
        'device_os',
        'device_model',
        'mobile_number',
        'total_number_to_be_restore',
        'total_restore',
    ];

    public function contactBackup()
    {
        return $this->belongsTo(CustomerContactBackup::class, 'contact_backup_id', 'id');
    }
}
