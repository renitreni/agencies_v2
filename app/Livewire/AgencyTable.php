<?php

namespace App\Livewire;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AgencyTable extends DataTableComponent
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
                    ['id' => $id, 'listener' => 'bindAgencyDetails', 'modal' => 'agencyEditModal']))
                ->asHtml(),
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Address", "address")
                ->sortable(),
            Column::make("Logo path", "logo_path")
                ->format(fn($value) => '<img src="'.Storage::url($value).'" class="img-fluid" style="width: 12%;">')
                ->asHtml()
                ->sortable(),
            Column::make("Poea", "poea")
                ->sortable(),
            Column::make("CR No.", "cr_no")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Owner name", "owner_name")
                ->sortable(),
            Column::make("Contact number", "contact_number")
                ->sortable(),
            Column::make("Created by", "users.email")
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Agency::query()
            ->selectRaw('agencies.*')
            ->leftJoin('users', 'users.id', '=', 'agencies.created_by');
    }
}
