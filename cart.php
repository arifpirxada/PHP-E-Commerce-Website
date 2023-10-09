<?php
include "partials/dbconn.php";
include "partials/chk_user_log.php";
include "partials/add_to_cart_func.php";
$total_price = 0;

$orders = false;

if(isset($_SESSION['user'])) {
    $userEmail = $_SESSION['user'];
    $getNum = mysqli_query($conn, "SELECT * FROM e_order WHERE o_user_email = '$userEmail'");
    $num = mysqli_num_rows($getNum);

    if ($num > 0) {
        global $orders;
        $orders = true;
    }
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
        <!-- main nav  -->
        <div class="navbarContain nav-color">
            <a class="d-flex no-underline" href="index.php"><img src="img/logo.png" class="siteLogo" alt="">&nbsp;<p class="siteName">Trendzy</p></a>
            <ul>
                <li><a class="no-underline" href="index.php">Home</a></li>
                <li><a class="no-underline" href="contact.php">Contact</a></li>
            </ul>

            <form class="search-form d-flex" action="search.php" method="get">
                <input type="search" class="search" name="search" onfocus="goDark()" onblur="noDark()" placeholder="search">&nbsp;&nbsp;
                <button type="submit" class="s-btn"><img src="img/searchIcon.png" width="40px" alt=""></button>
            </form>

            <ul>
                <?php
                if ($notLogedIn) { ?>
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

        <!-- mobile nav  -->

        <div class="searchContain">
            <form class="search-form d-flex" action="search.php" method="get">
                <input type="search" class="search mobile-search" name="search" onfocus="goDark()" onblur="noDark()" placeholder="search">&nbsp;&nbsp;
                <button type="submit" class="s-btn mb-s-btn"><img src="img/searchIcon.png" class="srhIcon" width="40px" alt=""></button>
            </form>
        </div>

        <!-- start -->

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
                    <li><a class="prItems home-prItem" id="order" href="my_orders.php">Orders</a></li>
                <?php } ?>

                <li><a class="prItems d-flex home-prItem" id="users" style="background-color: rgba(0, 0, 0, 0.356) !important;" href="cart.php">
                        <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt="">
                        <div class="cart-no d-flex"><?php echo total_products() ?></div>
                    </a></li>
            </ul>
        </div>

        <div class="nav-space pro-space"></div>

    </header>
    <main>



        <!-- Nav end  -->

        <!-- cart heading -->

        <div class="mainCategories d-flex aboutus">
            <h2 class="font-100">
                Your Cart | <b class="font-100 chng-color t-products"><?php echo total_products() ?></b> Products
            </h2>
        </div>

        <!-- Products in Cart  -->

        <div class="mainCategories d-flex">

            <?php
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $value) {
                    $sql = mysqli_query($conn, "SELECT * FROM e_product WHERE id = '$key'");
                    if (!$sql) {
                        echo "some technical issue occured please try later";
                    } else {
                        $row = mysqli_fetch_assoc($sql);
                        $name = $row['pr_name'];
                        $price = $row['pr_price'];
                        $short_desc = $row['pr_short_desc'];
                        $image = $row['pr_fimage'];
                        $pid = $row['id'];
                        $pr_price = $row['pr_price'];
                        $qty = $value['qty'];
                        global $total_price;
                        $total_price = $total_price + $pr_price * $qty;
            ?>
                        <div class="pr-link">
                            <a href="actPro.php?pride=<?php echo $row['id'] ?>">
                                <div class="mainCat mobile-cart">
                                    <img src="img/productImages/<?php echo $image ?>" alt="">
                                    <div class="descContain">

                                        <p class="mainCatType mtl-1"><?php echo $name ?></p>
                                        <p class="mainCatCartDesc shortDesc mtl-1"><?php echo $short_desc ?></p>
                                        <p class="mainCatPrice mtl-1">Starting: ₹<?php echo $price ?></p>
                                    </div>
                                </div>
                                <div class="qty-contain">Quantity: <?php echo $qty ?></div>
                            </a>
                            <img class="del-pr-btn del-cart" onclick="cart_action(<?php echo $pid ?>, 'remove',this)" src="img/del_pr_icon.png" alt="">
                        </div>

            <?php }
                }
            } else {
                echo "Your cart is empty!";
            } ?>

        </div>
        <?php if ($total_price != 0) { ?>
            <div style="margin-top: 0vh;" class="mainCategories d-flex f-column">
                <p class="t-price-contain">Total Price- ₹<b class="font-100 chng-color t-price"><?php echo $total_price ?></b></p>
                <a href="e_order.php">
                    <button class="btn btn-buy">Buy All</button>
                </a>
            </div>
        <?php } ?>
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