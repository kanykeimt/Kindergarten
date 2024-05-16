<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = false;
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function child()
    {
        return $this->hasMany(Child::class, 'group_id','id');
    }
    public function attendance()
    {
        return $this->hasMany(ChildrenAttendance::class,'group_id','id');
    }
    public function news()
    {
        return $this->hasMany(News::class,'group_id','id');
    }
    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'group_id','id');
    }
}
