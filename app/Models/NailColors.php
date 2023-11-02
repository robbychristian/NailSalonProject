<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NailColors extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'color'
    ];
}
