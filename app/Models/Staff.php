<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'staff_name',
        'staff_image'
    ];

    public function services()
    {
        return $this->belongsToMany(Services::class);
    }

    public function workImages()
    {
        return $this->belongsToMany(WorkImages::class);
    }
}