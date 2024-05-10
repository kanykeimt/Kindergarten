<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone_number',
        'resume',
        'answers'
    ];
    protected $casts = [
        'answers' => 'json',
    ];
}
