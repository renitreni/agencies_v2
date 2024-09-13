<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rescue extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'candidate_id',
        'ip_address',
        'actual_latitude',
        'actual_longitude',
    ];

    public function candidate(): HasOne
    {
        return $this->hasOne(Candidate::class, 'id', 'candidate_id');
    }
}
