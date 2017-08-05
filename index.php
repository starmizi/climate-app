<!DOCTYPE html>
<html lang="en">
<head>
    <title>Climate App</title>
</head>
<body>

<?php
$url = "http://api.openweathermap.org/data/2.5/forecast/daily?q=Jakarta&mode=json&units=metric&cnt=5&APPID=481e3bc28e5264e5607c2b65b449bfc1";
$json = file_get_contents($url);
$data = json_decode($json, true);

print_r($data);
var_dump($data);

echo "<table>";
echo "<tr>";
echo "<th>Jakarta</th>";
echo "<th>Temperature</th>";
echo "<th>Variance</th>";
echo "</table>";
?>

</body>
</html>