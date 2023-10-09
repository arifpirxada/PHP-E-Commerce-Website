<?php

include "../../partials/dbconn.php";
if (!isset($_SESSION['ad_login']) || $_SESSION['ad_login'] != true) {
    header("location: ../adminLog.php");
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $input = file_get_contents('php://input');
    $decode = json_decode($input, true);
    $contact_id = $decode['message_id'];

    $delete = mysqli_query($conn, "DELETE FROM `e_contacts` WHERE `e_contacts`.`sno` = $contact_id");
    if (!$delete) {
        echo "Delete unsuccessful";
    }

}
