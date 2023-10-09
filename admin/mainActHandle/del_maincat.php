<?php

include "../../partials/dbconn.php";
if (!isset($_SESSION['ad_login']) || $_SESSION['ad_login'] != true) {
    header("location: ../adminLog.php");
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $input = file_get_contents('php://input');
    $decode = json_decode($input, true);
    $cat_id = $decode['catId'];

    $getImg = mysqli_query($conn, "SELECT * FROM main_categories WHERE m_id = $cat_id");
    if (!$getImg) {
        echo "selection was not possible, try later";
    }
    $row = mysqli_fetch_assoc($getImg);
    $img = $row['m_img'];
    $delete = mysqli_query($conn, "DELETE FROM `main_categories` WHERE `main_categories`.`m_id` = $cat_id");
    if (!$delete) {
        echo "Delete unsuccessful!";
    }
    if (unlink('../../img/mainCatImages/' . $img . '')) {

    }
    else {
        echo "Img delete successful!";
    }
}

?>