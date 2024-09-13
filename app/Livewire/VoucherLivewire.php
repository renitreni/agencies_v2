<?php

namespace App\Livewire;

use App\Actions\CalculateTotalByVoucher;
use App\Models\ForeignAgency;
use App\Models\JobOrder;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherExpense;
use App\Models\VoucherHeader;
use App\Models\VoucherStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class VoucherLivewire extends Component
{
    public array $params = [];

    public array $accounts = [];

    public array $details = [];

    public array $voucherStatus = [];

    public array $jobOrder = [];

    public array $expenses = [];

    public array $fra = [];

    public array $voucherHeader = [];

    protected $listeners = [
        'editVoucher' => 'edit',
        'editJobOrder' => 'editJobOrder',
        'editExpenses' => 'editExpenses',
    ];

    public function mount()
    {
        $this->params['account'] = Auth::id();

        $this->accounts = User::query()
            ->select(['id', 'email'])
            ->where('agency_id', Auth::user()->agency_id)
            ->get()
            ->toArray();

        $this->fra = ForeignAgency::query()
            ->select(['id', 'agency_name'])
            ->where('agency_id', Auth::user()->agency_id)
            ->get()
            ->toArray();
    }

    public function render(): Factory|View|Application
    {
        $this->saveExpenses();
        if (isset($this->details['id'])) {
            $this->expenses = VoucherExpense::query()
                ->where('voucher_id', $this->details['id'])
                ->get()
                ->toArray();
        }

        $this->voucherHeader = VoucherHeader::query()->where('agency_id', Auth::user()->agency_id)->get()->toArray();

        return view('livewire.vouchers');
    }

    public function updatedParams()
    {
        $this->dispatch('outsideFilter', $this->params);
    }

    public function updatedFiltered()
    {
        $this->dispatch('voucherFiltered');
    }

    public function store()
    {
        $params = array_merge($this->details, ['created_by' => Auth::id(), 'agency_id' => Auth::user()->agency_id]);
        $object = Voucher::updateOrCreate(['id' => $this->details['id'] ?? null], $params);

        CalculateTotalByVoucher::handle($object->id);

        $this->dispatch('callToaster', [
            'message' => isset($this->details['id']) ? 'Voucher has been updated!' : 'New Voucher has been Added!',
        ]);
        
        $this->details = [];
    }

    public function destroy()
    {
        Voucher::query()->find($this->details['id'])->delete();
        $this->dispatch('callToaster', ['message' => 'Voucher has been deleted!']);
        $this->details = [];
    }

    public function statusUpdate()
    {
        $this->validate([
            'voucherStatus.status' => 'required',
        ], [
            'voucherStatus.status.required' => 'Status is required.',
        ]);

        $voucher = Voucher::find($this->details['id']);
        $voucher->status = $this->voucherStatus['status'];
        $voucher->save();

        VoucherStatus::query()
            ->updateOrCreate(
                ['voucher_id' => $this->details['id']],
                $this->voucherStatus
            );

        $this->dispatch('callToaster', ['message' => 'Voucher Status Updated!']);
    }

    #[On('editVoucher')]
    public function edit($id)
    {
        $this->details = Voucher::query()->find($id)->toArray();
        $this->voucherStatus = VoucherStatus::query()->where('voucher_id',$id)->first()?->toArray() ?? [];
        $this->js('$("#voucherEditModal").modal("show")');
    }

    public function editJobOrder($data)
    {
        $this->details = Voucher::query()->find($data['id'])->toArray();
        $this->jobOrder = JobOrder::query()
            ->where('voucher_id', $data['id'])
            ->first()?->toArray() ?? [];
    }

    public function editExpenses($data)
    {
        $this->details = Voucher::query()->find($data['id'])->toArray();
    }

    public function jobOrderUpdate()
    {
        JobOrder::query()
            ->updateOrCreate(
                ['voucher_id' => $this->details['id']],
                $this->jobOrder
            );

        $this->dispatch('callToaster', ['message' => 'Voucher Status Updated!']);
    }

    public function addHeader()
    {
        VoucherExpense::query()
            ->create([
                'voucher_id' => $this->details['id'],
                'header_name' => '',
                'expense_date' => now()->format('Y-m-d'),
                'expense' => '',
                'amount' => 0,
            ]);
    }

    public function removeExpenses($id)
    {
        VoucherExpense::destroy($id);
    }

    public function saveExpenses()
    {
        foreach ($this->expenses as $item) {
            VoucherExpense::query()
                ->where('id', $item['id'])
                ->update([
                    'header_name' => $item['header_name'],
                    'expense_date' => $item['expense_date'],
                    'expense' => $item['expense'],
                    'amount' => $item['amount'],
                ]);
        }

        $this->dispatch('refreshDatatable');
    }
}
