<?php
// admin  database
$host = "localhost";
$user = "root";
$pass = "";
$db = "infirmary_db_admin";
$conn = new mysqli($host, $user, $pass, $db);


if($conn->connect_error){
    echo "Connection error : ". $conn->connect_error;
}



?>