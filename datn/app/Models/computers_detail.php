<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class computers_detail extends Model
{
    use HasFactory;
    protected $table = 'computers_detail';
    protected $fillable = [
        'id',
        'type',
        'processor',
        'ram',
        'storage',
        'graphics',
        'operating_system',
        'decription',
        'product_id'
    ];
    public function product(){
        return $this->belongsTo(product::class);
    }
}
