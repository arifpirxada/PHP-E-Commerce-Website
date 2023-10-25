<link rel="stylesheet" href="css/style.css">
<?php
include "partials/dbconn.php";
echo "<div id='transaction-loader' class='text-center'><div class='loader'></div></div>";
echo "<div id='transaction-text' class='transaction-style'>Transaction in process. Please do not reload!</div>";

$payment_status = $_GET["payment_status"];
$payment_id = $_GET["payment_id"];
$payment_request_id = $_GET["payment_request_id"];

if ($_GET && $payment_status && $payment_id && $payment_request_id) {
    unset($_SESSION['cart']);

    $updateOrder = mysqli_query($conn, "UPDATE `e_order` SET `o_payment_status` = '$payment_status', `payment_id` = '$payment_id' WHERE `e_order`.`payment_request_id` = '$payment_request_id'");

    if ($updateOrder) {
        echo '<div class="transaction-style c-green text-center">
    Payment successful!<br>
    Congratulations! your order has been placed
    </div>
    <div class="text-center">
    <a href="my_orders.php">
    <button id="order-btn" class="btn btn-buy">My orders</button>
    </a></div>';
?>
        <script>
            document.getElementById("transaction-loader").hidden = true
            document.getElementById("transaction-text").hidden = true
        </script>
<?php
    } else {
        header("location: thankyou.php");
    }
} else {
    header("location: index.php");
}
?>