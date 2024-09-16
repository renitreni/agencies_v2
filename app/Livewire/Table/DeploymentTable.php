<?php

namespace App\Livewire\Table;

use App\Models\Voucher;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class DeploymentTable extends PowerGridComponent
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
        return Voucher::selectRaw('vouchers.*, voucher_statuses.status_date,
        deployments.type,deployments.ppt,deployments.fit,deployments.contract_signing,deployments.age,
        foreign_agencies.agency_name')
            ->when(
                isset($this->params['deployed_from']) && isset($this->params['deployed_to']),
                function ($q) {
                    $q->whereBetween('voucher_statuses.status_date', [$this->params['deployed_from'], $this->params['deployed_to']]);
                }
            )
            ->where('vouchers.status', 'deployed')
            ->leftJoin('voucher_statuses', 'voucher_statuses.voucher_id', '=', 'vouchers.id')
            ->leftJoin('job_orders', 'job_orders.voucher_id', '=', 'vouchers.id')
            ->leftJoin('foreign_agencies', 'foreign_agencies.id', '=', 'job_orders.foreign_agency_id')
            ->leftJoin('deployments', 'deployments.voucher_id', '=', 'vouchers.id')
            ->when(isset($this->params['account']), function ($q) {
                $q->where('vouchers.created_by', $this->params['account']);
            }, fn($q) => $q->where('vouchers.created_by', Auth::id()));
    }

    public function relationSearch(): array
    {
        return [

        ];
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
            ->add('foreign_agency_id')
            ->add('agent')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')->hidden(),
            Column::action('Action'),
            Column::make('Applicant', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Source', 'source')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),
            Column::make('FRA', 'agency_name', 'foreign_agencies.agency_name')
                ->searchable()
                ->sortable(),
            Column::make('Source', 'status')
                ->searchable()
                ->sortable(),
            Column::make('Age', 'deployments.age')
                ->searchable()
                ->sortable(),
            Column::make('Ticket', 'ticket')
                ->searchable()
                ->sortable(),
            Column::make('Deployment Date', 'status_date')
                ->sortable(),
            Column::make('Type', 'deployments.type')
                ->searchable()
                ->sortable(),
            Column::make('Ppt', 'deployments.ppt')
                ->sortable(),
            Column::make('Fit to Work', 'deployments.fit')
                ->sortable(),
            Column::make('Contract signing', 'deployments.contract_signing')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(Voucher $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="fas fa-pencil"></i>')
                ->id()
                ->class('btn btn-sm btn-primary m-0')
                ->dispatch('edit-deployment', ['id' => $row->id])
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
