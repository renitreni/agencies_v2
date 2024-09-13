<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'candidate_id',
        'filename',
        'path',
        'type',
        'created_by',
        'deleted_at',
    ];

    public function doc()
    {
        return $this->hasOne(OptionList::class, 'id', 'type');
    }
}
