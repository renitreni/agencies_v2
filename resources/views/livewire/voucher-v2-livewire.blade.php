<div>
    @push('breadcrumbs')
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Vouchers</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Vouchers</h6>
    @endpush
    <livewire:toaster/>
    <div class="card mt-5">
        <div class="card-body">
            <div class="card-title mb-4 d-flex flex-row">
                <h3>Vouchers</h3>
                <livewire:component.f-r-a-component/>
            </div>
            <div class="row">
                <div class="col-12">
                    <form id="former">
                        <div class="row mb-4">
                            <div class="col-md-2">
                                <label>Filter By:</label>
                                <select class="form-control" wire:model.live="params.account" name="filtered">
                                    @foreach($accounts as $account)
                                        <option value="{{ $account['id'] }}">{{ $account['email'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <livewire:voucher-v2-table :filters="$params"/>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="voucherStatusModal" tabindex="-1"
         aria-labelledby="voucherStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="voucherStatusModalLabel">
                        Voucher Status <code>{{ $details['name'] ?? '' }}</code>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Status</label>
                            <select class="form-control" wire:model.live="voucherStatus.status">
                                <option value="">-- Select Option --</option>
                                <option value="back-out">BACK-OUT</option>
                                <option value="deployed">DEPLOYED</option>
                                <option value="in-process">IN-PROCESS</option>
                            </select>
                            @error('voucherStatus.status') <span class="text-danger">{{ $message }}</span> @endif
                        </div>
                        <div class="col-md-6">
                            <label>Status Date</label>
                            <input type="date" class="form-control" wire:model.live="voucherStatus.status_date">
                        </div>
                        <div class="col-md-12">
                            <label>Remarks</label>
                            <textarea class="form-control" wire:model.live="voucherStatus.remarks"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="statusUpdate">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="jobOrderModal" tabindex="-1" aria-labelledby="jobOrderModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobOrderModalLabel">
                        Job Order <code>{{ $details['name'] ?? '' }}</code>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>FRA</label>
                            <select class="form-control" wire:model.live="jobOrder.foreign_agency_id">
                                <option value="">-- Select Option --</option>
                                @foreach($fra as $item)
                                    <option value="{{ $item['id'] }}">{{$item['agency_name']}}</option>
                                @endforeach
                            </select>
                            @error('jobOrder.job_order_type') <span class="text-danger">{{ $message }}</span> @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="jobOrderUpdate">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="expenseModal" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1"
         aria-labelledby="expenseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="expenseModalLabel">Expenses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <th>Header</th>
                        <th>Date</th>
                        <th>Activity</th>
                        <th>Amount</th>
                        </thead>
                        <tbody>
                        @foreach($expenses as $key => $item)
                            <tr>
                                <td class="d-flex flex-row">
                                    <button class="btn btn-sm btn-danger px-3 mb-0 me-2"
                                            wire:click="removeExpenses({{ $item['id'] }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <select class="form-select" wire:model.live="expenses.{{$key}}.header_name">
                                        <option value="">Select Header</option>
                                        @foreach($voucherHeader as $item)
                                            <option value="{{ $item['header_name'] }}">{{ $item['header_name'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width: 15%;">
                                    <input type="date" class="form-control" wire:model.blur="expenses.{{$key}}.expense_date">
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model.blur="expenses.{{$key}}.expense">
                                </td>
                                <td style="width: 15%;">
                                    <input type="number" class="form-control" wire:model.blur="expenses.{{$key}}.amount">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-success" wire:click="addHeader">Add Header</a>
                </div>
            </div>
        </div>
    </div>
</div>
