<?php
include "partials/dbconn.php";
include "partials/chk_user_log.php";
include "partials/add_to_cart_func.php";
include "partials/instamojoCredentials.php";

if ($notLogedIn) {
    header("location: login.php");
}

$insertFail = false;
$total_price = 0;
$order_id = null;
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // to get total price

    foreach ($_SESSION['cart'] as $key => $value) {
        $sql = mysqli_query($conn, "SELECT * FROM e_product WHERE id = '$key'");
        if (!$sql) {
            echo "some technical issue occured please try later";
        } else {
            $row = mysqli_fetch_assoc($sql);
            $pr_price = $row['pr_price'];
            $qty = $value['qty'];
            global $total_price;
            $total_price = $total_price + $pr_price * $qty;
        }
    }

    $place = safe_value($conn, $_POST['userPlace']);
    $pincode = safe_value($conn, $_POST['pincode']);
    $address = safe_value($conn, $_POST['properAddress']);
    $longitude = safe_value($conn, $_POST['longitude']);
    $latitude = safe_value($conn, $_POST['latitude']);
    $paymentType = safe_value($conn, $_POST['paymentType']);
    $payment_status = "pending";

    if ($paymentType == "cod") {
        $payment_status = "success";
    }

    global $total_price;
    $userEmail = $_SESSION['user'];

    $sql = "INSERT INTO `e_order` (`o_user_email`, `o_place`, `o_pincode`, `o_proper_address`, `o_longitude`, `o_latitude`, `o_payment_type`, `o_payment_status`, `payment_id`, `payment_request_id`, `o_order_status`, `o_total_price`) VALUES ('$userEmail', '$place', '$pincode', '$address', '$longitude', '$latitude', '$paymentType', '$payment_status', '', '','pending', '$total_price')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        global $insertFail;
        $insertFail = true;
    } else {
        $order_id = mysqli_insert_id($conn);

        foreach ($_SESSION['cart'] as $key => $value) {
            $getProduct = mysqli_query($conn, "SELECT * FROM e_product WHERE id = '$key'");
            if (!$getProduct) {
                echo "some technical issue occured please try later";
            } else {
                $row = mysqli_fetch_assoc($getProduct);
                $pr_price = $row['pr_price'];
                $qty = $value['qty'];

                $insert_details = "INSERT INTO `e_order_detail` (`order_id`, `product_id`, `price`, `quantity`) VALUES ('$order_id', '$key', '$pr_price', '$qty')";
                $result = mysqli_query($conn, $insert_details);
                if (!$result) {
                    global $insertFail;
                    $insertFail = true;
                }
            }
        }
        global $insertFail;
        if (!$insertFail) {
            if ($paymentType == "cod") {
                header("location: thankyou.php");
                unset($_SESSION['cart']);
            } else {
                // Payment gateway starts here

                $userDetail = mysqli_query($conn, "SELECT * FROM e_users WHERE u_email = '$userEmail'");

                if ($userDetail) {
                    $row = mysqli_fetch_assoc($userDetail);

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                    curl_setopt(
                        $ch,
                        CURLOPT_HTTPHEADER,
                        array(
                            "X-Api-Key:$api_key",
                            "X-Auth-Token:$auth_token"
                        )
                    );
                    $payload = array(
                        'purpose' => 'Trendzye order',
                        'amount' => $total_price,
                        'phone' => $row["u_phone"],
                        'buyer_name' => $row["u_name"],
                        'redirect_url' => 'http://localhost/ecommerce/verifyPayment.php',
                        'send_email' => true,
                        // 'webhook' => 'http://XXXX/webhook',
                        'send_sms' => true,
                        'email' => $userEmail,
                        'allow_repeated_payments' => false
                    );
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                    $response = curl_exec($ch);
                    curl_close($ch);

                    $response = json_decode($response);
                    if ($response && $response->success === true) {
                        $payId = $response->payment_request->id;
                        $update_order = mysqli_query($conn, "UPDATE `e_order` SET `payment_request_id` = '$payId' WHERE `e_order`.`o_id` = $order_id");
                        if ($update_order) {
                            header("location:" . $response->payment_request->longurl);
                        } else {
                            header("location: thankyou.php");
                        }
                        die();
                    } else {
                        header("location: thankyou.php");
                        die();
                    }
                    // gateway ends here 
                } else {
                    echo "Unable to find user";
                }
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrendKash Order</title>
</head>
<link rel="stylesheet" href="admin/admin.css">
<link rel="stylesheet" href="css/style.css">

<body class="no-overFlow">

    <!-- main navbar  -->
    <div class="navbarContain nav-color">
        <a class="d-flex no-underline" href="index.php"><img src="img/logo.png" class="siteLogo" alt="">&nbsp;<p class="siteName">Trendzy</p></a>
        <ul>
            <li><a class="no-underline" href="index.php">Home</a></li>
            <li><a class="no-underline" href="contact.php">Contact</a></li>
        </ul>

        <ul>
            <?php if ($notLogedIn) { ?>
                <li><a class="no-underline" href="login.php">Login</a></li>
            <?php } ?>
            <li><a class="d-flex no-underline" href="cart.php">
                    <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt="">
                    <div class="cart-no d-flex"><?php echo total_products() ?></div>
                </a></li>
        </ul>
    </div>

    <!-- mobile navbar  -->
    <div class="box">

        <img id="hamburger" onclick="come()" src="img/Hamburger.png" alt="">
        <ul class="nav home-nav">
            <li><img id="cross" onclick="go()" src="img/Cross.png" alt=""></li>
            <li><a class="d-flex no-underline siteLogo-Mobile" href="index.php"><img src="img/logo.png" class="siteLogo" alt="">&nbsp;<p class="siteName">Trendzy</p></a></li>
            <li><a class="prItems home-prItem" id="categories" href="index.php">Home</a></li>
            <li><a class="prItems home-prItem" id="products" href="contact.php">Contact</a></li>
            <?php if ($notLogedIn) { ?>
                <li><a class="prItems home-prItem" href="login.php">Login</a></li>
            <?php } ?>
            <li><a class="prItems d-flex home-prItem" style="background-color: rgba(0, 0, 0, 0.356);" id="users" href="cart.php">
                    <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt="">
                    <div class="cart-no d-flex"><?php echo total_products() ?></div>
                </a></li>
        </ul>
    </div>

    <div class="nav-space pro-space"></div>

    <!-- navbar ends here  -->

    <!-- for heading  -->

    <div class="mainCategories d-flex aboutus">
        <h2 class="font-100">
            Total | <b class="font-100 chng-color t-products"><?php if (total_products() == 0) {
                                                                    header("location:cart.php");
                                                                } else {
                                                                    echo total_products();
                                                                } ?></b> Products
        </h2>
    </div>


    <!-- heading end  -->

    <div class="container body-clr">
        <form class="adminLog order-contain" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <h2 class="adminLogHead">Address</h2>
            <label class="topLabel" for="userPlace">Select Place</label>
            <select required name="userPlace" class="placeSelect" id="userPlace">
                <option value="handwara" selected>handwara</option>
                <option value="wadipora">wadipora</option>
            </select>

            <label for="pincode">Pincode</label>
            <input required id="pincode" name="pincode" type="number" placeholder="Enter pincode">

            <label for="properAddress">Proper address</label>
            <textarea required name="properAddress" id="properAddress" placeholder="Enter your proper address"></textarea>

            <h2 class="adminLogHead font-100" style="margin-top: 23px; font-size: 21px; padding: 0px 14px;">Enter coordinates for accurate delivery</h2>


            <label for="longitude">Longitude</label>
            <input required id="longitude" name="longitude" type="text" placeholder="Enter longitude">

            <label for="latitude">Latitude</label>
            <input required id="latitude" name="latitude" type="text" placeholder="Enter latitude">

            <h2 class="adminLogHead" style="margin-top: 23px;">Payment Method</h2>
            <div class="d-flex">
                <input required class="payment-input" type="radio" name="paymentType" value="payNow" id="payNow">
                <label for="payNow" onclick="change_background(this)" class="payment-label payNowLabel">Pay Now</label>

                <input required class="payment-input" type="radio" name="paymentType" value="cod" id="cod">
                <label for="cod" onclick="change_background(this)" class="payment-label codLabel">Cash On
                    delivery</label>
            </div>
            <?php global $insertFail;
            if ($insertFail) { ?>
                <p class="notify">Some technical issue! please try later</p>
            <?php } ?>

            <button class="btn submit-btn btn-blue" type="submit">Place Order</button>
        </form>
    </div>

    <script src="js/main.js"></script>
    <script src="admin/admin.js"></script>

</body>

</html>