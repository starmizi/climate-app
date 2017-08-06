<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://openlayers.org/en/v4.2.0/css/ol.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Climate App</title>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v4.2.0/build/ol.js"></script>
  </head>
  <body>
    <div id="map" class="map"></div>
    <p class="map-title">SIMPLE CLIMATE APP<br/>
    created by      : Said Tarmizi <br/>
    data used       : OpenWeatherMap <br/>
    tested device   : Laptop (1366px) <br/>
    tested browser  : Google Chrome v60
    </p>
    <form id="inputCity" action="" method="post">
    <input type="submit" value="Input City" id="cityName" class="city" placeholder="Jakarta">
    <div id="input" style="display: inline;">
    <input type="text" name="cityInput">
    </div>
    </form>
  
    <?php
    if(!ini_get('date.timezone')) {
        date_default_timezone_set('Asia/Jakarta');
    };
    $city = $_POST['cityInput'] ? $_POST['cityInput'] : 'Jakarta';
    $city = ucfirst(strtolower($city));
    $url = "http://api.openweathermap.org/data/2.5/forecast/daily?q=$city&mode=json&units=metric&cnt=5&APPID=481e3bc28e5264e5607c2b65b449bfc1";
    $json = file_get_contents($url);
    $data = json_decode($json, true);
    $lon = $data['city']['coord']['lon'];
    $lat = $data['city']['coord']['lat']; 
    echo "<table id='t01'>";
    echo "<tr>";
    echo "<th>$city</th>";
    echo "<th>Temperature</th>";
    echo "<th>Variance</th>";
    foreach ($data['list'] as $key => $value) {
        $date = date("Y-m-d", $value['dt']);
        $temp = $value['temp']['day'];
        $variance = $value['temp']['max'] - $value['temp']['min'];
        echo "<tr>";
        echo "<td>$date</td>";
        echo "<td>$temp °C</td>";
        echo "<td>$variance °C</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>

    <script>
      var cityLoc = ol.proj.fromLonLat([<?php echo "$lon, $lat"; ?>]);
      var iconFeature = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.transform([<?php echo "$lon, $lat"; ?>], 'EPSG:4326',     
        'EPSG:3857'))
      });
    </script>
    <script src="js/fly2City.js"></script>

  </body>
</html>