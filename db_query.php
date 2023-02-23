<?php

// REPLACE with your Database hostname
$hostname = "HOSTNAME";
// REPLACE with your Database port
$port = 00000;
// REPLACE with your Database name
$dbname = "DB_NAME";
// REPLACE with Database user
$username = "DB_USERNAME";
// REPLACE with Database user password
$password = "DB_PASSOWRD";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// SQL query
$sql = "SELECT celcius, farenheits, reading_time FROM lm35 ORDER BY reading_time desc LIMIT 1;";

$result = $conn->query($sql);

while ($data = $result->fetch_assoc()){
    $lm35[] = $data;
}

$celcius = array_column($lm35, 'celcius');
$farenheits = array_column($lm35, 'farenheits');
$readings_time = array_column($lm35, 'reading_time');

// Temperature value in celsius degrees
$temperature = $celcius[0];

$conn->close();

?>
