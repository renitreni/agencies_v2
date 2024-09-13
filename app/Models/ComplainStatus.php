<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplainStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'complain_id',
        'status',
    ];
}
