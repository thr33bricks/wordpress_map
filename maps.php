<?php /* Template Name: GoogleMapsPoints */ ?>
<?php get_header(); ?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps</title>

    <!------------------ Map CSS ----------------------------->
    <style type="text/css">
        body { font: normal 10pt Helvetica, Arial; }
        #map { width: 800px; height: 800px; border: 0px; padding: 0px; }
    </style>

    <!---------------- Google Maps JS Source  --------------->
    <script src="http://maps.google.com/maps/api/js?key=MY_GOOGLE_MAPS_API_KEY&sensor=false" 
    type="text/javascript"></script>

    <!------------- Google Maps JS  ------------------->
    <script type="text/javascript">

        var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png",
            new google.maps.Size(32, 32), new google.maps.Point(0, 0),
            new google.maps.Point(16, 32));
                    var center = null;
                    var map = null;
                    var currentPopup;
                    var bounds = new google.maps.LatLngBounds();
                    function addMarker(lat, lng, info) {
                        var pt = new google.maps.LatLng(lat, lng);
                        bounds.extend(pt);
                        var marker = new google.maps.Marker({
                            position: pt,
                            icon: icon,
                            map: map
                        });
                        var popup = new google.maps.InfoWindow({
                            content: info,
                            maxWidth: 300
                        });
                        google.maps.event.addListener(marker, "click", function() {
                            if (currentPopup != null) {
                                currentPopup.close();
                                currentPopup = null;
                            }
                            popup.open(map, marker);
                            currentPopup = popup;
                        });
                        google.maps.event.addListener(popup, "closeclick", function() {
                            map.panTo(center);
                            currentPopup = null;
                        });
                    }           
                    function initMap() {
                        map = new google.maps.Map(document.getElementById("map"), {

                            center: new google.maps.LatLng(0, 0),
                            zoom: 14,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            mapTypeControl: true,
                            mapTypeControlOptions: {
                                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
                            },
                            navigationControl: true,
                            navigationControlOptions: {
                                style: google.maps.NavigationControlStyle.ZOOM_PAN
                            }
                        });
    
        <?php
            $path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
            include($path.'wp-load.php');
            $mydb = new wpdb('root','nfs','wpmap','localhost');
            $rows = $mydb->get_results("SELECT * FROM points");
            foreach ($rows as $obj) {
                echo("addMarker($obj->lat, $obj->long, '<b>$obj->name</b>');\n");
            }
        ?>

        center = bounds.getCenter();
        map.fitBounds(bounds);
    }
    </script>

</head>
    <body onLoad="initMap()" style="margin:0px; border:0px; padding:0px;">
        <div id="map"></div>
    </body>
</html>

<?php get_footer(); ?>