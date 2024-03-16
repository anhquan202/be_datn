<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'receiver_address',
        'receiver_phone',
        'total_amount',
        'payment_method',
        'invoice_date',
        'status',
        'customer_id'
    ];
    public function details()
    {
        return $this->hasMany(invoice_detail::class);
    }
    public function customer(){
        return $this->belongsTo(customer::class);
    }
}
