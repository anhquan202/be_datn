<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phone_detail extends Model
{
    use HasFactory;
    protected $table = 'phone_detail';
    protected $fillable = [
        'id',
        'color',
        'camera',
        'screen',
        'operating_system',
        'ram',
        'rom',
        'decription',
        'product_id'
    ];
    public function product(){
        return $this->belongsTo(product::class);
    }
}
