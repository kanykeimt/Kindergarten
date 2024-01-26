<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $table = 'children';
    protected $guarded = false;

    protected $fillable = [
        'group_id', 'name',
        // Add other fields as needed
    ];
    public function group()
    {
        return $this->belongsTo('App\Models\Group','group_id');
    }
    public function parent()
    {
        return $this->belongsTo('App\Models\User','parent_id');
    }
}
