<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_detail extends Model
{
    use HasFactory;
    protected $table = 'invoice_detail';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'quantity',
        'unit_price',
        'total_price',
        'invoice_id',
        'product_id'
    ];
}
