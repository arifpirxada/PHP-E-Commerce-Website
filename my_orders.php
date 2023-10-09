<?php
include "partials/dbconn.php";
include "partials/chk_user_log.php";
include "partials/add_to_cart_func.php";

if ($notLogedIn) {
    header("location: login.php");
    die();
}

$orders = false;


$userEmail = $_SESSION['user'];
$getNum = mysqli_query($conn, "SELECT * FROM e_order WHERE o_user_email = '$userEmail'");
$num = mysqli_num_rows($getNum);

if ($num > 0) {
    global $orders;
    $orders = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendzy</title>
    <link rel="stylesheet" href="admin/admin.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="body-clr">
    <header>
        <div hidden class="dark-body"></div>
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

                <?php global $orders;
                if ($orders) { ?>
                    <li><a class="no-underline" href="my_orders.php">Orders</a></li>
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
                    <li><a class="prItems home-prItem" id="order" href="login.php">Login</a></li>
                <?php } ?>

                <?php global $orders;
                if ($orders) { ?>
                    <li><a class="prItems home-prItem" id="order" style="background-color: rgba(0, 0, 0, 0.356);" href="my_orders.php">Orders</a></li>
                <?php } ?>

                <li><a class="prItems d-flex home-prItem" id="users" href="cart.php">
                        <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt="">
                        <div class="cart-no d-flex"><?php echo total_products() ?></div>
                    </a></li>
            </ul>
        </div>

        <!-- navbar end -->
        <div class="nav-space pro-space"></div>

    </header>
    <main>



        <!-- Nav end  -->

        <!-- my orders heading  -->

        <div class="mainCategories d-flex aboutus">
            <h2 style="font-weight: 100;">

                <?php
                $currentUser = $_SESSION['user'];
                $getOrder = mysqli_query($conn, "SELECT * FROM e_order WHERE o_user_email = '$currentUser'");

                if (!$getOrder) {
                    die('some technical issue occured, please try later!');
                }
                $total_products = mysqli_num_rows($getOrder);
                ?>
                Total | <?php echo $total_products ?> Orders
            </h2>
        </div>

        <!-- my orders  -->

        <!-- starts here  -->

        <div class="mainCategories d-flex">

            <?php

            // Getting user orders
            $currentUser = $_SESSION['user'];
            $getOrder = mysqli_query($conn, "SELECT * FROM e_order WHERE o_user_email = '$currentUser' order by o_id desc");

            if (!$getOrder) {
                echo "technical issue while fetching main categories";
            } else {
                while ($row = mysqli_fetch_assoc($getOrder)) {
                    $my_order_id = $row['o_id'];
                    $my_address = $row['o_proper_address'];
                    $my_date = $row['o_date'];
                    $my_order_status = $row['o_order_status'];
                    $my_payment_status = $row['o_payment_status'];
            ?>

                    <a class="pr-link" href="my_order_detail.php?ordid=<?php echo $my_order_id ?>">
                        <div class="mainCat mobile-cart f-column align-it-start">
                            <p class="c-black order-id mb-9">Order Id: <c class="c-coloured"><?php echo $my_order_id ?></c>
                            </p>

                            <p class="c-black order-address mb-5"><b>Address:</b>&nbsp;<?php echo $my_address ?></p>
                            <p class="c-coloured order-date mb-5"><b class="c-black">Date:</b>&nbsp;<?php echo $my_date ?></p>
                            <div class="status-contain d-flex">
                                <p class="c-black order-status"><b>Status:</b>&nbsp;order status: <c class="c-coloured"><?php echo $my_order_status ?></c>
                                </p>&nbsp;&nbsp;
                                <p class="c-black order-pay-status">payment status: <c class="c-coloured"><?php echo $my_payment_status ?></c>
                                </p>
                            </div>
                        </div>
                    </a>

            <?php }
            } ?>

        </div>
    </main>


    <footer>
        <div class="mainCategories mainFoot">
            <div class="footcats d-flex">
                <a target="_blank" href="footer/aboutus.php">About Us</a>
                <a target="_blank" href="footer/faqs.php">FAQs</a>
            </div>
            <div class="footcats d-flex">
                <a target="_blank" href="footer/privacypolicy.php">Privacy Policy and Terms of Service</a>
                <a target="_blank" href="footer/returns.php">Returns and Refunds Policy</a>
            </div>
            <div class="footcats d-flex">
                <a target="_blank" href="https://www.instagram.com/arif_pirxada/">instagram</a>
            </div>
        </div>
    </footer>



    <script src="js/main.js"></script>
    <script src="admin/admin.js"></script>
</body>

</html>