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
$result = mysqli_query($conn, "SELECT (/*FGM percentage*/SELECT (SELECT COUNT(case_title) FROM inbox_messages WHERE case_title='FGM')/(SELECT COUNT(*) from inbox_messages) * 100) as FGM,

-- child labour percentage
(SELECT (SELECT COUNT(case_title) FROM inbox_messages WHERE case_title='child labour')/(SELECT COUNT(*) from inbox_messages) * 100) as childlabour,

-- domestic violence percentage
(SELECT (SELECT COUNT(case_title) FROM inbox_messages WHERE case_title='Domestic violence')/(SELECT COUNT(*) from inbox_messages) * 100) as domesticviolence,

-- other cases percentage
(SELECT ((SELECT COUNT(*) from inbox_messages)-((SELECT COUNT(case_title) FROM inbox_messages WHERE case_title='FGM')+(SELECT COUNT(case_title) FROM inbox_messages WHERE case_title='child labour')+(SELECT COUNT(case_title) FROM inbox_messages WHERE case_title='Domestic violence')))/(SELECT COUNT(*) from inbox_messages) * 100) as others 

FROM inbox_messages");

    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows = $r;
        
    }
    
     //convert php data to json data
    // print json_encode($rows);


    if (!empty($rows)) {
        $response = array($rows);
        echo json_encode($response);
    }
    else {
        $response = array('status'=>'invalid username or password');
        echo json_encode($response);
    }

?>
