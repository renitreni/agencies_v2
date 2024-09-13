<?php

namespace App\Livewire;

use App\Models\Candidate;
use App\Models\Voucher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DashboardLivewire extends Component
{
    public int $totalVoucher = 0;

    public int $totalDeployed = 0;

    public int $totalCandidate = 0;

    public function mount()
    {
        $this->totalVoucher = Voucher::query()->where('agency_id', Auth::user()->agency_id)->count();
        $this->totalDeployed = Voucher::query()
            ->where('status', 'deployed')
            ->where('agency_id', Auth::user()->agency_id)
            ->count();
        $this->totalCandidate = Candidate::query()->where('agency_id', Auth::user()->agency_id)->count();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.dashboard');
    }
}
