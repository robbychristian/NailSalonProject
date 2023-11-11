<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAddOns extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'additional',
        'additional_price'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Bookings::class);
    }

    public function newActivity($activity, $type, $include_id = true)
    {
        if ($include_id) {
            $activity .= " : " . '<a class="text-blue-600 hover:underline" href="' . route('product-add-ons.index') . '">' . $this->additional . "</a>";
        }

        Activity::create([
            'activity' => $activity,
            'type' => $type,
            'user_id' => \Auth::id(),
        ]);
    }
}
