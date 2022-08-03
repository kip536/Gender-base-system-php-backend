<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With');


$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "sms";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = mysqli_query($conn, "SELECT * from inbox_route");
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
        
    }
    
    print json_encode(['result'=>$rows]); //convert php data to json data
?>