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
                <x-a-button class="btn btn-success ms-3">
                    <x-slot name="others">
                        data-bs-toggle="modal" data-bs-target="#voucherModal" wire:click="$set('details', [])"
                    </x-slot>
                    <i class="fas fa-plus"></i> Add Voucher
                </x-a-button>
                <livewire:component.f-r-a-component/>
                <div>
                  <form action="{{ route('vouchers.export-excel') }}" method="GET">
                <button class="btn btn-info ms-3" type="submit">
                    <i class="fa-solid fa-download"></i> Export</button>
                </form>
              </div>
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
                    <livewire:voucher-table :filters="$params"/>
                </div>
            </div>
        </div>
    </div>

    {{--Add--}}
    <x-modalform id="voucherModal" modalTitle="New Voucher" size="modal-xl">
        <div class="row px-2">
            <div class="col-md-4 mb-2"><label>Applicant Name</label><input type="text" class="form-control"
                                                                           wire:model.live="details.name"></div>
            <div class="col-md-4 mb-2"><label>Source</label><input type="text" class="form-control"
                                                                   wire:model.live="details.source"></div>
            <div class="col-md-4 mb-2"><label>Passport Refund</label><input type="text" class="form-control"
                                                                            wire:model.live="details.passport_refund"></div>
            <div class="col-md-6 mb-2"><label>Ticket</label><input type="text" class="form-control"
                                                                   wire:model.live="details.ticket"></div>
            <div class="col-md-6 mb-2"><label>Passporting Allowance</label><input type="text" class="form-control"
                                                                                  wire:model.live="details.passporting_allowance">
            </div>
            <div class="col-md-6 mb-2"><label>Medical Allowance</label><input type="text" class="form-control"
                                                                              wire:model.live="details.medical_allowance">
            </div>
            <div class="col-md-6 mb-2"><label>Medical Follow-up</label><input type="text" class="form-control"
                                                                              wire:model.live="details.medical_follow_up">
            </div>
            <div class="col-md-4 mb-2"><label>Requirements</label><input type="text" class="form-control"
                                                                         wire:model.live="details.requirements"></div>
            <div class="col-md-4 mb-2"><label>Red Rebon NBI</label><input type="text" class="form-control"
                                                                          wire:model.live="details.red_rebon_nbi"></div>
            <div class="col-md-4 mb-2"><label>NBI Fee</label><input type="text" class="form-control"
                                                                        wire:model.live="details.nbi_renewal"></div>
            <div class="col-md-4 mb-2"><label>TESDA Allowance</label><input type="text" class="form-control"
                                                                            wire:model.live="details.tesda_allowance"></div>
            <div class="col-md-4 mb-2"><label>PDOS</label><input type="text" class="form-control"
                                                                 wire:model.live="details.pdos"></div>
            <div class="col-md-4 mb-2"><label>Info Sheet</label><input type="text" class="form-control"
                                                                       wire:model.live="details.info_sheet"></div>
            <div class="col-md-4 mb-2"><label>OWWA Allowance</label><input type="text" class="form-control"
                                                                           wire:model.live="details.owwa_allowance"></div>
            <div class="col-md-4 mb-2"><label>Office Allowance</label><input type="text" class="form-control"
                                                                             wire:model.live="details.office_allowance">
            </div>
            <div class="col-md-4 mb-2"><label>Travel Allowance</label><input type="text" class="form-control"
                                                                             wire:model.live="details.travel_allowance">
            </div>
            <div class="col-md-4 mb-2"><label>Weekly Allowance</label><input type="text" class="form-control"
                                                                             wire:model.live="details.weekly_allowance">
            </div>
            <div class="col-md-4 mb-2"><label>NBI Refund</label><input type="text" class="form-control"
                                                                       wire:model.live="details.nbi_refund"></div>
            <div class="col-md-4 mb-2"><label>PSA Refund</label><input type="text" class="form-control"
                                                                       wire:model.live="details.psa_refund"></div>
            <div class="col-md-4 mb-2"><label>Fare Refund</label><input type="text" class="form-control"
                                                                        wire:model.live="details.fare_refund"></div>
            <div class="col-md-4 mb-2"><label>Fit To Work</label><input type="text" class="form-control"
                                                                        wire:model.live="details.fit_to_work"></div>
            <div class="col-md-4 mb-2"><label>Repat</label><input type="text" class="form-control"
                                                                  wire:model.live="details.repat"></div>
            <div class="col-md-4 mb-2"><label>Stamping</label><input type="text" class="form-control"
                                                                     wire:model.live="details.stamping"></div>
            <div class="col-md-4 mb-2"><label>Vaccine Fare</label><input type="text" class="form-control"
                                                                         wire:model.live="details.vaccine_fare"></div>
            <div class="col-md-4 mb-2"><label>Agent</label><input type="text" class="form-control"
                                                                         wire:model.live="details.agent"></div>
        </div>
        <x-slot name="button">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="store">Save changes
            </button>
        </x-slot>
    </x-modalform>
    {{--Edit--}}
    <x-modalform id="voucherEditModal" modalTitle="Edit Voucher" size="modal-xl">
        <div class="row px-2">
            <div class="col-md-4 mb-2"><label>Applicant Name</label><input type="text" class="form-control"
                                                                           wire:model.live="details.name"></div>
            <div class="col-md-4 mb-2"><label>Source</label><input type="text" class="form-control"
                                                                   wire:model.live="details.source"></div>
            <div class="col-md-4 mb-2"><label>Passport Refund</label><input type="text" class="form-control"
                                                                            wire:model.live="details.passport_refund"></div>
            <div class="col-md-6 mb-2"><label>Ticket</label><input type="text" class="form-control"
                                                                   wire:model.live="details.ticket"></div>
            <div class="col-md-6 mb-2"><label>Passporting Allowance</label><input type="text" class="form-control"
                                                                                  wire:model.live="details.passporting_allowance">
            </div>
            <div class="col-md-6 mb-2"><label>Medical Allowance</label><input type="text" class="form-control"
                                                                              wire:model.live="details.medical_allowance">
            </div>
            <div class="col-md-6 mb-2"><label>Medical Follow-up</label><input type="text" class="form-control"
                                                                              wire:model.live="details.medical_follow_up">
            </div>
            <div class="col-md-4 mb-2"><label>Requirements</label><input type="text" class="form-control"
                                                                         wire:model.live="details.requirements"></div>
            <div class="col-md-4 mb-2"><label>Red Rebon NBI</label><input type="text" class="form-control"
                                                                          wire:model.live="details.red_rebon_nbi"></div>
            <div class="col-md-4 mb-2"><label>NBI Fee</label><input type="text" class="form-control"
                                                                        wire:model.live="details.nbi_renewal"></div>
            <div class="col-md-4 mb-2"><label>TESDA Allowance</label><input type="text" class="form-control"
                                                                            wire:model.live="details.tesda_allowance"></div>
            <div class="col-md-4 mb-2"><label>PDOS</label><input type="text" class="form-control"
                                                                 wire:model.live="details.pdos"></div>
            <div class="col-md-4 mb-2"><label>Info Sheet</label><input type="text" class="form-control"
                                                                       wire:model.live="details.info_sheet"></div>
            <div class="col-md-4 mb-2"><label>OWWA Allowance</label><input type="text" class="form-control"
                                                                           wire:model.live="details.owwa_allowance"></div>
            <div class="col-md-4 mb-2"><label>Office Allowance</label><input type="text" class="form-control"
                                                                             wire:model.live="details.office_allowance">
            </div>
            <div class="col-md-4 mb-2"><label>Travel Allowance</label><input type="text" class="form-control"
                                                                             wire:model.live="details.travel_allowance">
            </div>
            <div class="col-md-4 mb-2"><label>Weekly Allowance</label><input type="text" class="form-control"
                                                                             wire:model.live="details.weekly_allowance">
            </div>
            <div class="col-md-4 mb-2"><label>NBI Refund</label><input type="text" class="form-control"
                                                                       wire:model.live="details.nbi_refund"></div>
            <div class="col-md-4 mb-2"><label>PSA Refund</label><input type="text" class="form-control"
                                                                       wire:model.live="details.psa_refund"></div>
            <div class="col-md-4 mb-2"><label>Fare Refund</label><input type="text" class="form-control"
                                                                        wire:model.live="details.fare_refund"></div>
            <div class="col-md-4 mb-2"><label>Fit To Work</label><input type="text" class="form-control"
                                                                        wire:model.live="details.fit_to_work"></div>
            <div class="col-md-4 mb-2"><label>Repat</label><input type="text" class="form-control"
                                                                  wire:model.live="details.repat"></div>
            <div class="col-md-4 mb-2"><label>Stamping</label><input type="text" class="form-control"
                                                                     wire:model.live="details.stamping"></div>
            <div class="col-md-4 mb-2"><label>Vaccine Fare</label><input type="text" class="form-control"
                                                                         wire:model.live="details.vaccine_fare"></div>
            <div class="col-md-4 mb-2"><label>Ticket to Kuwait</label><input type="text" class="form-control"
                                                                             wire:model.live="details.ticket_to_kuwait">
            </div>
            <div class="col-md-4 mb-2"><label>Ticket to Qatar</label><input type="text" class="form-control"
                                                                            wire:model.live="details.ticket_to_qatar"></div>
        </div>
        <x-slot name="button">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="store">Update</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" wire:click="destroy">Delete</button>
        </x-slot>
    </x-modalform>

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

