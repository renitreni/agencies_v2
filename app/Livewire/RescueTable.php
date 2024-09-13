<?php

namespace App\Livewire;

use App\Models\Rescue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RescueTable extends DataTableComponent
{
    public ?string $defaultSortColumn = 'created_at';

    public function configure(): void
    {
          $this->setPrimaryKey('id');
    }
    public function columns(): array
    {
        return [
            Column::make('Created At', 'created_at')
                  ->format(fn($value) => Carbon::parse($value)->format('F j, Y'))
                  ->sortable(),
            // TODO fix this
            // Column::make('Status', 'status')
            //       ->searchable()
            //       ->sortable(),
            Column::make('IP Address', 'ip_address')
                  ->searchable()
                  ->sortable(),
            Column::make('OFW name', 'last_name')
                  ->searchable()
                  ->format(fn($value, $row, $data) => $data['last_name'].', '.$data['first_name'])
                  ->sortable(),
            Column::make('Locate', 'id')
                  ->format(function ($value, $row, $data) {
                      $route = route('map', [
                          'latitude' => $data['actual_latitude'],
                          'longitude' => $data['actual_longitude'],
                      ]);

                      return "<a href='$route' target='_blank' class='btn btn-link m-0'>Locate</a>";
                  })
                  ->asHtml()
                  ->sortable(),
            Column::make('Feedback', 'id')
                  ->format(function ($value, $row, $data) {
                      if (! $data['feedback']) {
                          return '<button type="button" data-bs-toggle="modal" data-bs-target="#feedbackModal"
                            class="btn btn-sm btn-info my-auto"
                            wire:click="$emit(\'bindFeedback\', '.$value.')">Add Feedback</button>';
                      }

                      return '<button type="button" data-bs-toggle="modal" data-bs-target="#feedbackModal"
                      class="btn btn-sm btn-info my-auto"
                      wire:click="$emit(\'bindFeedback\', '.$value.')">View</button>';
                  })
                  ->asHtml()
                  ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Rescue::query()
                     ->selectRaw('c.last_name, c.first_name, rescues.*, res.feedback, res.status')
                     ->join('candidates as c', 'c.id', '=', 'rescues.candidate_id')
                     ->leftJoin('responds as res', 'res.rescue_id', '=', 'rescues.id');
    }
}
