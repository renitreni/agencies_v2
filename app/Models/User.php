<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed $agency_id
 * @property mixed $role
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'role',
        'agency_id',
        'information_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function noInfoIds()
    {
        return (new static)->newQuery()
            ->selectRaw('users.id')
            ->leftJoin('information as inf', 'inf.user_id', '=', 'users.id')
            ->whereNull('inf.user_id')
            ->pluck('id');
    }

    public function getEmployersByAgency($id)
    {
        return $this->newQuery()->where('agency_id', $id)->where('role', 3)->with(['information', 'employee']);
    }

    public function getAffiliatesByAgency($id)
    {
        return $this->newQuery()->where('agency_id', $id)->where('role', 5)->with(['information']);
    }

    public static function getEmployersIds()
    {
        return (new static)->newQuery()->where('role', 3)->pluck('id');
    }

    public static function getAffiliateIds()
    {
        return (new static)->newQuery()->where('role', 5)->pluck('id');
    }

    public function employee()
    {
        return $this->hasMany(Candidate::class, 'employer_id', 'id');
    }

    public function information()
    {
        return $this->belongsTo(Information::class, 'information_id', 'id');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'id');
    }

    public function password(): Attribute
    {
        return Attribute::make(set: fn ($value) => bcrypt($value));
    }

    public function tableQuery()
    {
        return $this->newQuery()
            ->selectRaw('users.*, agency.name as agency_name, information.name')
            ->leftJoin('information', 'information.id', '=', 'users.information_id')
            ->leftJoin('agencies as agency', 'agency.id', '=', 'users.agency_id');
    }
}
