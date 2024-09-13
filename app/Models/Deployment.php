<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id',
        'ppt',
        'fit',
        'contract_signing',
        'type',
        'age',
        'ticket_deployment'
    ];
}
