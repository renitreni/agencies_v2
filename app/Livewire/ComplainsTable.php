<?php

namespace App\Livewire;

use App\Models\Complains;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ComplainsTable extends DataTableComponent
{
    public string $defaultSortColumn = 'id';

    public string $defaultSortDirection = 'desc';

    public ?string $defaultSortColumn = 'created_at';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Action', 'id')
                ->format(function ($value) {
                    return view('buttons.primary',
                        ['id' => $value, 'label' => 'VIEW', 'listener' => 'editCase', 'modal' => 'caseDetailModal']);
                })
                ->asHtml(),
            Column::make('Status', 'status')
                ->searchable()
                ->sortable(),
            Column::make('Created at', 'created_at')
                ->format(function ($value) {
                    return Carbon::parse($value)->format('F j, Y');
                })
                ->sortable(),
            Column::make('Agency', 'agency')
                ->searchable()
                ->sortable(),
            Column::make('Agency owner', 'agencyDetails.owner_name')
                ->searchable()
                ->sortable(),
            Column::make('Agency contact', 'agencyDetails.contact_number')
                ->searchable()
                ->sortable(),
            Column::make('Foreign agency', 'foreign_agency')
                ->searchable()
                ->sortable(),
            Column::make('Company', 'company')
                ->searchable()
                ->sortable(),
            Column::make('National id', 'national_id')
                ->searchable()
                ->sortable(),
            Column::make('Passport', 'passport')
                ->searchable()
                ->sortable(),
            Column::make('Full name', 'full_name')
                ->searchable()
                ->sortable(),
            Column::make('Gender', 'gender')
                ->sortable(),
            Column::make('Birth date', 'birth_date')
                ->sortable(),
            Column::make('Contact person', 'contact_person')
                ->sortable(),
            Column::make('Occupation', 'occupation')
                ->sortable(),
            Column::make('Email address', 'email_address')
                ->sortable(),
            Column::make('Contact number', 'contact_number')
                ->sortable(),
            Column::make('Contact number2', 'contact_number2')
                ->sortable(),
            Column::make('Address abroad', 'address_abroad')
                ->sortable(),
            Column::make('Employer contact', 'employer_contact')
                ->sortable(),
            Column::make('Actual latitude', 'actual_latitude')
                ->sortable(),
            Column::make('Actual longitude', 'actual_longitude')
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Complains::query()
            ->selectRaw('complains.*, cs.status')
            ->leftJoin('complain_statuses as cs', 'cs.complain_id', '=', 'complains.id');
    }
}
