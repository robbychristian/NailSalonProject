<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_name',
        'service_id',
        'price',
    ];

    public function serviceType()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }
}
