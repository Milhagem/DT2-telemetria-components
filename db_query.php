<?php

require "credentials.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// SQL query
$sql = "SELECT voltage_battery, current_motor FROM ina226 ORDER BY reading_time DESC LIMIT 1";

$result = $conn->query($sql);

// Data treatment
while ($data = $result->fetch_assoc()){
    $ina266_data[] = $data;
}

$voltages_battery = array_column($ina266_data, 'voltage_battery');
$currents_motor = array_column($ina266_data, 'current_motor');

$response = array("voltage_battery" => $voltages_battery[0], "current_motor" => $currents_motor[0]);
echo json_encode($response);

$conn->close();

?>