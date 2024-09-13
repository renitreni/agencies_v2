<div>
    @push('breadcrumbs')
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Reports</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Reports</h6>
    @endpush
    <livewire:toaster/>
    <div class="card mt-5">
        <div class="card-body">
            <div class="card-title mb-4 d-flex flex-row">
                <h3>Reports</h3>
                <a href="{{ route('reporting') }}" target="_blank" class="btn btn-outline-info ms-2">Form for Reporting</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <livewire:report-table/>
                </div>
            </div>
        </div>
    </div>
</div>
