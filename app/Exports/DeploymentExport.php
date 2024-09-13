<?php

namespace App\Exports;

use App\Models\Deployment;
use App\Models\Voucher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DeploymentExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{

  private $params;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct() 
    {
        $this->params = session('export');;
    }

    public function collection()
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
            ->when(isset($this->params['account']), function ($q) {
                $q->where('vouchers.created_by', $this->params['account']);
            }, fn ($q) => $q->where('vouchers.created_by', auth()->id()))
            ->leftJoin('voucher_statuses', 'voucher_statuses.voucher_id', '=', 'vouchers.id')
            ->leftJoin('foreign_agencies', 'foreign_agencies.id', '=', 'vouchers.agency_id')
            ->leftJoin('deployments', 'deployments.voucher_id', '=', 'vouchers.id')->get();
        //  dd($voucher);
    return $voucher;
    }

    public function map($deployment): array
    {
        return[
            $deployment->id,
            $deployment->name,
            $deployment->source,
            $deployment->agency_name,
            $deployment->status,
            $deployment->age,
            $deployment->ticket,
            $deployment->status_date,
            $deployment->type,
            $deployment->ppt,
            $deployment->fit_to_work,
            $deployment->contract_signing,
        ];
    }

    public function headings(): array
    {
        return[
            '#',
            'Applicant',
            'Source',
            'FRA',
            'Status',
            'Age',
            'Ticket',
            'Deployment date',
            'Type',
            'PPT',
            'Fit to work',
            'Contract signing',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:L1')->applyFromArray([
                    'font'=> ['bold'=>true]
                ]);
            },
        ];
    }
}
