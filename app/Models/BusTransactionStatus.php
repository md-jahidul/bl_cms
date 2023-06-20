<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class BusTransactionStatus extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bus_transaction_status';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'ticket_id',
        'ticket_no',
        'from_station',
        'to_station',
        'time',
        'bus_name',
        'amount',
        'passenger_name',
        'passenger_email',
        'passenger_mobile',
        'booked_at',
        'confirmed_at',
        'cancelled_at',
        'expiry_time',
    ];
}
