<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class testModel extends Model
{
    protected $casts = [
        'created_at' => 'date',
        'updated_at' => 'date',
    ];
}
