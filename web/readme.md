# PHP Web Interface for ESP8266 Weather Station 

PHP Script to display weather data (temperature, humidity and pressure) from one or more Arduino ESP8266s (if token name is differnt). The ESP8266 measures posts its data to post.php, which process the data and stores them an SQLite database. The SQLite database (weather.sqlite) is created automatically and saved in the same folder, see post.php. Detailed stats are display using Charts.js.

## Here for 2 weather stations (indoor and outdoor)
![Image description](https://github.com/tkeil69575/wifi-weather-station/blob/master/web/screenshots/screenshot-web1.png)
