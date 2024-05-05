<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'teacher_id',
        'limit',
        'description',
        'image',
    ];
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function child()
    {
        return $this->hasMany(Child::class);
    }
    public function attendance()
    {
        return $this->hasMany(ChildAttendance::class);
    }
    public function gallery_address()
    {
        return $this->hasMany(GalleryAddress::class);
    }
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
