<!DOCTYPE html>
<html lang="en">
<head>
    <title>Climate App</title>
</head>
<body>

<?php
if(!ini_get('date.timezone')) {
    date_default_timezone_set('Asia/Jakarta');
};

$city = "Jakarta";
$url = "http://api.openweathermap.org/data/2.5/forecast/daily?q=$city&mode=json&units=metric&cnt=5&APPID=481e3bc28e5264e5607c2b65b449bfc1";
$json = file_get_contents($url);
$data = json_decode($json, true);

//print_r($data);
//var_dump($data);

echo "<table>";
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
    echo "<td>" .$temp. "C</td>";
    echo "<td>" .$variance. "C</td>";
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>