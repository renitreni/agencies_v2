<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'header_name',
    ];
}
