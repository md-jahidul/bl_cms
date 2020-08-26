<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>KML Click Capture Sample</title>
    <style>
        html, body {
            height: 370px;
            padding: 0;
            margin: 0;
        }
        #map {
            height: 760px;
            width: 700px;
            overflow: hidden;
            float: left;
            border: thin solid #333;
        }
        #capture {
            height: 760px;
            width: 780px;
            overflow: hidden;
            float: left;
            background-color: #ECECFB;
            border: thin solid #333;
            border-left: none;
        }
    </style>
</head>
<body>
@php
$latitude = request()->has('latitude') ? request()->input('latitude') : 23.8103;
$longitude = request()->has('longitude') ? request()->input('longitude') : 90.4125;
$zoom = request()->has('zoom') ? request()->input('zoom') : 6;
@endphp
<div id="map"></div>
<script>
    var map;
    var src = 'https://4g.banglalink.net/map_kmz/END_June_4G_Coverage_2020/END_June_4G_Coverage_2020.kml';
    var mapLat = "{{$latitude}}";
    var mapLng = "{{$longitude}}";
    var mapZoom = "{{$zoom}}";

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(parseFloat(mapLat), parseFloat(mapLng)),
            zoom: parseInt(mapZoom),
            mapTypeId: 'terrain'
        });

        new google.maps.KmlLayer(src, {
            suppressInfoWindows: true,
            preserveViewport: false,
            map: map
        });
    }
</script>
<script defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap">
</script>
</body>
</html>
