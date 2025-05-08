<?php
include "../partials/dbconn.php";
include "chk.php";
include "../partials/add_to_cart_func.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body class="body-clr">
    <header>


        <div class="box">
            <img hidden id="hamburger" style="visibility: visible; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;" onclick="come()" src="../img/Hamburger.png" alt="">
            <ul class="nav">
                <li><img id="cross" onclick="go()" src="../img/Cross.png" alt=""></li>
                <li><a class="prItems" id="categories"
                        href="index.php">Categories</a></li>
                <li><a class="prItems" id="products" href="selectCat.php">Products</a></li>
                <li><a class="prItems" id="order"  style="background-color: #FFC300;" href="Order.php">Orders</a></li>
                <li><a class="prItems" id="users" href="users.php">Users</a></li>
                <li><a class="prItems" id="adminContact" href="adminContact.php">Contact</a></li>
            </ul>
        </div>

    </header>

    <main>

        <!-- my orders heading  -->

        <div class="mainCategories d-flex aboutus">
            <h2 style="font-weight: 100;">

                <?php
                $getOrder = mysqli_query($conn, "SELECT * FROM e_order");

                if (!$getOrder) {
                    die('some technical issue occured, please try later!');
                }
                $total_products = mysqli_num_rows($getOrder);
                ?>
                Total | <?php echo $total_products ?> Orders
            </h2>
        </div>

        <!-- order listing starts here  -->

        <div class="mainCategories d-flex">

            <?php

            // Getting user orders
            $getOrder = mysqli_query($conn, "SELECT * FROM e_order order by o_id desc");

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

                    <a class="pr-link" href="order_detail.php?ordid=<?php echo $my_order_id ?>">
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
        <!-- order listing ends here -->

    </main>
    <script src="admin.js"></script>
    <footer>

    </footer>
</body>

</html>