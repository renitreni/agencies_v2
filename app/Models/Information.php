<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    public $fillable = [
        'user_id',
        'national_id',
        'name',
        'tin',
        'address_line_1',
        'address_line_2',
        'city',
        'zip_code',
        'contact_name',
        'phone',
        'fax',
        'email',
        'status',
        'type',
        'poea',
        'created_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
