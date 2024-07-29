<?php

$database = "user_management";
$servername = "localhost";
$username = "root";
$password = "";

// create db connection
$conn = new mysqli($servername, $username, $password, $database);

// check connection
if($conn->connect_error){
    die("Database connection fail.". $conn->connect_error);
}



?>