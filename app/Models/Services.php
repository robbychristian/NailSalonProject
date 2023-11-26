<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_name',
        'service_description'
    ];

    public function staff()
    {
        return $this->belongsToMany(Staff::class);
    }

    public function newActivity($activity, $type, $include_id = true)
    {
        if ($include_id) {
            $activity .= " : " . '<a class="text-blue-600 hover:underline" href="' . route('services.index') . '">' . $this->service_name . "</a>";
        }

        Activity::create([
            'activity' => $activity,
            'type' => $type,
            'user_id' => \Auth::id(),
        ]);
    }

    public function schedule()
    {
        return $this->belongsToMany(Schedule::class);
    }
}
