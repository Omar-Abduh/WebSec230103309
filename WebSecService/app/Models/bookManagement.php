<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bookManagement extends Model
{
    protected $fillable = [
        'title',
        'author',
        'published_year'
    ];
}
