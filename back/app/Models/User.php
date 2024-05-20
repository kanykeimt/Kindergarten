<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = false;

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
        'password' => 'hashed',
    ];

    public function group()
    {
        return $this->hasOne(Group::class,'teacher_id','id');
    }
    public function child()
    {
        return $this->hasMany(Child::class,'parent_id','id');
    }
    public function enroll()
    {
        return $this->hasMany(Enroll::class, 'parent_id', 'id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role');
    }
    public function review()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function chatsSent()
    {
        return $this->hasMany(Chat::class, 'from_user_id');
    }

    public function chatsReceived()
    {
        return $this->hasMany(Chat::class, 'to_user_id');
    }
}
