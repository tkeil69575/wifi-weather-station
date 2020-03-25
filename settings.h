// Network settings
const char* ssid = "<your wifi ssid>";
const char* password = "<your wifi password>";
const char* espName = "<name of esp8266 in network>"; //name of device in wifi network
char* ntpServer = "<ntp server>"; //e.g., 0.europe.pool.ntp.org

// Minutes to sleep between updates
int minutes2sleep = 15;

// Use SSL
bool ssl_enabled = false;

// Device Token (unencrypted)
String token = "indoor"; //used to identify weather station in php script, e.g., outdoor/indoor

// Endpoint settings
const char* url = "http://<your domain name or ip>/<folder on webserver>/post.php"; //e.g, http://192.168.0.100/myweather/post.php
const char* fingerprint = "79 B1 29 4A 6F CD DB 96 C8 96 03 36 AA 2F F7 D6 08 82 43 71"; //certificate fingerprint (for https usage)
const char* contenttype = "application/x-www-form-urlencoded";

String userAgent = "Tina's WiFi Weather Station - HTTP(S)-Client";
String clientVer = "0.1";
