<div>
    <style>
        body {
            background-image: url("https://www.dropbox.com/s/19e1hkq3e2maqkp/bg-complaint.jpg?dl=1");
        }
    </style>
    <livewire:toaster/>
    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex border-radius-lg bg-white shadow-sm p-2 mt-4
                justify-content-center navbar navbar-main navbar-expand-lg px-0
                border-radius-sm shadow-sm position-sticky mt-4 left-auto top-1 z-index-sticky">
                    <div class="d-flex flex-column justify-content-center">
                        <h3>Complaint Form</h3>
                        <h6 class="text-center mb-2">
                            {{ $this->agency->name }}
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-12" wire:ignore.self id="form-ofw-loading">
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
            <div class="col-12">
                <div class="card mt-4" wire:ignore.self id="form-ofw" hidden>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 border-bottom mb-2">
                                <h3>General Information</h3>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Foreign Recruitment Agency</label>
                                <select class="form-select" wire:model.live="form.foreign_agency_id">
                                    <option value="">None</option>
                                    @foreach($fraList as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['agency_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>OFW's Full Name</label>
                                <input class="form-control" wire:model.live="form.full_name">
                                @error('form.full_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label>Gender</label>
                                <select class="form-select" wire:model.live="form.gender">
                                    <option value="">None</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label>Birthdate</label>
                                <input type="date" class="form-control" wire:model.live="form.birth_date">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>National / IQAMA ID</label>
                                <input class="form-control" wire:model.live="form.national_id">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Passport No.</label>
                                <input class="form-control" wire:model.live="form.passport">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Occupation</label>
                                <input class="form-control" wire:model.live="form.occupation">
                            </div>
                            <div class="col-12 border-bottom mb-2">
                                <h3>Contact Information</h3>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>E-mail</label>
                                <input type="email" class="form-control" wire:model.live="form.email">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Primary Contact</label>
                                <input type="email" class="form-control" wire:model.live="form.email">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Secondary Contact</label>
                                <input class="form-control" wire:model.live="form.email">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Contact Person</label>
                                <input class="form-control" wire:model.live="form.contact_person">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label>Address Abroad</label>
                                <input type="email" class="form-control" wire:model.live="form.address_abroad">
                            </div>
                            <div class="col-12 border-bottom mb-2">
                                <h3>Image Evidences</h3>
                            </div>
                            <div class="col-md-12 d-flex flex-row mb-2">
                                <div class="d-flex flex-column">
                                    <label>Image 1</label>
                                    <input type="file" wire:model.live="form.image1">
                                    @error('form.image1')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex flex-column">
                                    <label>Image 2</label>
                                    <input type="file" wire:model.live="form.image2">
                                    @error('form.image2')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex flex-column">
                                    <label>Image 3</label>
                                    <input type="file" wire:model.live="form.image3">
                                    @error('form.image3')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 border-bottom mb-2">
                                <h3>Complaint Section</h3>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label>Complaint</label>
                                <textarea class="form-control" wire:model.live="form.complaint"></textarea>
                                @error('form.complaint')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 border-bottom mb-2">
                                <div class="d-grid">
                                    <a href="#" class="btn btn-success" wire:click="store">Submit</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div wire:ignore id='map2' style='width: 100%; height: 300px;'></div>
                                <input type="text" wire:model.live="form.actual_latitude" hidden>
                                <input type="text" wire:model.live="form.actual_longitude" hidden>
                                @error('form.actual_latitude')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('form.actual_longitude')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet'/>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                $('#form-ofw').removeAttr('hidden');
                $('#form-ofw-loading').attr('hidden', 'hidden');

                @this.
                set('form.actual_latitude', position.coords.latitude);
                @this.
                set('form.actual_longitude', position.coords.longitude);

                var map2 = new mapboxgl.Map({
                    container: 'map2',
                    center: [position.coords.longitude, position.coords.latitude],
                    zoom: 15,
                    style: 'mapbox://styles/mapbox/satellite-streets-v10'
                });

                var marker2 = new mapboxgl.Marker()
                    .setLngLat([position.coords.longitude, position.coords.latitude])
                    .addTo(map2);
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
    @endpush
</div>
