<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $fillable = [
        'candidate_id',
        'fullname',
        'gender',
        'age',
        'birthdate',
    ];
}
