<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCredit extends Model
{
    protected $fillable = [
        'user_id',
        'credit_amount',
    ];
}
