<?php
ini_set("precision", 14); 
ini_set("serialize_precision", -1);
header('Content-Type: application/json');

$db = new SQLite3('weather.sqlite');
$query = "SELECT station, time, temp, humi, pres FROM weather WHERE time >= date('now','-1 day')"; 
$statement = $db->prepare($query);
$result = $statement->execute();

$data_indoor = array();
$data_outdoor = array();

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
  if ($row['station'] == "indoor") {
    array_push($data_indoor, array(
    'time' => $row['time'], 
    'temp' => $row['temp'],
    'humi' => $row['humi'],
    'pres' => $row['pres']));
  } else {
    array_push($data_outdoor, array(
    'time' => $row['time'], 
    'temp' => $row['temp'],
    'humi' => $row['humi'],
    'pres' => $row['pres']));
  }
}

$result->finalize();
$db->close();

$data = array_merge(array("indoor" => $data_indoor), array ("outdoor" => $data_outdoor));
echo json_encode($data, JSON_PRETTY_PRINT);
?>
