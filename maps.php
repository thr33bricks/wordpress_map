<?php /* Template Name: GoogleMapsPoints */ ?>
<?php get_header(); ?>

<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Google Maps</title>

    <!------------------ Map CSS ----------------------------->
    <style type="text/css">
        body {
            font: normal 10pt Helvetica, Arial;
        }

        #map {
            width: 800px;
            height: 800px;
            border: 0px;
            padding: 0px;
        }
    </style>

    <!---------------- Google Maps JS Source  --------------->
    <script src="http://maps.google.com/maps/api/js?key=MY_GOOGLE_MAPS_API_KEY&sensor=false" type="text/javascript"></script>

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
            $countries = array(
                "AF",
                "AL",
                "DZ",
                "AS",
                "AD",
                "AO",
                "AI",
                "AQ",
                "AG",
                "AR",
                "AM",
                "AW",
                "AU",
                "AT",
                "AZ",
                "BS",
                "BH",
                "BD",
                "BB",
                "BY",
                "BE",
                "BZ",
                "BJ",
                "BM",
                "BT",
                "BO",
                "BQ",
                "BA",
                "BW",
                "BV",
                "BR",
                "IO",
                "BN",
                "BG",
                "BF",
                "BI",
                "CV",
                "KH",
                "CM",
                "CA",
                "KY",
                "CF",
                "TD",
                "CL",
                "CN",
                "CX",
                "CC",
                "CO",
                "KM",
                "CD",
                "CG",
                "CK",
                "CR",
                "HR",
                "CU",
                "CW",
                "CY",
                "CZ",
                "CI",
                "DK",
                "DJ",
                "DM",
                "DO",
                "EC",
                "EG",
                "SV",
                "GQ",
                "ER",
                "EE",
                "SZ",
                "ET",
                "FK",
                "FO",
                "FJ",
                "FI",
                "FR",
                "GF",
                "PF",
                "TF",
                "GA",
                "GM",
                "GE",
                "DE",
                "GH",
                "GI",
                "GR",
                "GL",
                "GD",
                "GP",
                "GU",
                "GT",
                "GG",
                "GN",
                "GW",
                "GY",
                "HT",
                "HM",
                "VA",
                "HN",
                "HK",
                "HU",
                "IS",
                "IN",
                "ID",
                "IR",
                "IQ",
                "IE",
                "IM",
                "IL",
                "IT",
                "JM",
                "JP",
                "JE",
                "JO",
                "KZ",
                "KE",
                "KI",
                "KP",
                "KR",
                "KW",
                "KG",
                "LA",
                "LV",
                "LB",
                "LS",
                "LR",
                "LY",
                "LI",
                "LT",
                "LU",
                "MO",
                "MG",
                "MW",
                "MY",
                "MV",
                "ML",
                "MT",
                "MH",
                "MQ",
                "MR",
                "MU",
                "YT",
                "MX",
                "FM",
                "MD",
                "MC",
                "MN",
                "ME",
                "MS",
                "MA",
                "MZ",
                "MM",
                "NA",
                "NR",
                "NP",
                "NL",
                "NC",
                "NZ",
                "NI",
                "NE",
                "NG",
                "NU",
                "NF",
                "MP",
                "NO",
                "OM",
                "PK",
                "PW",
                "PS",
                "PA",
                "PG",
                "PY",
                "PE",
                "PH",
                "PN",
                "PL",
                "PT",
                "PR",
                "QA",
                "MK",
                "RO",
                "RU",
                "RW",
                "RE",
                "BL",
                "SH",
                "KN",
                "LC",
                "MF",
                "PM",
                "VC",
                "WS",
                "SM",
                "ST",
                "SA",
                "SN",
                "RS",
                "SC",
                "SL",
                "SG",
                "SX",
                "SK",
                "SI",
                "SB",
                "SO",
                "ZA",
                "GS",
                "SS",
                "ES",
                "LK",
                "SD",
                "SR",
                "SJ",
                "SE",
                "CH",
                "SY",
                "TW",
                "TJ",
                "TZ",
                "TH",
                "TL",
                "TG",
                "TK",
                "TO",
                "TT",
                "TN",
                "TR",
                "TM",
                "TC",
                "TV",
                "UG",
                "UA",
                "AE",
                "GB",
                "UM",
                "US",
                "UY",
                "UZ",
                "VU",
                "VE",
                "VN",
                "VG",
                "VI",
                "WF",
                "EH",
                "YE",
                "ZM",
                "ZW",
                "AX"
            );

            $allCities = [];

            //Get all top cities from all countries
            foreach ($countries as $ctry) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.apilayer.com/geo/country/cities/" . $ctry,
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: text/plain",
                        "apikey: bTbrdZpP29yWNBJzPPYTiaUn1Gi9KWil"
                    ),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET"
                ));

                $response = curl_exec($curl);
                curl_close($curl);

                echo $response;
                foreach ($response as $res) {
                    $allCities[] = $res;
                }
            }

            //Display the content on the map
            $path = preg_replace('/wp-content(?!.*wp-content).*/', '', __DIR__);
            include($path . 'wp-load.php');
            $mydb = new wpdb('root', 'nfs', 'wpmap', 'localhost');
            $rows = $mydb->get_results("SELECT * FROM points");
            foreach ($rows as $obj) {
                echo ("addMarker($obj->lat, $obj->long, '<b>$obj->name</b>');\n");
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