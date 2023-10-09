<?php
session_start();
include "../partials/add_to_cart_func.php";

if(!isset($_SESSION['userLog']) || $_SESSION['userLog'] != true) {
    echo "notLogedIn";
} else {
    $input = file_get_contents("php://input");
    $decode = json_decode($input, true);

    $product_id = $decode['pid'];
    if (isset($decode['qty'])) {
        $qty = $decode['qty'];
    }
    $type= $decode['type'];

    if($type == "add") {
        add_product($product_id, $qty);
    }
    else if ($type == "remove") {
        remove_product($product_id);
    }
    echo total_products();
}
?>