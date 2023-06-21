<?php

// Change port accordingly
$servername = "eu-cdbr-west-03.cleardb.net";

// REPLACE with your Database name
$dbname = "heroku_cc37febd15469e6";
// REPLACE with Database user
$username = "bc198622e1365c";
// REPLACE with Database user password
$password = "f0e73a72";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page.
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "tPmAT5Ab3j7F9";

$apiKey = $sensorValue1 = $sensorValue2 = $sensorValue3 = $sensorValue4 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $apiKey = test_input($data["apiKey"]);

        if($apiKey == $api_key_value){
            $sensorValue1 = test_input($data["sensorValue1"]);
            $sensorValue2 = test_input($data["sensorValue2"]);
            $sensorValue3 = test_input($data["sensorValue3"]);
            $sensorValue4 = test_input($data["sensorValue4"]);
        }else{
            echo $apiKey."Wrong API Key provided!";
            return;
        }


        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = '';

        // Select group of the session
        $sql = "INSERT INTO nodemcu_table VALUES ('".$sensorValue1."','".$sensorValue2."', '".$sensorValue3."', '".$sensorValue4."')";
        
        if ($conn->query($sql) === true)
        {
            echo 'Data inserted successfully';
        } 
        else 
        {
            echo 'Error: ' . $sql . '<br>' . $conn->error;
        }

        // Close the connection
        $conn->close();

}else{
    echo 'No POST Request has been received!';
}

function test_input($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
