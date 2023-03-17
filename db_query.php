<?php

require "credentials.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// SQL query
$sql = "SELECT power FROM ina226 ORDER BY reading_time DESC LIMIT 1";

$result = $conn->query($sql);

// Data treatment
while ($data = $result->fetch_assoc()){
    $ina226_data[] = $data;
}

$voltages_battery = array_column($ina226_data, 'voltage_battery');
$currents_motor = array_column($ina226_data, 'current_motor');
$powers = array_column($ina226_data, 'power');
$consuptions = array_column($ina226_data, 'consuption');
$readings_time = array_column($ina226_data, 'reading_time');

// Power value in watts
$power = $powers[0];

echo $power;

$conn->close();

?>