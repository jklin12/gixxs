<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add a polygon to a map using a GeoJSON source</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZmFyaXNhaXp5IiwiYSI6ImNrd29tdWF3aDA0ZDAycXVzMWp0b2w4cWQifQ.tja8kdSB4_zpO5rOgGyYrQ';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
            style: 'mapbox://styles/mapbox/light-v10', // style URL
            center: [116.75033, 0.44727], // starting position
            zoom: 11 // starting zoom
        });

        map.on('load', () => {
            // Add a data source containing GeoJSON data.
            <?php foreach ($geojson as $key => $value) { ?>
                map.addSource('<?php echo $key ?>', {
                    'type': 'geojson',
                    'data': <?php echo json_encode($value) ?>
                });
            <?php } ?>

            // Add a new layer to visualize the polygon.

            <?php foreach ($style as $key => $value) { ?>
                map.addLayer(<?php echo json_encode($value) ?>);
            <?php } ?>

            map.on('click', 'test-3_6', (e) => {
                new mapboxgl.Popup()
                    .setLngLat(e.lngLat)
                    .setHTML(e.features[0].properties.name)
                    .addTo(map);
            });

            // Change the cursor to a pointer when
            // the mouse is over the states layer.
            map.on('mouseenter', 'test-3_6', () => {
                map.getCanvas().style.cursor = 'pointer';
            });

            // Change the cursor back to a pointer
            // when it leaves the states layer.
            map.on('mouseleave', 'test-3_6', () => {
                map.getCanvas().style.cursor = '';
            });

        });
    </script>

</body>

</html>