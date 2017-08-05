<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Climate App</title>
    <style>
    table {
    width:25%;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        margin-top: 10px;
    }
    th {
        padding: 5px;
        text-align: center;
    }
    td {
        padding: 5px;
        text-align: right;
    }
    table#t01 tr:nth-child(even) {
        background-color: #eee;
    }
    table#t01 tr:nth-child(odd) {
       background-color:#fff;
    }
    table#t01 th {
        background-color: black;
        color: white;
    }
    form {
        margin: 10px;
    }
    input[type="submit"] {
        width: 80px;
    }
    </style>
</head>
<body>

<form action="" method="post">
<input type="submit" value="Input City" class="city" placeholder="Jakarta">
<div id="input" style="display: inline;">
<input type="text" name="cityInput">
</div>
</form>

<form action="" method="post">
<input type="submit" value="Select City" class="city">
<div id="select" style="display: inline;">
<select class="select" name="citySelect">
  
  <?php
  if ($_POST['cityInput'] || $_POST['citySelect']) {
    $city = isset($_POST['cityInput']) ? $_POST['cityInput'] : $_POST['citySelect'];
  }
  else {
    $city = 'Jakarta';
  }
  $cityList = array("Jakarta", "Tokyo", "London");

  foreach ($cityList as $value) {
    echo "<option ";
    if ($city == $value) echo 'selected';
    echo "> $value </option>";
  }
  ?>

</select>
</div>
</form>

<?php
if(!ini_get('date.timezone')) {
    date_default_timezone_set('Asia/Jakarta');
};
$city = ucfirst(strtolower($city));
$url = "http://api.openweathermap.org/data/2.5/forecast/daily?q=$city&mode=json&units=metric&cnt=5&APPID=481e3bc28e5264e5607c2b65b449bfc1";
$json = file_get_contents($url);
$data = json_decode($json, true);

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

</body>
</html>