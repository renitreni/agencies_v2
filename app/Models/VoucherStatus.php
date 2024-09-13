<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id',
        'status',
        'status_date',
        'remarks'
    ];
}
