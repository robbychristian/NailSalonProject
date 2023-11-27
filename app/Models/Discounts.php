<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discounts extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'discount_name',
        'discount_desc',
        'service_id',
        'product_id',
        'discount_percent'
    ];

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
