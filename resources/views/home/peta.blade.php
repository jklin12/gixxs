<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ config('site.site_name');  }}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/peta/css/styles.css" rel="stylesheet" />
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css" rel="stylesheet">

    <style>
        #map-container {
            position: relative;
            height: 100vh;

        }

        #map {
            position: relative;
            height: inherit;
            width: 100%;
        }

        .menu-title .accicon {
            float: right;
            font-size: 15px;
            width: 1.2em;
        }

        .menu-title:not(.collapsed) .rotate-icon {
            transform: rotate(180deg);
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar-->
        <div class=" bg-white" id="sidebar-wrapper">
            <div class="list-group list-group-flush">
                @foreach($menu as $kmenu => $vmenu)
                <a class="list-group-item list-group-item-action list-group-item-light p-3 collapsed menu-title" data-bs-toggle="collapse" href="#menu_{{$vmenu['menu_id']}}" role="button" aria-expanded="false" aria-controls="menu_{{$vmenu['menu_id']}}" style="font-size: 14px;"> {{$vmenu['menu_name']}} <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span></a>


                <div class="collapse" id="menu_{{$vmenu['menu_id']}}">
                    @if(isset($vmenu['menu_data']))

                    <div class="list-group list-group-flush mx-2">
                        @foreach($vmenu['menu_data'] as $kcat => $vcat)
                        <a class="list-group-item list-group-item-action list-group-item-light p-3 menu-title collapsed" data-bs-toggle="collapse" href="#category_{{$kcat}}" role="button" aria-expanded="false" aria-controls="category_{{$kcat}}" style="font-size: 14px;">{{$vcat['category_name']}} <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span></a>
                        @if(isset($vcat['category_data']))
                        <div class="collapse" id="category_{{$kcat}}">
                            <div class="card-body ms-4">
                                @foreach($vcat['category_data'] as $kdata=>$vdata)
                                <div class="form-check form-switch">
                                    <input class="form-check-input map-switcher" type="checkbox" role="switch" id="flex_{{ $kdata }}" data-id="{{ $kdata }}">
                                    <label class="form-check-label" style="font-size: 12px;" for="flex_{{ $kdata }}">{{ str_replace('_',' ',$vdata) }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @endforeach

                    </div>
                    @endif
                </div>
                @endforeach


            </div>


        </div>

        <div id="mySidenav" class="rightnav">
            <a href="javascript:;" id="close-detail" class="btn btn-danger btn-icon btn-circle btn-sm mx-2 my-2"><i class="fa fa-times"></i></a>
            <div id="detail-conatiner"></div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Page content-->
            <div class="container-fluid">
                <div id="map-container">
                    <div id="map">
                    </div>
                </div>
            </div>
            <div class=" position-absolute bottom-0 end-0 rounded-circle m-5">

                <button type="button" id="sidebarToggle" class="btn btn-success btn-md  " data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                    <i class="fa fa-layer-group"></i>
                </button>

            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="assets/peta/js/scripts.js"></script>
        <script>
            $('#close-detail').click(function() {

                $('#mySidenav').css('width', '0')
            })

            mapboxgl.accessToken = 'pk.eyJ1IjoiZmFyaXNhaXp5IiwiYSI6ImNrd29tdWF3aDA0ZDAycXVzMWp0b2w4cWQifQ.tja8kdSB4_zpO5rOgGyYrQ';
            const map = new mapboxgl.Map({
                container: 'map', // container ID
                // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
                style: 'mapbox://styles/mapbox/streets-v12',
                center: [116.75033, 0.44727], // starting position
                zoom: 11 // starting zoom
            });

            map.on('load', () => {
                // Add a data source containing GeoJSON data.
                <?php foreach ($geojson as $key => $value) { ?>
                    map.addSource('source_<?php echo $key ?>', {
                        'type': 'geojson',
                        'data': <?php echo json_encode($value) ?>
                    });
                <?php } ?>

                // Add a new layer to visualize the polygon.

                <?php foreach ($style as $key => $value) { ?>
                    map.addLayer(<?php echo json_encode($value) ?>);
                <?php } ?>



                <?php foreach ($geojson as $key => $value) { ?>
                    map.on('click', 'layer_<?php echo $key ?>', (e) => {
                        console.log(e.features[0].properties)
                        var tableDetail = '';
                        $.each(e.features[0].properties, function(key, val) {
                            tableDetail += '<li class="nav-item">';
                            tableDetail += '<dt>' + key + '</dt>';
                            tableDetail += '<dd>' + val + '</dd>';
                            tableDetail += '</li>';
                        });
                        $('#mySidenav #detail-conatiner').html(tableDetail)
                        $('#mySidenav').css('width', '300px')


                        map.flyTo({
                            center: [e.lngLat.lng, e.lngLat.lat],
                            zoom: 14,
                            speed: 0.2,
                        });
                        //map.fitBounds([[e.lngLat.lng,e.lngLat.lat],[e.lngLat.lng,e.lngLat.lat]]);

                        $('.detail-sidebar').addClass('detail-sidebar-show')
                    });
                    map.on('mouseenter', 'layer_<?php echo $key ?>', () => {
                        map.getCanvas().style.cursor = 'pointer';
                    });

                    map.on('mouseleave', 'layer_<?php echo $key ?>', () => {
                        map.getCanvas().style.cursor = '';
                    });
                <?php } ?>

            });

            map.on('idle', () => {
                $(".map-switcher").each(function() {
                    var id = $(this).data('id');
                    //alert(id)
                    if (this.checked) {
                        map.setLayoutProperty('layer_' + id, 'visibility', 'visible');
                    } else {
                        map.setLayoutProperty('layer_' + id, 'visibility', 'none');
                    }
                })
            })
            map.addControl(new mapboxgl.NavigationControl());
        </script>

</body>

</html>