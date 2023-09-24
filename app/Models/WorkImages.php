<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkImages extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'filename'
    ];

    public function staff()
    {
        return $this->belongsToMany(Staff::class);
    }
}
