<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'reportable_id',
        'reportable_type',
        'created_by',
        'salary_received',
        'salary_date',
        'remarks',
        'priority_level',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the parent reportable model (candidate or agency).
     */
    public function reportable(): MorphTo
    {
        return $this->morphTo();
    }
}
