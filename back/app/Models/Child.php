<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'birth_date',
        'gender',
        'parent_id',
        'group_id',
        'photo',
        'birth_certificate',
        'med_certificate',
        'med_disability',
    ];
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
