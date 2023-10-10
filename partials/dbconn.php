<?php
session_start();

// Import env variables ->

$envFilePath = __DIR__ . '/.env';

if (file_exists($envFilePath)) {
    $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        list($key, $value) = explode('=', $line, 2);
        if ($key && $value) {
            putenv("$key=$value");
        }
    }
} else {
    die("Env file not found");
}

$host = getenv('DB_HOST');
$name = getenv('USER');
$password = getenv("DB_PASS");
$database = getenv("DB_NAME");

$conn = mysqli_connect($host,$name,$password,$database);

if(!$conn) {
    echo "Sorry, Connection was unsuccesful!".mysqli_connect_error($conn);
}

function safe_value($con,$str) {
    $str = trim($str);
    return mysqli_real_escape_string($con,$str);
}
?>