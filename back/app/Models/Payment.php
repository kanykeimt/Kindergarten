<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'date_from',
        'date_to',
        'payment_amount',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
