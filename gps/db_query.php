<?php

require "../credentials.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// SQL query
$sql = "SELECT lat, lng FROM gps WHERE lat <> 0.00000000 AND lng <> 0.00000000 ORDER BY reading_time DESC LIMIT 1;";

$result = $conn->query($sql);

while ($data = $result->fetch_assoc()){
    $gps_data[] = $data;
}

$lat = array_column($gps_data, 'lat');
$lng = array_column($gps_data, 'lng');
$reading_time = array_column($gps_data, 'reading_time');

$response = array("lat" => $lat[0], "lng" => $lng[0], "reading_time" => $reading_time[0]);
echo json_encode($response);

$conn->close();

?>