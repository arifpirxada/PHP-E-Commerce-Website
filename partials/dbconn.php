<?php
session_start();
$host = "localhost";
$name = "root";
$password = "";
$database = "e-commerce";

$conn = mysqli_connect($host,$name,$password,$database);

if(!$conn) {
    echo "Sorry, Connection was unsuccesful!".mysqli_connect_error($conn);
}

function safe_value($con,$str) {
    $str = trim($str);
    return mysqli_real_escape_string($con,$str);
}
?>