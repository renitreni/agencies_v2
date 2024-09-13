<div>
    @push('header')
        <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet'/>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @endpush
    <style>
        body {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url("https://drive.google.com/uc?export=view&id=1NQpcM0yFahwTeX69CgRyCrGsVu2gNZqU");
        }
    </style>
    <livewire:toaster/>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            @if(!$candidate)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary p-3">
                            <div class="card-title text-white font-weight-bold">
                                OFW Tabang Services
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <label>Please enter code </label>
                                <div class="d-flex flex-column">
                                    <div>
                                        <input type="text" class="form-control me-2" wire:model.live="code">
                                        @error('code')
                                        <span class="badge badge-sm bg-gradient-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-grid mt-2">
                                        <button class="btn btn-info h-100 m-0" wire:click="showComplaintForm">
                                            COMPLAINT
                                        </button>
                                    </div>
                                    <div class="d-grid mt-2">
                                        <button class="btn btn-danger h-100 m-0" wire:click="showDetails">
                                            URGENT
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12"></div>
            @if($candidate)
                @if($candidate['status'] == 'deployed')
                    <div class="col-md-12 my-auto" id="form-ofw-loading" wire:ignore.self>
                        <div class="card mt-4">
                            <div class="d-flex flex-column justify-content-center my-5">
                                <div class="d-flex flex-row justify-content-center">
                                    <div class="spinner-border me-4" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-center">
                                    <h3 class="my-auto px-3">Please wait.. We are searching your location...</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 my-auto" id="form-ofw" hidden wire:ignore.self>
                        <div class="d-grid">
                            <button type="button" class="btn btn-danger h-100 fs-1"
                                    wire:click="rescue">
                                RESCUE
                            </button>
                        </div>
                    </div>
                @else
                    <div class="d-flex flex-row justify-content-center">
                        <h3 class="my-auto px-3">Only Deployed OFW is required.</h3>
                    </div>
                @endif
                    <div id="map2-container" class="col-md-12 mt-3">
                        <div wire:ignore id='map2' style='width: 100%; height: 300px;'></div>
                    </div>
                    <script>
                        mapboxgl.accessToken =
                            'pk.eyJ1IjoicmVuaWVyLXRyZW51ZWxhIiwiYSI6ImNrZHhya2l3aTE3OG0ycnBpOWxlYjV3czUifQ.4hVvT7_fiVshoSa9P3uAew';

                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(showPosition, showError);
                        }

                        $('#cb-btn').on('click', function () {
                            $('.loading').removeAttr('hidden', 'hidden');
                        });

                        function showPosition(position) {
                            $('#form-ofw-loading').attr('hidden', 'hidden');
                            $('#form-ofw').removeAttr('hidden');

                            var map2 = new mapboxgl.Map({
                                container: 'map2',
                                center: [position.coords.longitude, position.coords.latitude],
                                zoom: 15,
                                style: 'mapbox://styles/mapbox/satellite-streets-v10'
                            });

                            var marker2 = new mapboxgl.Marker()
                                .setLngLat([position.coords.longitude, position.coords.latitude])
                                .addTo(map2);

                            @this.
                            set('form.actual_latitude', position.coords.latitude);
                            @this.
                            set('form.actual_longitude', position.coords.longitude);
                        }

                        function showError(error) {
                            switch (error.code) {
                                case error.PERMISSION_DENIED:
                                    swal.fire({
                                        html: '<img src="/images/owwa.png" width="120"/><img src="/images/dfa.png" width="120"/><img src="/images/polo.png" width="120"/>' +
                                            '<div class="swal2-header" style=\'margin-top:5px; box-sizing: border-box; display: flex; flex-direction: column; align-items: center; padding: 0px 1.8em; -webkit-tap-highlight-color: transparent; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'>\n' +
                                            '    <h2 class="swal2-title" style="box-sizing: border-box; margin: 0px 0px 0.4em; font-weight: 600; font-size: 1.875em; position: relative; max-width: 100%; padding: 0px; color: rgb(89, 89, 89); text-align: center; text-transform: none; overflow-wrap: break-word; -webkit-tap-highlight-color: transparent; display: block; line-height: 1;">GPS Required<br><span style="font-size: 26px;"><em>(GPS ay kailangan)</em></span></h2>\n' +
                                            '</div>\n' +
                                            '<div class="swal2-content" style=\'box-sizing: border-box; z-index: 1; justify-content: center; margin: 0px; padding: 0px 1.6em; color: rgb(84, 84, 84); font-size: 1.125em; font-weight: 400; line-height: normal; text-align: center; overflow-wrap: break-word; -webkit-tap-highlight-color: transparent; font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'>\n' +
                                            '    <div class="swal2-html-container" style="box-sizing: border-box; -webkit-tap-highlight-color: transparent; display: block;">Please enable the GPS locator to continue<br style="box-sizing: border-box;"><i style="box-sizing: border-box;">Maari lamang buksan ang GPS upang magpatuloy</i></div>\n' +
                                            '</div>',
                                        focusConfirm: false,
                                        confirmButtonText: 'GPS has been enabled!<br><i>Bukas na ang GPS!</i>',
                                        confirmButtonAriaLabel: 'Thumbs up, great!',
                                    }).then((result) => {
                                        /* Read more about isConfirmed, isDenied below */
                                        if (result.isConfirmed) {
                                            window.location = window.location
                                        }
                                    });
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    alert("Location information is unavailable.");
                                    break;
                                case error.TIMEOUT:
                                    alert("The request to get user location timed out.");
                                    break;
                                case error.UNKNOWN_ERROR:
                                    alert("An unknown error occurred.");
                                    break;
                            }
                        }
                    </script>
            @endif
        </div>
    </div>
</div>
