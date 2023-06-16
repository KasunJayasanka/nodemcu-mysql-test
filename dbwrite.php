// <?php
// // host = localhost because database hosted on the same server where PHP files are hosted
// //everything prefixed with $ is a PHP variable
//     $host = "eu-cdbr-west-03.cleardb.net"; 
//     $dbname = "heroku_cc37febd15469e6";    // Database name
//     $username = "bc198622e1365c";          // Database username
//     $password = "f0e73a72";                // Database password
//     $api_key_value = "tPmAT5Ab3j7F9";

//     $api_key= $sendval=$randomnumber="";

//     if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $api_key = test_input($_POST["api_key"]);
//     if($api_key == $api_key_value) {
//         $randomnumber = test_input($_POST["sendval"]);
        
        
//         // Create connection
//         $conn = new mysqli($host, $username, $password, $dbname);
//         // Check if connection established successfully
//         if ($conn->connect_error) {
//             die("Connection failed: " . $conn->connect_error);
//         } else {
//             echo "Connected to mysql database. ";
//         }
        
//         // A SQL query to insert data into table -> INSERT INTO table_name (col1, col2, ..., colN) VALUES (' " .$col1. " ', '".col2."', ..., ' ".colN." ')
//                 $sql = "INSERT INTO sensorreadings VALUES ('".$randomnumber."')";
//                         if ($conn->query($sql) === TRUE) {
//                             // If the query returns true, it means it ran successfully
//                             echo "Values inserted in MySQL database table.";
//                         } else {
//                             echo "Error: " . $sql . "<br>" . $conn->error;
//                         }
            
    
//         $conn->close();
//     }
//     else {
//         echo "Wrong API Key provided.";
//     }

// }
// else {
//     echo "No data posted with HTTP POST.";
// }


//  //    // Establish connection to MySQL database, using the inbuilt MySQLi library.
//  //    $conn = new mysqli($host, $username, $password, $dbname);
//  //    // Check if connection established successfully
//  //    if ($conn->connect_error) {
//  //        die("Connection failed: " . $conn->connect_error);
//  //    } else {
//  //        echo "Connected to mysql database. ";
//  //    }
//  // //$_POST is a PHP Superglobal that assists us to collect/access the data, that arrives in the form of a post request made to this script.
//  //  // If values sent by NodeMCU are not empty then insert into MySQL database table
//  //  if(!empty($_POST['sendval'])){
//  //        // "sendval" and "sendval2" are query parameters accessed from the HTTP POST Request made by the NodeMCU.
//  //            $randomnumber = $_POST['sendval'];
//  //        // Update your tablename here
//  //        // A SQL query to insert data into table -> INSERT INTO table_name (col1, col2, ..., colN) VALUES (' " .$col1. " ', '".col2."', ..., ' ".colN." ')
//  //                $sql = "INSERT INTO sensorreadings VALUES ('".$randomnumber."')";
//  //                        if ($conn->query($sql) === TRUE) {
//  //                            // If the query returns true, it means it ran successfully
//  //                            echo "Values inserted in MySQL database table.";
//  //                        } else {
//  //                            echo "Error: " . $sql . "<br>" . $conn->error;
//  //                        }
//  //            }
//  //    // Close MySQL connection
//  //    $conn->close();

// function test_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }
// ?>

<?php
// Get the JSON data from the POST request
$jsonData = file_get_contents('php://input');

// Decode the JSON data into an associative array
$data = json_decode($jsonData, true);

// Extract the sensor values
$sensor1 = $data['sensor1'];
$sensor2 = $data['sensor2'];
$sensor3 = $data['sensor3'];
$sensor4 = $data['sensor4'];

// Create a connection to the MySQL server
$servername = 'eu-cdbr-west-03.cleardb.net';
$username = 'bc198622e1365c';
$password = 'f0e73a72';
$dbname = 'heroku_cc37febd15469e6';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Prepare the SQL statement
$sql = "INSERT INTO your_table_name (sensor1, sensor2, sensor3, sensor4) VALUES ('$sensor1', '$sensor2', '$sensor3', '$sensor4')";

// Execute the SQL statement
if ($conn->query($sql) === true) {
    echo 'Data inserted successfully';
} else {
    echo 'Error: ' . $sql . '<br>' . $conn->error;
}

// Close the connection
$conn->close();
?>
