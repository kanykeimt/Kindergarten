<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildAttendance extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $fillable = [
        'group_id', 'date', 'children',
        // Add other fields as needed
    ];

    protected $casts = [
        'children' => 'json',
    ];
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
