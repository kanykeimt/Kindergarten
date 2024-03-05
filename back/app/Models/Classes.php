<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
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

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
