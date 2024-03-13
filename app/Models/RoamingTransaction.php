<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoamingTransaction extends Model
{
    protected $table = 'roaming_transactions';

    protected $fillable = [
        'msisdn',
        "email",
        'transaction_type',
        'user_type',
        'transaction_id',
        'session_id',
        "bank_transaction_id",
        'val_id',
        'transaction_status',
        'account_id',
        'roaming_transaction_id',
        'status',
        'amount_bdt',
        'amount_usd',
        'payment_initiated',
        'payment_complete',
        'barred_keys',
        'da_posting',
        'deposit',
        'invoice_payment',
        "refund_initiated",
        "refund_status",
        "refund_ref_id",
        "un_barred_flags"
    ];
}
