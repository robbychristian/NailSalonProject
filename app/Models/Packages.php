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
        'price'
    ];

    public function products()
    {
        return $this->hasMany(PackageProducts::class, 'package_id');
    }
}
