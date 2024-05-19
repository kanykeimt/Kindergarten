<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

//$time = Carbon::createFromFormat('H:i');
//$model = new Schedule();
//$model->time_from = $time->format('H:i');
//$model->save();
//$model->time_to = $time->format('H:i');
//$model->save();

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = false;
    public function classes()
    {
        return $this->belongsTo(Classes::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function day()
    {
        return $this->belongsTo(DaysOfWeek::class, 'day');
    }
}
