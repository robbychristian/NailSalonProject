<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_name',
        'product_description',
        'service_id',
        'price',
    ];

    public function serviceType()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }

    public function package()
    {
        return $this->belongsToMany(Packages::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Bookings::class);
    }

    public function newActivity($activity, $type, $include_id = true)
    {
        if ($include_id) {
            $activity .= " : " . '<a class="text-blue-600 hover:underline" href="' . route('products.index') . '">' . $this->product_name . "</a>";
        }

        Activity::create([
            'activity' => $activity,
            'type' => $type,
            'user_id' => \Auth::id(),
        ]);
    }
}
