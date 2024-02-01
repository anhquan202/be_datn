<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    protected $fillable = [
        'id',
        'orderer_name',
        'receiver_name',
        'receiver_address',
        'receiver_phone',
        'total_amount',
        'payment_method',
        'invoice_date',
        'status',
        'customer_id'
    ];
}
