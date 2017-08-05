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
    </style>
</head>
<body>

<?php $city = isset($_POST['city']) ? $_POST['city'] : 'Jakarta'; ?>

<form action="" method="post">
<div id="select" style="display: inline;">
<select class="select" name="city">
  <option <?php if ($city == 'Jakarta') echo 'selected' ; ?>>Jakarta</option>
  <option <?php if ($city == 'Tokyo') echo 'selected' ; ?>>Tokyo</option>
  <option <?php if ($city == 'London') echo 'selected' ; ?>>London</option>
</select>
</div>
<input type="submit" value="Submit">
</form>

<?php
if(!ini_get('date.timezone')) {
    date_default_timezone_set('Asia/Jakarta');
};

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
    echo "<td>" .$date. "</td>";
    echo "<td>" .$temp. " °C</td>";
    echo "<td>" .$variance. " °C</td>";
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>