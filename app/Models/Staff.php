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
        'staff_image',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'user_id', 'user_id');
    }

    public function services()
    {
        return $this->belongsToMany(Services::class);
    }

    public function workImages()
    {
        return $this->belongsToMany(WorkImages::class);
    }

    public function newActivity($activity, $type, $include_id = true)
    {
        if ($include_id) {
            $activity .= " : " . '<a class="text-blue-600 hover:underline" href="' . route('staff.index') . '">' . $this->staff_name . "</a>";
        }


        Activity::create([
            'activity' => $activity,
            'type' => $type,
            'user_id' => \Auth::id(),
        ]);
    }
}
