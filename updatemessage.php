<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Content-type:application/json");

// decode the json data gotten from the icoming post request
$data = json_decode(file_get_contents("php://input"));

// create variables to store the individual values/entities in the decoded data
$msgid = $data->msg_id;
$casetype = $data->category;
$action = $data->action;
$report = $data->report;
$updatedby = $data->updatedby;
$updatedate = $data->date;
// $location = $data->location;

// connect to the database
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "reactphptest";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection if it is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// execute sql querry to fetch the user details and match them if the name and the password matches
$sql = mysqli_query($conn, "UPDATE inbox_messages SET case_title='$casetype',action='$action',report='$report',updated_by='$updatedby',report_update_date='$updatedate' WHERE msg_id=$msgid");

// store fetched results in an array
$rows = array();
while($r = mysqli_fetch_assoc($sql)) {
    $rows = $r;
    
}

// condition for returning the response
if (!empty($rows)) {
    $response = $rows;
    echo json_encode($response);
}
else {
    $response = array('status'=>'invalid username or password');
    echo json_encode($response);
}

?>