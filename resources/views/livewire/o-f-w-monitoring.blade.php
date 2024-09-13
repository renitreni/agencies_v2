<div>
    <style>
        .btn.btn-outline-secondary {
            margin: 0px !important;
        }
    </style>
    @push('breadcrumbs')
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">OFW Monitoring</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">OFW Details</h6>
    @endpush
    <livewire:toaster/>
    <div class="card mt-5">
        <div class="card-body">
            <div class="card-title mb-4 d-flex flex-row">
                <h3>OFW Monitoring</h3>
                <a href="{{ route('report') }}" class="btn btn-outline-info ms-3" target="_blank">OFW Reporting</a>
                <a href="{{ route('applicant.form') }}" class="btn btn-success ms-3" target="_blank">New applicant</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <livewire:candidate-table/>
                </div>
            </div>
        </div>
    </div>
</div>
