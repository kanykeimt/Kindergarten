<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_kg',
        'question_ru',
    ];

    protected function question(): Attribute
    {
        return Attribute::make(
            get: fn () => app()->getLocale() == 'kg' ? $this->question_kg : $this->question_ru
        );
    }
}
