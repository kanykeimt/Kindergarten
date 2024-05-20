<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $guarded = false;
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
    public function payment()
    {
        return $this->hasMany('App\Models\Payment');
    }
}
