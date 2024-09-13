<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'logo_path',
        'poea',
        'cr_no',
        'status',
        'owner_name',
        'contact_number',
        'created_by',
    ];

    public static function list()
    {
        return self::query()->select(['id', 'name'])->get()->toArray();
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function deprives()
    {
        return $this->hasMany(Deprive::class, 'agency_id', 'id');
    }

}
