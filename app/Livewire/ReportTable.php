<?php

namespace App\Livewire;

use App\Models\Report;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ReportTable extends DataTableComponent
{
    public ?string $defaultSortColumn = 'created_at';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),
            Column::make('From', 'fullname')
                ->searchable(function ($q, $v) {
                    $q->orWhere('c.last_name', 'LIKE', "%$v%")->orWhere('c.first_name', 'LIKE', "%$v%");
                })
                ->sortable(),
            Column::make('Salary received', 'salary_received')
                ->sortable(),
            Column::make('Salary date', 'salary_date')
                ->sortable(),
            Column::make('Remarks', 'remarks')
                ->searchable()
                ->sortable(),
            Column::make('Created at', 'created_at')
                ->sortable(),
            Column::make('Updated at', 'updated_at')
                ->sortable(),
        ];
    }

    public function query()
    {
        return Report::query()
            ->selectRaw('reports.*, CONCAT(c.last_name, \', \', c.first_name) as fullname')
            ->leftJoin('candidates as c', 'c.id', '=', 'reportable_id');
    }
}
