<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class audio_detail extends Model
{
    use HasFactory;
    protected $table = 'audio_detail';
    protected $fillable = [
        'id',
        'type',
        'connectivity',
        'color',
        'driver_size',
        'cable_length',
        'charging_time',
        'usage_time',
        'decription',
        'product_id'
    ];
    public function product(){
        return $this->belongsTo(product::class);
    }
}
