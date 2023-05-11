<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTransactionItem extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_transaction_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'invoice_id',
        'final_price',
        'actual_price',
        'catalog_sku_id',
        'default_discount',
        'catalog_product_id'
    ];

}
