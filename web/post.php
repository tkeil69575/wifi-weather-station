<?php
# data is written to json file every 15 min
# 4 x 24 = 96 -> 96 x 31 = approx. 2976 records per month

$db = new SQLite3('weather.sqlite');

// Create a table.
$db->query('CREATE TABLE IF NOT EXISTS "weather" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "station" TEXT,
    "time" DATETIME,
    "temp" INTEGER,
    "humi" INTEGER,
    "pres" INTEGER
)');

$statement = $db->prepare('INSERT INTO "weather" ("station", "time", "temp", "humi", "pres")
    VALUES (:station, :time, :temp, :humi, :pres)');
$statement->bindValue(':station', $_POST['token']);
$statement->bindValue(':time', date('Y-m-d H:i:s'));
$statement->bindValue(':temp', $_POST['temperature']);
$statement->bindValue(':humi', $_POST['humidity']);
$statement->bindValue(':pres',  $_POST['pressure']);
$statement->execute();

$db->close();
?>

