<?php

namespace App\Livewire;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class VoucherV2Table extends DataTableComponent
{
    protected $listeners = ['refreshDatatable' => '$refresh', 'outsideFilter'];

    public mixed $params;

    public string $defaultSortDirection = 'desc';

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
        return Voucher::query()
            ->selectRaw('vouchers.*, users.email, foreign_agencies.agency_name, job_orders.foreign_agency_id, ve.amount')
            ->leftJoin('agencies', 'agencies.id', '=', 'vouchers.agency_id')
            ->leftJoin('job_orders', 'job_orders.voucher_id', '=', 'vouchers.id')
            ->leftJoin('foreign_agencies', 'foreign_agencies.id', '=', 'job_orders.foreign_agency_id')
            ->join('users', 'users.id', '=', 'vouchers.created_by')
            ->leftJoin(DB::raw('(select sum(amount) as amount, voucher_id from voucher_expenses where deleted_at is null group by voucher_id) as ve'),
                've.voucher_id', '=', 'vouchers.id')
            ->when(isset($this->params['account']), function ($q) {
                $q->where('users.id', $this->params['account']);
            }, fn ($q) => $q->where('users.id', Auth::id()));
    }

    public function columns(): array
    {
        return [
            Column::make('Action', 'id')
                ->format(function ($value) {
                    return view('buttons.voucher-action', ['id' => $value]);
                })
                ->asHtml(),
            Column::make('Total', 'amount')
                ->format(function ($value) {
                    return number_format($value, 2);
                })
                ->asHtml(),
            Column::make('Status', 'status')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    $attr = ' data-bs-toggle="modal" data-bs-target="#voucherStatusModal"
                      wire:click="$emitUp(\'editVoucher\', { \'id\' :'.$row->id.'})"';

                    if ($value == '') {
                        return view('buttons.secondary', [
                            'attr' => $attr,
                            'label' => 'None',
                        ]);
                    }
                    $message = 'text-warning';
                    $message = $value == 'deployed' ? 'text-success' : $message;
                    $message = $value == 'back-out' ? 'text-danger' : $message;

                    return view('buttons.light', [
                        'attr' => $attr,
                        'label' => "<div class='spinner-grow $message' role='status'></div>
                                        <div class='my-auto ms-2'>".Str::upper($value).'</div>',
                    ]);
                })
                ->asHtml(),
            Column::make('Job Order', 'agency_name')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    $attr = ' data-bs-toggle="modal" data-bs-target="#jobOrderModal"
                      wire:click="$emitUp(\'editJobOrder\', { \'id\':'.$row->id.', \'foreign_agency_id\':\''.$row->foreign_agency_id.'\'})"';

                    if ($value == '') {
                        return view('buttons.secondary', [
                            'attr' => $attr,
                            'label' => 'None',
                        ]);
                    }

                    return view('buttons.link', [
                        'attr' => $attr,
                        'label' => "<div class='text-dark font-weight-bold'>".Str::upper($value).'</div>',
                    ]);
                })
                ->asHtml(),
            Column::make('Created by', 'email')
                ->sortable(),
            Column::make('Applicants Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Source', 'source')
                ->sortable()
                ->searchable(),
            Column::make('Created at', 'created_at')
                ->sortable()
                ->format(fn ($value) => Carbon::parse($value)->format('F j, Y')),
            Column::make('Updated at', 'updated_at')
                ->sortable()
                ->format(fn ($value) => Carbon::parse($value)->format('F j, Y')),
        ];
    }
}
