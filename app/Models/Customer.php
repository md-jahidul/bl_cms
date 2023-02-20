<?php

namespace App\Models;

use App\Services\BlApiHub\CustomerConnectionTypeService;
use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * @package App\Models
 */
class Customer extends Model
{
    use LogModelAction;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public static function connectionType(Customer $customer)
    {
        $customer_service = new CustomerConnectionTypeService();
        return $customer_service->getConnectionTypeInfo($customer->msisdn);
    }

    public function logout()
    {
        return $this->hasOne(LogoutTrack::class);
    }
}
