<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $casts = [
        'images' => 'array ',
    ];
}
