<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'middle_name',
        'birthday',
        'contact_no',
        'street',
        'region',
        'province',
        'city',
        'barangay',
        'postal_code'
    ];
}
