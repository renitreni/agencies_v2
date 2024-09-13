<div>
    <div class="row mb-4">
        <div class="col-md-12">
        @if($this->reportDelayed > 0)
            <div class="alert alert-warning d-flex justify-content-center">
                <h5 class="text-white font-weight-bold">
                    DELAYED REPORTS DETECTED!
                </h5>
               <button data-bs-toggle="modal" data-bs-target="#urgentModal" wire:click="showRecues"
                       class="btn btn-link ms-2 p-0 my-0 text-info">Show Details
               </button>
            </div>
        @endif
        </div>
        <div class="col-md-3">
            @include('livewire.partials.card', ['negative' => '+ '. $reportDelayed, 'label' => 'Total Reports', 'total_count' => $reportCount, 'icon' => '<i class="fas fa-flag text-lg opacity-10" aria-hidden="true"></i>'])
        </div>
        <div class="col-md-3">
            @include('livewire.partials.card', ['positive' => '+ '.$casesResolvedCount, 'negative' => '- '. $casesUnresolvedCount,'label' => 'Total Cases', 'total_count' => $casesCount, 'icon' => '<i class="fas fa-suitcase text-lg opacity-10" aria-hidden="true"></i>'])
        </div>
        <div class="col-md-3">
            @include('livewire.partials.card', ['label' => 'Total Agencies', 'total_count' => $agencyCount, 'icon' => '<i class="fa-solid fa-building-flag"></i>'])
        </div>
        <div class="col-md-3">
            @include('livewire.partials.card', ['label' => 'Total OFW', 'total_count' => $candidateCount, 'positive' => '+ '.$candidateDeployedCount, 'icon' => '<i class="fa-solid fa-person-walking-luggage"></i>'])
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column">
                <label for="exampleDataList" class="form-label">Search Overseas Filipino Worker</label>
                <input class="form-control" id="exampleDataList" placeholder="Type to search..."
                       wire:keydown.debounce="searchCandidate" wire:model.live="keyword">
                @if($results && $keyIn)
                    <div style="position: relative;">
                        <div class="d-flex flex-column bg-white border position-absolute w-100 mx-auto z-index-3">
                            @foreach($results as $item)
                                <div class="timeline timeline-one-side ">
                                    <div class="timeline-block mb-3 py-2 px-3"
                                         wire:click="bindSearch({{ $item['id'] }}, '{{ $item['last_name'] }}, {{ $item['first_name'] }}')">
                                    <span class="timeline-step">
                                                    <i class="ni ni-bell-55 text-success text-gradient"></i>
                                    </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">
                                                {{ $item['last_name'] }}, {{ $item['first_name'] }}
                                            </h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                Agency: {{ $item['agency']['name'] ?? 'Not Assigned' }} <br>
                                                Passport: {{ $item['passport'] ?? 'Not Assigned' }}<br>
                                                National ID: {{ $item['iqama'] ?? 'Not Assigned' }}<br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if($this->candidate)
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 d-flex flex-column border">
                        <label>Full Name</label>
                        <p>{{ $this->candidate['last_name'] }}, {{ $this->candidate['first_name'] }}</p>
                    </div>
                    <div class="col-md-3 d-flex flex-column border">
                        <label>Passport</label>
                        <p>{{ $this->candidate['passport'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="card mt-3">
        <div class="card-body">
            <canvas id="myChart" width="400" height="100"></canvas>
        </div>
    </div>
    <script>
        const data = {
            labels: [@foreach($casesPerMonth as $item) '{{ $item['monthname'] }}', @endforeach],
            datasets: [
                {
                    label: 'Cases Per Month',
                    data: [@foreach($casesPerMonth as $item){{ $item['total'] }},@endforeach],
                    borderColor: 'blue',
                    backgroundColor: 'blue',
                },
                // {
                //     label: 'Dataset 2',
                //     data: [100, 33, 22, 19, 11, 49, 30],
                //     borderColor: 'red',
                //     backgroundColor: 'red',
                // }
            ]
        };
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Min and Max Settings'
                    }
                },
                scales: {
                    y: {
                        min: 0,
                        max: 500,
                    }
                }
            },
        });
    </script>
</div>
