<?php

namespace App\Livewire\Table;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class VoucherTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Voucher::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('id')
            ->add('agency_id')
            ->add('name')
            ->add('status')
            ->add('source')
            ->add('requirements')
            ->add('passporting_allowance')
            ->add('ticket')
            ->add('tesda_allowance')
            ->add('nbi_renewal')
            ->add('medical_allowance')
            ->add('pdos')
            ->add('info_sheet')
            ->add('owwa_allowance')
            ->add('office_allowance')
            ->add('travel_allowance')
            ->add('weekly_allowance')
            ->add('medical_follow_up')
            ->add('created_by')
            ->add('nbi_refund')
            ->add('psa_refund')
            ->add('passport_refund')
            ->add('fare_refund')
            ->add('red_rebon_nbi')
            ->add('fit_to_work')
            ->add('repat')
            ->add('stamping')
            ->add('vaccine_fare')
            ->add('ticket_to_kuwait')
            ->add('ticket_to_qatar')
            ->add('agent')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::action('Action'),

            Column::make('Id', 'id')->hidden(),
            Column::make('Agency id', 'agency_id')
                ->sortable()
                ->searchable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Source', 'source')
                ->sortable()
                ->searchable(),

            Column::make('Requirements', 'requirements')
                ->sortable()
                ->searchable(),

            Column::make('Passporting allowance', 'passporting_allowance')
                ->sortable()
                ->searchable(),

            Column::make('Ticket', 'ticket')
                ->sortable()
                ->searchable(),

            Column::make('Tesda allowance', 'tesda_allowance')
                ->sortable()
                ->searchable(),

            Column::make('Nbi renewal', 'nbi_renewal')
                ->sortable()
                ->searchable(),

            Column::make('Medical allowance', 'medical_allowance')
                ->sortable()
                ->searchable(),

            Column::make('Pdos', 'pdos')
                ->sortable()
                ->searchable(),

            Column::make('Info sheet', 'info_sheet')
                ->sortable()
                ->searchable(),

            Column::make('Owwa allowance', 'owwa_allowance')
                ->sortable()
                ->searchable(),

            Column::make('Office allowance', 'office_allowance')
                ->sortable()
                ->searchable(),

            Column::make('Travel allowance', 'travel_allowance')
                ->sortable()
                ->searchable(),

            Column::make('Weekly allowance', 'weekly_allowance')
                ->sortable()
                ->searchable(),

            Column::make('Medical follow up', 'medical_follow_up')
                ->sortable()
                ->searchable(),

            Column::make('Created by', 'created_by')
                ->sortable()
                ->searchable(),

            Column::make('Nbi refund', 'nbi_refund')
                ->sortable()
                ->searchable(),

            Column::make('Psa refund', 'psa_refund')
                ->sortable()
                ->searchable(),

            Column::make('Passport refund', 'passport_refund')
                ->sortable()
                ->searchable(),

            Column::make('Fare refund', 'fare_refund')
                ->sortable()
                ->searchable(),

            Column::make('Red rebon nbi', 'red_rebon_nbi')
                ->sortable()
                ->searchable(),

            Column::make('Fit to work', 'fit_to_work')
                ->sortable()
                ->searchable(),

            Column::make('Repat', 'repat')
                ->sortable()
                ->searchable(),

            Column::make('Stamping', 'stamping')
                ->sortable()
                ->searchable(),

            Column::make('Vaccine fare', 'vaccine_fare')
                ->sortable()
                ->searchable(),

            Column::make('Ticket to kuwait', 'ticket_to_kuwait')
                ->sortable()
                ->searchable(),

            Column::make('Ticket to qatar', 'ticket_to_qatar')
                ->sortable()
                ->searchable(),

            Column::make('Agent', 'agent')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Voucher $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="fas fa-pencil"></i>')
                ->id()
                ->class('btn btn-sm btn-primary')
                ->dispatch('editVoucher', ['id' => $row->id]),
            Button::add('edit-expenses')
                ->slot('<i class="fas fa-receipt"></i>')
                ->id()
                ->class('btn btn-sm btn-warning')
                ->dispatch('editExpenses', ['id' => $row->id]),

        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
