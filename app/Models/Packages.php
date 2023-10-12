<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packages extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'package_name',
        'package_description',
        'price'
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Bookings::class);
    }
}
