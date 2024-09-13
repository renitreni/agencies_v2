<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deprive extends Model
{
    protected $fillable = [
        'feature',
        'agency_id'
    ];
}
