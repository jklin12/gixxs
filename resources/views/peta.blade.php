<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="C3qNALfsz6QDYg6MBmc5XNAxTHliRVKHZTSIiOCZ">

    <title>{{ config('site.site_name');  }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/webgis.css">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.js"></script>
</head>

<body>
    <div class="wrapper d-flex flex-column vh-100 bg-light">
        <header class="header">
            <a class="header-brand ms-3 fw-semibold d-none d-md-block" href="{{route('home')}}">
                {{ config('site.site_name');  }}
            </a>
            <a class="header-brand ms-3 fw-semibold d-block d-md-none" href="#">
                {{ config('site.site_desc');  }}
            </a>
            <ul class="header-nav d-none d-md-flex">
                <li class="nav-item">
                    <a class="nav-link webgis-link" href="{{ route('home')}}">
                        <i class="fas fa-home me-2"></i>
                        Beranda
                    </a>
                </li>

            </ul>

        </header>
        <div class="body flex-grow-1 flex-row d-flex">
            <div class="sidebar sidebar-narrow sidebar-fixed">
                <ul class="sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link sijingga-sidebar-menu" role="button" title="Daftar Layer" data-target="sidebar-layer">
                            <i class="fas fa-layer-group w-100 fa-lg"></i>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="d-flex flex-column flex-grow-1 sijingga-content">
                <div id="map-container" class="map-priority position-relative">
                </div>
                <footer class="footer w-100 d-md-flex d-lg-none">
                    <ul class="nav nav-justified w-100">
                        <li class="nav-item">
                            <a class="nav-link toolbar sijingga-sidebar-menu py-2" role="button" title="Daftar Layer" data-target="sidebar-layer">
                                <i class="fas fa-layer-group fa-fw w-100"></i>
                                <small>Layer</small>
                            </a>
                        </li>

                    </ul>
                </footer>

            </div>
        </div>
    </div>

    <div id="sidebar-layer" class="sidebar sidebar-lg sidebar-fixed sijingga-sidebar ">
        <ul class="sidebar-nav">
            @foreach($menu as $kmenu => $vmenu)
            <li class="nav-group-layer">
                <a class="nav-link nav-group-layer-toggle collapsed" data-coreui-toggle="collapse" data-coreui-target="#menu_{{$vmenu['menu_id']}}" role="button" aria-expanded="false">
                    {{$vmenu['menu_name']}}
                </a>
                <ul id="menu_{{$vmenu['menu_id']}}" class="nav-group-layer-items collapse">
                    @if(isset($vmenu['menu_data']))
                    @foreach($vmenu['menu_data'] as $kcat => $vcat)
                    <li class="nav-group-layer">
                        <a class="nav-link nav-group-layer-toggle collapsed" data-coreui-toggle="collapse" data-coreui-target="#category_{{$kcat}}" role="button" aria-expanded="false">
                            &nbsp;&nbsp; {{$vcat['category_name']}}
                        </a>
                        <ul id="category_{{$kcat}}" class="nav-group-layer-items collapse">
                            @if(isset($vcat['category_data']))
                            <li id="data_cat_{{ $kcat }}" class="nav-link map-link-selector user-select-none" role="button" data-id="{{ $kcat }}" style="white-space: normal; word-wrap: break-word;">
                                <div class="form-check form-switch mb-0">
                                    <input id="cat_{{$kcat}}" class="form-check-input cat-switcher" type="checkbox" role="switch" data-id="{{ $kcat }}" name="input_{{ $kcat }}">
                                </div>Tampil Semua
                            </li>
                            @foreach($vcat['category_data'] as $kdata => $vdata)
                            <li id="data_{{ $kdata }}" class="nav-link map-link-selector user-select-none" role="button" data-id="{{ $kdata }}" style="white-space: normal; word-wrap: break-word;">
                                <div class="form-check form-switch mb-0">
                                    <input id="geo_{{$kdata}}" class="form-check-input map-switcher flex_cat_{{ $kcat}}" type="checkbox" role="switch" data-id="{{ $kdata }}" name="input_{{ $kdata }}">
                                </div> {{ str_replace('_',' ',$vdata) }}
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </li>

            @endforeach

        </ul>
    </div>

    <div class="sidebar sidebar-lg sidebar-end sidebar-fixed detail-sidebar ">
        <div class="sidebar-header d-flex justify-content-between detail-header">
            <h5 class="mb-0 text-start">Detail</h5>
            <button type="button" id="close-delete" class="btn-close text-white" aria-label="Close"></button>
        </div>
        <div class="feature-detail position-relative px-3 py-2">
            <ul class="sidebar-nav" id="detail-data"></ul>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#close-delete').click(function() {
                $('.detail-sidebar').removeClass('detail-sidebar-show')
            })
            $(".sijingga-sidebar-menu").on('click', function() {
                var target = $(this).data('target');
                if ($('#' + target).hasClass('sijingga-sidebar-show')) {
                    $('#' + target).removeClass('sijingga-sidebar-show')
                } else {
                    $('#' + target).addClass('sijingga-sidebar-show')
                }
            })

            $(".nav-group-layer-toggle").click(function() {
                var target = $(this).data('coreui-target');
                $(target).slideToggle()
            });

            mapboxgl.accessToken = 'pk.eyJ1IjoiZmFyaXNhaXp5IiwiYSI6ImNrd29tdWF3aDA0ZDAycXVzMWp0b2w4cWQifQ.tja8kdSB4_zpO5rOgGyYrQ';
            const map = new mapboxgl.Map({
                container: 'map-container', // container ID
                // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
                style: 'mapbox://styles/mapbox/streets-v12',
                center: [116.75033, 0.44727], // starting position
                zoom: 8 // starting zoom
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
                        $('#detail-data').html(tableDetail)

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

                    if (this.checked) {
                        map.setLayoutProperty('layer_' + id, 'visibility', 'visible');
                    } else {
                        map.setLayoutProperty('layer_' + id, 'visibility', 'none');
                    }
                })
            })
            map.addControl(new mapboxgl.NavigationControl());
        })

        $('.cat-switcher').change(function() {
                var id = $(this).data('id');
                
                $('.flex_cat_'+id).trigger('click');
            })
    </script>
</body>

</html>