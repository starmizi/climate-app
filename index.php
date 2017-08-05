<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Climate App</title>
    <style>
    table {
    width:30%;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: left;
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
    </style>
</head>
<body>

<form action="" method="post">
<div id="select">
<select class="select" name="city">
  <option value="Jakarta">Jakarta</option>
  <option value="Tokyo">Tokyo</option>
  <option value="London">London</option>
</select>
</div>
<input type="submit" value="Submit">
</form>

<?php
if(!ini_get('date.timezone')) {
    date_default_timezone_set('Asia/Jakarta');
};

$city = "Jakarta";
if(isset($_POST)) {
    $city = $_POST['city'];
    echo "City = " .$city;
};

$url = "http://api.openweathermap.org/data/2.5/forecast/daily?q=$city&mode=json&units=metric&cnt=5&APPID=481e3bc28e5264e5607c2b65b449bfc1";
$json = file_get_contents($url);
$data = json_decode($json, true);

//print_r($data);
//var_dump($data);

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
    echo "<td>" .$date. "</td>";
    echo "<td>" .$temp. " °C</td>";
    echo "<td>" .$variance. " °C</td>";
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>