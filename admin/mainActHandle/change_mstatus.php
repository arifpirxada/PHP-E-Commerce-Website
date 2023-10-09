<?php

include "../../partials/dbconn.php";
if(!isset($_SESSION['ad_login']) || $_SESSION['ad_login'] != true ) {
    header("location: ../adminLog.php");
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $input = file_get_contents('php://input');
    $decode = json_decode($input, true);
    $status = $decode['status'];
    $cat_id = $decode['catId'];

    $update = mysqli_query($conn, "UPDATE `main_categories` SET `m_status` = '$status' WHERE `main_categories`.`m_id` = $cat_id;");
    if(!$update) {
        echo "no";
    }
}
?>