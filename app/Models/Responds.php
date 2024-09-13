<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responds extends Model
{
    use HasFactory;

    protected $fillable = [
        'rescue_id',
        'status',
        'feedback',
        'inserted_by',
    ];
}
