<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Sarathi</title>
    {{--<script src="http://maps.google.com/maps/api/js?sensor=false"--}}
            {{--type="text/javascript"></script>--}}

    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}">
</head>
<body>
<a href="{{route('locations')}}" class="btn btn-primary btn-block" style="margin:auto">Add Locations</a>

<div id="map" style="width: 1150px; height: 500px;margin-top: 40px;margin-left: 95px"></div>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8ERVkND2Lrrd-OvTlueHhZq2liTShthc&callback=initMap"
        type="text/javascript"></script>
<script type="text/javascript">
    var locations = [];

    <?php foreach ($locations as &$key): ?>
    locations.push(["<?=$key['location']?>", <?=$key['latitude']?>,<?=$key['longitude']?>]);

    <?php endforeach; ?>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: new google.maps.LatLng(27.689268, 85.308456),
            mapTypeId: google.maps.MapTypeId.ROADMAP,

        });

    // function initMap() {
    //     var kathmandu = {lat: 27.689268, lng: 85.308456};
    //     var map = new google.maps.Map(document.getElementById('map'),
    //         {
    //             zoom: 10,
    //             center: kathmandu
    //         });
    //     marker = new google.maps.Marker({
    //         position: kathmandu,
    //         map: map
    //     });
    // }

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

        for (i = 0; i < locations.length; i++) {

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
        }
    }
</script>
<script src="{{url('js/bootstrap.js')}}"></script>
</body>
</html>