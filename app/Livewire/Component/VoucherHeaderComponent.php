<?php

namespace App\Livewire\Component;

use App\Models\VoucherHeader;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class VoucherHeaderComponent extends Component
{
    public array $headers = [];

    public string $keyword = '';

    public function render(): Factory|View|Application
    {
        $this->headers = VoucherHeader::query()
            ->where('agency_id', Auth::user()->agency_id)
            ->get()
            ->toArray();

        return view('livewire.component.voucher-header-component');
    }

    public function store()
    {
        VoucherHeader::query()->create([
            'agency_id' => Auth::user()->agency_id,
            'header_name' => $this->keyword,
        ]);
        $this->keyword = '';
    }

    public function delete($id)
    {
        VoucherHeader::destroy($id);
    }
}
