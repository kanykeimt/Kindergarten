<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenAttendance extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $fillable = [
        'group_id', 'date', 'attendance',
        // Add other fields as needed
    ];

    protected $casts = [
        'attendance' => 'json',
    ];
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
