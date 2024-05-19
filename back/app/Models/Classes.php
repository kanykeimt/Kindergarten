<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function getName()
    {
        $lang = app()->getLocale();
        if ($lang == 'kg'){
            return $this->name_kg;
        }
        elseif ($lang == 'ru'){
            return $this->name_ru;
        }
    }
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => app()->getLocale() == 'kg' ? $this->name_kg : $this->name_ru
        );
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
