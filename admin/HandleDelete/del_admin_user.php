<?php

include "../../partials/dbconn.php";
if (!isset($_SESSION['ad_login']) || $_SESSION['ad_login'] != true) {
    header("location: ../adminLog.php");
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $input = file_get_contents('php://input');
    $decode = json_decode($input, true);
    $admin_id = $decode['adminId'];

    $delete = mysqli_query($conn, "DELETE FROM `admin_users` WHERE `admin_users`.`ad_id` = $admin_id");
    if (!$delete) {
        echo "Delete unsuccessful";
    }

}
