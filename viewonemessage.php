<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Content-type:application/json");

// decode the json data gotten from the icoming post request
$data = json_decode(file_get_contents("php://input"));

// create variables to store the individual values/entities in the decoded data
$msgid = $data->msg_id;

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "reactphptest";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = mysqli_query($conn, "SELECT * from inbox_messages where msg_id='$msgid'");
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
        
    }
    
    print json_encode($rows); //convert php data to json data
?>