<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
