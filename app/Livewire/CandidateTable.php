<?php

namespace App\Livewire;

use App\Models\Candidate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CandidateTable extends DataTableComponent
{
      public ?string $defaultSortColumn = 'created_at';

      public function configure(): void
      {
            $this->setPrimaryKey('id');
      }
    public function columns(): array
    {
        return [
            Column::make("Action", "id")
                  ->format(function ($value) {
                      return view('buttons.link',
                          ['link' => route('applicant.form', ['candidate_id' => encrypt($value)]), 'label' => 'Edit']);
                  })
                  ->asHtml(),
            Column::make("Agency id", "name")
                  ->searchable(function ($q, $v) {
                      return $q->orWhere('ag.name', 'LIKE', "%$v%");
                  })
                  ->sortable(),
            Column::make("Last Reported", "latest")
                  ->sortable(function ($query, $direction) {
                      return $query->whereNotNull('reportable.latest')->orderBy('reportable.latest', $direction);
                  })
                  ->format(function ($value, $column, $row) {
                      if($value == '') {
                          return 'Not Yet Reported';
                      }

                      $formatted = $value ? Carbon::parse($value)->format('F j, Y') : '';
                      $range = Carbon::parse($value)->diffInDays(now());
                      if($range >= 30)
                      {
                          $message = "<label class='text-danger'>$range Days Late</label>";
                      } else {
                          $message = '<label class="text-success">Good</label>';
                      }
                      return $formatted . ' ' . $message;
                  })
                  ->asHtml(),
            Column::make("Status", "status")
                  ->searchable(function ($q, $v) {
                      return $q->orWhere('v.status', 'LIKE', "%$v%");
                  })
                  ->sortable(),
            Column::make("First name", "first_name")
                  ->searchable()
                  ->sortable(),
            Column::make("Last name", "last_name")
                  ->searchable()
                  ->sortable(),
            Column::make("Passport", "passport")
                  ->searchable()
                  ->sortable(),
            Column::make("Code", "code")
                  ->searchable()
                  ->sortable(),
            Column::make("Position 1", "position_1")
                  ->sortable(),
            Column::make("Position 2", "position_2")
                  ->sortable(),
            Column::make("Position 3", "position_3")
                  ->sortable(),
            Column::make("Skills", "skills")
                  ->sortable(),
            Column::make("Employer id", "employer_id")
                  ->sortable(),
            Column::make("Salary", "salary")
                  ->sortable(),
            Column::make("Position selected", "position_selected")
                  ->sortable(),
            Column::make("Date hired", "date_hired")
                  ->sortable(),
            Column::make("Agency abroad id", "agency_abroad_id")
                  ->sortable(),
            Column::make("Deployed", "deployed")
                  ->sortable(),
            Column::make("Date deployed", "date_deployed")
                  ->sortable(),
            Column::make("Place issue", "place_issue")
                  ->sortable(),
            Column::make("Dos", "dos")
                  ->sortable(),
            Column::make("Doe", "doe")
                  ->sortable(),
            Column::make("Remarks", "remarks")
                  ->sortable(),
            Column::make("Kin", "kin")
                  ->sortable(),
            Column::make("Kin relationship", "kin_relationship")
                  ->sortable(),
            Column::make("Kin contact", "kin_contact")
                  ->sortable(),
            Column::make("Kin address", "kin_address")
                  ->sortable(),
            Column::make("Applied using", "applied_using")
                  ->sortable(),
            Column::make("Agency branch", "agency_branch")
                  ->sortable(),
            Column::make("Iqama", "iqama")
                  ->sortable(),
            Column::make("Photo url", "photo_url")
                  ->sortable(),
            Column::make("Middle name", "middle_name")
                  ->sortable(),
            Column::make("Email", "email")
                  ->sortable(),
            Column::make("Fb account", "fb_account")
                  ->sortable(),
            Column::make("Contact 1", "contact_1")
                  ->sortable(),
            Column::make("Contact 2", "contact_2")
                  ->sortable(),
            Column::make("Address", "address")
                  ->sortable(),
            Column::make("Birth date", "birth_date")
                  ->sortable(),
            Column::make("Birth place", "birth_place")
                  ->sortable(),
            Column::make("Civil status", "civil_status")
                  ->sortable(),
            Column::make("Gender", "gender")
                  ->sortable(),
            Column::make("Blood type", "blood_type")
                  ->sortable(),
            Column::make("Height", "height")
                  ->sortable(),
            Column::make("Weight", "weight")
                  ->sortable(),
            Column::make("Religion", "religion")
                  ->sortable(),
            Column::make("Language", "language")
                  ->sortable(),
            Column::make("Education", "education")
                  ->sortable(),
            Column::make("Spouse", "spouse")
                  ->sortable(),
            Column::make("Mother name", "mother_name")
                  ->sortable(),
            Column::make("Father name", "father_name")
                  ->sortable(),
            Column::make("Agreed", "agreed")
                  ->sortable(),
            Column::make("Travel status", "travel_status")
                  ->sortable(),
            Column::make("Deleted at", "deleted_at")
                  ->sortable(),
            Column::make("Created at", "created_at")
                  ->sortable(),
            Column::make("Updated at", "updated_at")
                  ->sortable(),
            Column::make("Skills other", "skills_other")
                  ->sortable(),
            Column::make("Created at", "created_at")
                  ->sortable(),
            Column::make("Updated at", "updated_at")
                  ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Candidate::query()
                        ->selectRaw(
                            'candidates.*,ag.name,v.status, reportable.latest'
                        )
                        ->join('agencies as ag', 'ag.id', '=', 'candidates.agency_id')
                        ->leftJoin('vouchers as v', 'v.id', '=', 'candidates.voucher_id')
                        ->leftJoin(
                            DB::raw("(SELECT max(created_at) as latest, r.reportable_id FROM reports r group by r.reportable_id) as reportable"),
                            'reportable.reportable_id',
                            '=',
                            'candidates.id'
                        )
                        ->when(auth()->user()->role == 2, function ($q) {
                            $q->where('candidates.agency_id', auth()->user()->agency_id);
                        });
    }
}
