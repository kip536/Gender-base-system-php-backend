
<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With');


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
$result = mysqli_query($conn, "SELECT case_area, count(*) as num
from inbox_messages
group by case_area
order by count(*) desc");
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
        
    }
    //convert php data to json data
    // echo json_encode($rows[0]);
    
    if (!empty($rows)) {
        $response = array($rows[0]);
        echo json_encode($response);
    }
    else {
        $response = array('status'=>'invalid username or password');
        echo json_encode($response);
    }
?>