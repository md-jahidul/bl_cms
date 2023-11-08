<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnMobileTransactionStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'on_mobile_transaction_status';

    protected $fillable = [
        'createdAt',
        'msisdn',
        'transaction_id',
        'status',
        'amount',
        'subscriptionId',
        'event'
    ];
}
