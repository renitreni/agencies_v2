<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'agency_id',
        'name',
        'status',
        'source',
        'requirements',
        'passporting_allowance',
        'ticket',
        'tesda_allowance',
        'nbi_renewal',
        'medical_allowance',
        'pdos',
        'info_sheet',
        'owwa_allowance',
        'office_allowance',
        'travel_allowance',
        'weekly_allowance',
        'medical_follow_up',
        'created_by',
        'nbi_refund',
        'psa_refund',
        'passport_refund',
        'fare_refund',
        'red_rebon_nbi',
        'fit_to_work',
        'repat',
        'stamping',
        'vaccine_fare',
        'ticket_to_kuwait',
        'ticket_to_qatar',
        'foreign_agency_id',
        'agent',
    ];


    public function deployments()
    {
        return $this->hasOne(Deployment::class);
    }

    public function voucher_statuses()
    {
        return $this->hasOne(VoucherStatus::class);
    }

    public function jobOrder()
    {
        return $this->hasOne(JobOrder::class, 'voucher_id');
    }

    public function information(): HasOne
    {
        return $this->hasOne(Information::class, 'user_id', 'created_by');
    }

    public function users(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function agency(): HasOne
    {
        return $this->hasOne(Agency::class, 'id', 'agency_id');
    }

    public function name(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function status(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function source(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function requirements(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function passportingAllowance(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function ticket(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function tesdaAllowance(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function nbiRenewal(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function pdos(): Attribute
    {

        return Attribute::set(fn($value) => trim($value));
    }

    public function infoSheet(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function medicalAllowance(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function owwaAllowance(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function officeAllowance(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function travelAllowance(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function weeklyAllowance(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function medicalFollowUp(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function nbiRefund(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function psaRefund(): Attribute
    {

        return Attribute::set(fn($value) => trim($value));
    }

    public function passportRefund(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function fareRefund(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function redRebonNbi(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function fitToWork(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function repat(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function stamping(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }

    public function vaccineFare(): Attribute
    {
        return Attribute::set(fn($value) => trim($value));
    }
}
