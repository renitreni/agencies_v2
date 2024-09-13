<div>
    <div id='map2' style='width: 100%; height: 500px;'></div>
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet'/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        mapboxgl.accessToken =
            'pk.eyJ1IjoicmVuaWVyLXRyZW51ZWxhIiwiYSI6ImNrZHhya2l3aTE3OG0ycnBpOWxlYjV3czUifQ.4hVvT7_fiVshoSa9P3uAew';

        $('#cb-btn').on('click', function () {
            $('.loading').removeAttr('hidden', 'hidden');
        });

        function showPosition(latitude, longitude) {
            var map2 = new mapboxgl.Map({
                container: 'map2',
                center: [longitude, latitude],
                zoom: 15,
                style: 'mapbox://styles/mapbox/satellite-streets-v10'
            });

            var marker2 = new mapboxgl.Marker()
                .setLngLat([longitude, latitude])
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
        showPosition({{ $latitude }}, {{ $longitude }});
    </script>
</div>
