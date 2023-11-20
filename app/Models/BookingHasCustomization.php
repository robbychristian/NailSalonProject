<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHasCustomization extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'service_type',
        'nail_polish_brand',
        'nail_size',
        'has_extensions',
        'color',
        'skin'
    ];
}
