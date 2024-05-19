<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => app()->getLocale() == 'kg' ? $this->name_kg : $this->name_ru
        );
    }
}
