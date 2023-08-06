<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionStatusDoctime extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction_status_doctime';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'contact_no',
        'service',
        'service_id',
        'amount',
        'payment_status',
        'transaction_time',
        'transaction_id',
        'remarks',
        'promo_code'
    ];
}
