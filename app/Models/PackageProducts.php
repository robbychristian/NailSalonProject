<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageProducts extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'package_id',
        'product_id'
    ];

    public function package()
    {
        return $this->belongsTo(Packages::class);
    }
}
