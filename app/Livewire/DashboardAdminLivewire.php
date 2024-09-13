<?php

/** @noinspection ALL */

namespace App\Livewire;

use App\Models\Agency;
use App\Models\Candidate;
use App\Models\Complains;
use App\Models\Report;
use App\Models\Rescue;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardAdminLivewire extends Component
{
    public array $results = [];

    public $keyword;

    public $keyIn = 0;

    public array $candidate = [];

    public int $reportCount = 0;

    public int $casesCount = 0;

    public int $casesResolvedCount = 0;

    public int $casesUnresolvedCount = 0;

    public int $agencyCount = 0;

    public int $rescueCount = 0;

    public int $reportDelayed = 0;

    public int $candidateCount = 0;

    public int $candidateDeployedCount = 0;

    public function mount()
    {
        $this->reportDelayed = DB::select("
        select COUNT(*) as total FROM (
        SELECT CASE
                WHEN report_sub.latest <= NOW() - INTERVAL 30 DAY THEN 'DELAYED'
                END,
                report_sub.latest,
                report_sub.reportable_id
        from (SELECT
            max(created_at) as latest,
            r.reportable_id
        FROM
            reports r
        group by
            r.reportable_id) as report_sub
            WHERE report_sub.latest <= NOW() - INTERVAL 30 DAY
        ) as summary
        ")[0]->total;

        $this->reportCount = Report::query()->count();
        $this->casesCount = Complains::query()->count();
        $this->casesResolvedCount = Complains::query()
            ->leftJoin('complain_statuses as cs', 'cs.complain_id', '=',
                'complains.id')
            ->where('cs.status', 'resolved')
            ->count();
        $this->casesUnresolvedCount = Complains::query()
            ->leftJoin('complain_statuses as cs', 'cs.complain_id', '=',
                'complains.id')
            ->whereNull('cs.status')
            ->count();
        $this->agencyCount = Agency::query()->count();
        $this->candidateCount = Candidate::query()
            ->join('vouchers as v', 'v.id', '=', 'candidates.voucher_id')
            ->count();
        $this->candidateDeployedCount = Candidate::query()
            ->join('vouchers as v', 'v.id', '=', 'candidates.voucher_id')
            ->where('v.status', 'deployed')
            ->count();
    }

    public function render()
    {
        $this->rescueCount = Rescue::query()
            ->leftJoin('responds as rs', 'rs.rescue_id', '=', 'rescues.id')
            ->whereNull('rs.rescue_id')
            ->orWhere('rs.status', '<>', 'resolved')
            ->count();

        $casesPerMonth = Complains::query()
            ->selectRaw('COUNT(*) as total, MONTHNAME(complains.created_at) as monthname, MONTH(complains.created_at) as month')
            ->where(DB::raw('YEAR(created_at)'), now()->format('Y'))
            ->groupBy(DB::raw('MONTHNAME(complains.created_at),MONTH(complains.created_at)'))
            ->orderBy(DB::raw('MONTH(complains.created_at)'))
            ->get()
            ->toArray();

        return view('livewire.dashboard-admin-livewire', compact('casesPerMonth'));
    }

    public function searchCandidate()
    {
        $this->keyIn = $this->keyword ? 1 : 0;
        $model = Candidate::search($this->keyword ?: null)
            ->paginate(10);

        $this->results = $model->load('agency')->toArray();
    }

    public function bindSearch($id, $keyword)
    {
        $this->keyIn = 0;
        $this->keyword = $keyword;
        $this->candidate = Candidate::query()->find($id)->toArray();
    }
}
