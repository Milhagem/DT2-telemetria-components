<?php

require "../credentials.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// SQL query
$sql = "SELECT speed FROM encoder ORDER BY reading_time DESC LIMIT 1";

$result = $conn->query($sql);

// Data treatment
while ($data = $result->fetch_assoc()){
    $encoder_data[] = $data;
}

$rpms = array_column($encoder_data, 'rpm');
$speeds = array_column($encoder_data, 'speed');
$wheel_diameters = array_column($encoder_data, 'wheel_diameter');
$readings_time = array_column($encoder_data, 'reading_time');

// Speed value in km/h
$speed = $speeds[0];

echo $speed;

$conn->close();

?>