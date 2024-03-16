<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'product';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'cost_in',
        'cost_out',
        'image',
        'quantity',
        'manufacture',
        'type_id'
    ];
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
