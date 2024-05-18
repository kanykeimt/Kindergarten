<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaysOfWeek extends Model
{
    use HasFactory;
    protected $table = 'days_of_week';

    protected $guarded = false;
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
