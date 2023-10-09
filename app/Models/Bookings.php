<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookings extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'date',
        'time_in',
        'time_out',
        'branch_id',
        'staff_id',
    ];

    public function packages()
    {
        return $this->belongsToMany(Packages::class);
    }

    public function products()
    {
        return $this->belongsToMany(Products::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'user_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branches::class, 'branch_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(Payments::class, 'id', 'booking_id');
    }
}