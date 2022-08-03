<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header('Content-type:application/json');



// $rest_json = file_get_contents("php://input");
// $_POST = json_decode($rest_json, true);
$data = json_decode(file_get_contents("php://input"));
// $results = file_get_contents("php://input");
echo "received data";
$name = $data->name;
$email = $data->email;
$phone = $data->phone;
$country = $data->country;
$location = $data->location;

   

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "reactphptest";

//connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function random_num($length){
    $text = "";
    if ($length < 5){
        $length = 5;
    }
    $len = rand(4, $length);

    for ($i=0; $i < $len; $i++) { 
        # code...

        $text .= rand(0,9);
    }

    return $text;
}

$user_id = random_num(20);

$sql = mysqli_query($conn, "insert into users (name, email, location, phone_no) values ('$name', '$email', '$location', '$phone')");

if ($sql) {
    $response['data'] = array('status'=>'success');
    echo json_encode($response);
}
else {
    $response['data'] = array('status'=>'failed');
    echo json_encode($response);
}

?>