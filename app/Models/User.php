<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'username',
        'password',
        'user_role',
        'is_notify',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'id', 'user_id');
    }

    public function nailCustomization()
    {
        return $this->belongsTo(NailCustomization::class, 'id', 'user_id');
    }

    public function newActivity($activity, $type, $include_id = true)
    {
        if ($include_id) {
            $activity .= " : " . '<a class="text-blue-600 hover:underline" href="' . route('users.show', $this->id) . '">' . $this->first_name . " " . $this->last_name . "</a>";
        }

        Activity::create([
            'activity' => $activity,
            'type' => $type,
            'user_id' => \Auth::id(),
        ]);
    }
}
