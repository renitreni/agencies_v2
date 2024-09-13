<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Tags\HasTags;

/**
 * php artisan scout:import 'App\Models\Candidate'
 */
class Candidate extends Model
{
    use HasFactory;
    use HasTags;
    use Searchable;

    protected $fillable = [
        'address',
        'agency_branch',
        'agency_id',
        'agreed',
        'applied_using',
        'birth_date',
        'birth_place',
        'blood_type',
        'civil_status',
        'code',
        'contact_1',
        'contact_2',
        'date_hired',
        'deleted_at',
        'doe',
        'dos',
        'education',
        'email',
        'father_name',
        'fb_account',
        'first_name',
        'gender',
        'height',
        'id',
        'iqama',
        'kin',
        'kin_address',
        'kin_contact',
        'kin_relationship',
        'language',
        'last_name',
        'middle_name',
        'mother_name',
        'passport',
        'photo_url',
        'picfull',
        'place_issue',
        'position_1',
        'position_2',
        'position_3',
        'position_selected',
        'religion',
        'remarks',
        'salary',
        'skills',
        'spouse',
        'status',
        'travel_status',
        'updated_at',
        'voucher_id',
        'weight',
    ];

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return config('scout.algolia.index');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only('first_name', 'last_name', 'passport', 'iqama');
    }

    public function employment()
    {
        return $this->hasMany(EmploymentHistory::class, 'candidate_id', 'id');
    }

    public function document()
    {
        return $this->hasMany(Document::class, 'candidate_id', 'id');
    }

    public function documentCV()
    {
        return $this->hasMany(Document::class, 'candidate_id', 'id');
    }

    public function documentPic1x1()
    {
        return $this->hasOne(Document::class, 'candidate_id', 'id')->where('type', 'pic1x1');
    }

    public function documentPicFull()
    {
        return $this->hasOne(Document::class, 'candidate_id', 'id')->where('type', 'picfull');
    }

    public function agency()
    {
        return $this->hasOne(Agency::class, 'id', 'agency_id');
    }

    public function employer()
    {
        return $this->hasOne(Information::class, 'user_id', 'employer_id');
    }

    public function affiliates()
    {
        return $this->hasOne(Information::class, 'user_id', 'agency_abroad_id');
    }

    public static function belongsToAgency($id, $agency_id)
    {
        return (new static)->where('id', $id)->where('agency_id', $agency_id)->count() > 0;
    }

    public static function belongsToEmployer($id, $agency_id)
    {
        return (new static)->where('id', $id)->where('employer_id', $agency_id)->count() > 0;
    }

    public function report()
    {
        return $this->morphMany(Report::class, 'reportable')->orderBy('created_at', 'desc');
    }
}
