<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTransactionStatus extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_transaction_status';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'invoice_id',
        'contact_no',
        'sub_total',
        'promo_code',
        'total_promo_discount',
        'total_default_discount',
        'order_total_price'
    ];
}
