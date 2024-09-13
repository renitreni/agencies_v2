<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        "details",
        "serial_no",
        "name",
        "status",
        "agency_id",
        "requisite_id",
        "approved_by",
    ];

    public function agency()
    {
        return $this->hasOne(Agency::class, 'id', 'agency_id');
    }

    public function requisition()
    {
        return $this->hasOne(Requisition::class, 'id', 'requisite_id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('F j, Y H:iA');
    }
}
