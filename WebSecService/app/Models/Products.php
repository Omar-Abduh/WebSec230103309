<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'code',
        'name',
        'price',
        'model',
        'description',
        'photo'
    ];
}
