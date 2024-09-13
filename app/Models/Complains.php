<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complains extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'agency',
        'agency_id',
        'foreign_agency',
        'foreign_agency_id',
        'company',
        'company_id',
        'full_name',
        'gender',
        'birth_date',
        'contact_person',
        'national_id',
        'passport',
        'occupation',
        'email_address',
        'contact_number',
        'contact_number2',
        'address_abroad',
        'employer_contact',
        'complaint',
        'image1',
        'image2',
        'image3',
        'actual_latitude',
        'actual_longitude',
        'created_at',
    ];

    public function agencyDetails()
    {
        return $this->hasOne(Agency::class, 'id', 'agency_id');
    }
}
