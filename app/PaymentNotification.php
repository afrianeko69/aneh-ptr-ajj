<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentNotification extends Model
{
    protected $table = 'payment_notifications';

    public static $rules = [
        'masked_card',
        'approval_code',
        'bank',
        'eci',
        'transaction_time',
        'gross_amount',
        'order_id',
        'payment_type',
        'signature_key',
        'status_code',
        'transaction_id',
        'transaction_status',
        'fraud_status',
        'status_message',
        'json'
    ];

    protected $fillable = [
        'masked_card',
        'approval_code',
        'bank',
        'eci',
        'transaction_time',
        'gross_amount',
        'order_id',
        'payment_type',
        'signature_key',
        'status_code',
        'transaction_id',
        'transaction_status',
        'fraud_status',
        'status_message',
        'updated_at',
        'created_at',
        'json'
    ];

    public function order() {
        return $this->belongsTo('App\Order', 'order_id', 'order_number');
    }
}
