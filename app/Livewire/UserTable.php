<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends DataTableComponent
{
    public ?string $defaultSortColumn = 'created_at';

    public function configure(): void
    {
          $this->setPrimaryKey('id');
    }
    
    public function columns(): array
    {
        return [
            Column::make("Actions", "id")
                  ->format(fn($id) => view('buttons.actions',
                      ['id' => $id, 'listener' => 'bindUserDetails', 'modal' => 'userEditModal']))
                  ->asHtml(),
            Column::make("ID", "id")
                  ->sortable(),
            Column::make("Email", "email")
                  ->searchable()
                  ->sortable(),
            Column::make("Agency", "agency_name")
                  ->searchable(function ($q, $keyword) {
                      return $q->orWhere('agency.name','LIKE',"%$keyword%");
                  })
                  ->sortable(function ($q, $direction) {
                      return $q->orderBy('agencies.name', $direction);
                }),
            Column::make("Fullname", "name")
                  ->searchable()
                  ->searchable(function ($q, $keyword) {
                      return $q->orWhere('information.name','LIKE',"%$keyword%");
                  }),
        ];
    }

    public function query(): Builder
    {
        return app(User::class)->tableQuery();
    }
}
