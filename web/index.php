<?php
$db = new SQLite3('weather.sqlite');
$query_indoor = "SELECT time, temp, humi, pres FROM weather WHERE station='indoor' ORDER BY time DESC LIMIT 1"; 
$statement = $db->prepare($query_indoor) or die ("Can't access weather.sqlite. Maybe there's is not data yet.");
$result_indoor = $statement->execute();

while ($row = $result_indoor->fetchArray(SQLITE3_ASSOC)) {
  $time_indoor = $row['time'];
  $temp_indoor = $row['temp'];
  $humi_indoor = $row['humi'];
  $pres_indoor = $row['pres'];
}

$ts_indoor = strtotime($time_indoor);
$hour_min_indoor = date("H:i", $ts_indoor);

$query_outdoor = "SELECT time, temp, humi, pres FROM weather WHERE station='outdoor' ORDER BY time DESC LIMIT 1"; 
$statement = $db->prepare($query_outdoor) or die ("Can't read outdoor data from sqllite db");
$result_outdoor = $statement->execute();

while ($row = $result_outdoor->fetchArray(SQLITE3_ASSOC)) {
  $time_outdoor = $row['time'];
  $temp_outdoor = $row['temp'];
  $humi_outdoor = $row['humi'];
  $pres_outdoor = $row['pres'];
}

$ts_outdoor = strtotime($time_outdoor);
$hour_min_outdoor = date("H:i", $ts_outdoor);

$db->close();
?>
<html>
<head>
<title>Tina's Wifi-Weather Station</title>
<link rel="stylesheet" href="css/font.css">
<link rel="stylesheet" href="css/weather-icons.min.css" />
<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div id="wrapper">
<div id="draussen" class="center">
<p><a href="#" onclick="detailsPopup('details.php', 'draussen', 1050, 580);">Bird Nest<br>
<span class="time-draussen"><?php echo $hour_min_outdoor; ?></span><br>
<span class="temp"><?php echo $temp_outdoor; ?> °C</span><br>
<i class="wi wi-humidity"></i> <?php echo $humi_outdoor; ?> %&nbsp;&nbsp;&nbsp;<i class="wi wi-barometer"></i> <?php echo $pres_outdoor; ?> hPa
</p></a>
</div>

<div id="drinnen" class="center">
<p><a href="#" onclick="detailsPopup('details.php', 'drinnen', 1050, 600);">Tina's Zimmer<br>
<span class="time-drinnen"><?php echo $hour_min_indoor; ?></span><br>
<span class="temp"><?php echo $temp_indoor; ?> °C</span><br>
<i class="wi wi-humidity"></i> <?php echo $humi_indoor; ?> %&nbsp;&nbsp;&nbsp;<i class="wi wi-barometer"></i> <?php echo $pres_indoor; ?> hPa</p></a>
</div>
</div>

<script>
function detailsPopup(myURL, title, myWidth, myHeight) {
  var w = document.body.clientWidth;
  var h = document.body.clientHeight;
  var x = window.screenTop + 50;
  var y = window.screenLeft;
  var left = ((w-myWidth)/2) + y, top = ((h-myHeight)/2) + x;
  var myWindow = window.open(myURL, title, 'width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
}
</script>
</body>
</html>
