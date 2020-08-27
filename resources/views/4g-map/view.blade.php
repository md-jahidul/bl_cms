<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Banglalink KML 4G Map</title>
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
    </style>
</head>
<body>
<div id="map"></div>
<script>
    var map;
    // var src = 'https://4g.banglalink.net/map_kmz/END_June_4G_Coverage_2020/END_June_4G_Coverage_2020.kml';
    var src = "{{url('/')}}/storage/4G_MAP/BL_4G_ALL_END_JUNE_2020_RSRP_Common_M.kml";
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    var mapLat = urlParams.get('latitude') ? urlParams.get('latitude') : 23.8103;
    var mapLng = urlParams.get('longitude') ? urlParams.get('latitude')  : 90.4125;
    var mapZoom = urlParams.get('zoom') ? urlParams.get('zoom') : 6;

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
