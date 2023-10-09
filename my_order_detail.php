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
                $total_price = 0;


                if (!isset($_GET['ordid'])) {
                    die("No orders found");
                }
                // Getting user orders
                $ordid = $_GET['ordid'];
                $getOrderedProducts = mysqli_query($conn, "SELECT * FROM e_order_detail WHERE order_id = '$ordid'");

                if (!$getOrderedProducts) {
                    die("sorry some technical issue occured");
                }
                $total_products = mysqli_num_rows($getOrderedProducts);
                while ($row = mysqli_fetch_assoc($getOrderedProducts)) {
                    $product_price = $row['price'];
                    $product_qty = $row['quantity'];

                    global $total_price;
                    $total_price = $total_price + $product_price * $product_qty;
                }

                ?>

                Ordered <?php echo $total_products ?> Products | Total Price: ₹<?php echo $total_price ?>
            </h2>

            <!-- To know if order is already cancelled or not -->
            <?php
            $getOrder = mysqli_query($conn, "SELECT * FROM e_order WHERE o_id = '$ordid'");
            if (!$getOrder) {
                die("some technical issue occured!");
            }
            $row = mysqli_fetch_assoc($getOrder);
            $order_status = $row['o_order_status'];

            if ($order_status == "cancelled") {
            ?>
                <p>order cancelled</p>
            <?php
            } else {
            ?>
                <div class="del-pr-btn">
                    <p class="cancel-order" onclick="cancelOrder(this,<?php echo $ordid ?>)">cancel order</p>
                    <img width="20px" src="img/del_pr_icon.png" alt="">
                </div>
            <?php } ?>
        </div>

        <!-- my orders  -->

        <!-- starts here  -->


        <div class="mainCategories d-flex">

            <?php

            // Getting user orders
            $ordid = $_GET['ordid'];
            $getOrderedProducts = mysqli_query($conn, "SELECT * FROM e_order_detail WHERE order_id = '$ordid'");

            if (!$getOrderedProducts) {
                die("sorry some technical issue occured");
            } else {
                while ($row = mysqli_fetch_assoc($getOrderedProducts)) {
                    $product_id = $row['product_id'];
                    $product_price = $row['price'];
                    $product_qty = $row['quantity'];

                    $getProduct = mysqli_query($conn, "SELECT pr_name, pr_short_desc, pr_fimage FROM e_product WHERE id = '$product_id'");
                    if (!$getProduct) {
                        die("sorry some technical issue occured");
                    }
                    $product = mysqli_fetch_assoc($getProduct);
                    $product_img = $product['pr_fimage'];
                    $name = $product['pr_name'];
                    $desc = $product['pr_short_desc'];
            ?>

                    <a class="pr-link" href="actPro.php?pride=<?php echo $product_id ?>">
                        <div class="mainCat mobile-cart">
                            <img src="img/productImages/<?php echo $product_img ?>" alt="">
                            <div class="descContain">

                                <p class="mainCatType mtl-1"><?php echo $name ?></p>
                                <p class="mainCatCartDesc shortDesc mtl-1"><?php echo $desc ?></p>
                                <p class="mainCatPrice mtl-1">Price: ₹<?php echo $product_price ?></p>
                            </div>
                        </div>
                        <div class="qty-contain">Quantity: <?php echo $product_qty ?></div>
                    </a>

            <?php }
            } ?>
        </div>

        <!-- ends here  -->
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