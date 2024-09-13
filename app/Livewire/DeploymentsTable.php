<?php

namespace App\Livewire;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class DeploymentsTable extends DataTableComponent
{
    protected $listeners = ['refreshDatatable' => '$refresh', 'outsideFilter'];

    public $params;
    public ?string $defaultSortColumn = 'created_at';

    public function configure(): void
    {
          $this->setPrimaryKey('id');
    }
    public function outsideFilter($data)
    {
        $this->params = $data;
        $this->render();
    }

    public function query(): Builder
    {
        return Voucher::selectRaw('vouchers.*, voucher_statuses.status_date,
        deployments.type,deployments.ppt,deployments.fit,deployments.contract_signing,
        foreign_agencies.agency_name')
            ->when(
                isset($this->params['deployed_from']) && isset($this->params['deployed_to']),
                function ($q) {
                    $q->whereBetween('voucher_statuses.status_date', [$this->params['deployed_from'], $this->params['deployed_to']]);
                }
            )
            ->where('vouchers.status', 'deployed')
            ->leftJoin('voucher_statuses', 'voucher_statuses.voucher_id', '=', 'vouchers.id')
            ->leftJoin('foreign_agencies', 'foreign_agencies.id', '=', 'vouchers.agency_id')
            ->leftJoin('deployments', 'deployments.voucher_id', '=', 'vouchers.id')
            ->when(isset($this->params['account']), function ($q) {
                $q->where('vouchers.created_by', $this->params['account']);
            }, fn ($q) => $q->where('vouchers.created_by', auth()->id()));
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->format(function ($value, $row, $data) {
                    return view('buttons.deployment-action', ['id' => $value]);
                })
                ->asHtml(),
            Column::make("Applicant", "name")
                ->searchable()
                ->sortable(),
            Column::make("Source", "source")
                ->searchable()
                ->sortable(),
            Column::make("FRA", "agency_name")
                ->searchable()
                ->sortable(),
            Column::make("Source", "status")
                ->searchable()
                ->sortable(),
            Column::make("Age", "deployments.age")
                ->searchable()
                ->sortable(),
            Column::make("Ticket", "ticket")
                ->searchable()
                ->sortable(),
            Column::make("Deployment Date", "status_date")
                ->sortable(),
            Column::make("Type", "deployments.type")
                ->searchable()
                ->sortable(),
            Column::make("Ppt", "deployments.ppt")
                ->sortable(),
            Column::make("Fit to Work", "deployments.fit")
                ->sortable(),
            Column::make("Contract signing", "deployments.contract_signing")
                ->sortable(),
        ];
    }
}
