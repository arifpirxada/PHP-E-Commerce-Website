<?php
include "../partials/dbconn.php";
include "../partials/add_to_cart_func.php";

if(!isset($_SESSION['userLog']) || $_SESSION['userLog'] != true) {
    echo "notLogedIn";
} else {
    $input = file_get_contents("php://input");
    $decode = json_decode($input, true);

    $order_id = $decode['ordid'];

    $update_order = mysqli_query($conn, "UPDATE `e_order` SET `o_order_status` = 'cancelled' WHERE `e_order`.`o_id` = $order_id");

    if (!$update_order) {
        echo "fail";
    } else {
        echo "success";
    }
}
?>