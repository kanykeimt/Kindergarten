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

    protected $guarded = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];

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
    public function role_name()
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
