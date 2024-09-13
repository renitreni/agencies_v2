<?php

namespace App\Livewire;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class VoucherTable extends DataTableComponent
{
    public $params;

    public string $defaultSortDirection = 'desc';

    public ?string $defaultSortColumn = 'created_at';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Voucher::query()
            ->selectRaw('vouchers.*, users.email, foreign_agencies.agency_name, job_orders.foreign_agency_id')
            ->leftJoin('agencies', 'agencies.id', '=', 'vouchers.agency_id')
            ->leftJoin('job_orders', 'job_orders.voucher_id', '=', 'vouchers.id')
            ->leftJoin('foreign_agencies', 'foreign_agencies.id', '=', 'job_orders.foreign_agency_id')
            ->join('users', 'users.id', '=', 'vouchers.created_by')
            ->when(isset($this->params['account']), function ($q) {
                $q->where('users.id', $this->params['account']);
            }, fn ($q) => $q->where('users.id', Auth::user()->id));
    }

    public function columns(): array
    {
        return [
            Column::make('Action', 'id')
                ->format(function ($value) {
                    return view('buttons.voucher-action', ['id' => $value]);
                })
                ->html(),
            Column::make('Total', 'id')
                ->format(function ($value, $row) {
                    $total = 0;
                    foreach ($row->toArray() as $item) {
                        if ($item) {
                            preg_match_all('/\(([\d\,\.]+)/', $item, $matches);
                        }
                        foreach ($matches[1] as $amount) {
                            $total += floatval(str_replace(',', '', $amount));
                        }
                    }

                    return number_format($total, 2);
                }),
            Column::make('Status', 'status')
                ->sortable()
                ->format(function ($value, $row) {
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
                ->html(),
            Column::make('Job Order', 'agency_name')
                ->sortable()
                ->format(function ($value, $row) {
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
                ->html(),
            Column::make('Created at', 'created_at')
                ->sortable()
                ->format(fn ($value) => Carbon::parse($value)->format('F j, Y')),
            Column::make('Created by', 'email')
                ->sortable(),
            Column::make('Applicants Name', 'name')
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
            Column::make('Nbi fee', 'nbi_renewal')
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
            Column::make('Ticket to Kuwait', 'ticket_to_kuwait')
                ->sortable()
                ->searchable(),
            Column::make('Ticket to Qatar', 'ticket_to_qatar')
                ->sortable()
                ->searchable(),
            Column::make('Agent', 'agent')
                ->sortable()
                ->searchable(),
            Column::make('Updated at', 'updated_at')
                ->sortable()
                ->format(fn ($value) => Carbon::parse($value)->format('F j, Y')),
        ];
    }
}
