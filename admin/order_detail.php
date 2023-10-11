<?php
include "../partials/dbconn.php";
include "chk.php";
include "../partials/add_to_cart_func.php";

if (!isset($_GET['ordid'])) {
    die("No order selected");
}

$update_fail = false;
$update_success = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $order_status = $_POST['sel-status'];
    $order_id = $_GET['ordid'];
    $update_order = mysqli_query($conn, "UPDATE `e_order` SET `o_order_status` = '$order_status' WHERE `e_order`.`o_id` = $order_id");

    if (!$update_order) {
        global $update_fail;
        $update_fail = true;
    } else {
        global $update_success;
        $update_success = true;
    }
}
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
                <li><a class="prItems" id="categories" href="index.php">Categories</a></li>
                <li><a class="prItems" id="products" href="selectCat.php">Products</a></li>
                <li><a class="prItems" id="order" style="background-color: #FFC300;" href="Order.php">Orders</a></li>
                <li><a class="prItems" id="users" href="users.php">Users</a></li>
                <li><a class="prItems" id="adminContact" href="adminContact.php">Contact</a></li>
            </ul>
        </div>

    </header>

    <main>

        <!-- order detail heading  -->


        <div class="mainCategories d-flex aboutus">
            <h2 style="font-weight: 100;">

                <?php
                $total_price = 0;

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
        </div>

        <!-- order detail listing starts here  -->

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
                    if (!$product) {
                        die("Failed to get products!");
                    }
                    $product_img = $product['pr_fimage'];
                    $name = $product['pr_name'];
                    $desc = $product['pr_short_desc'];
            ?>

                    <a class="pr-link" href="actPro.php?pride=<?php echo $product_id ?>">
                        <div class="mainCat mobile-cart">
                            <img src="../img/productImages/<?php echo $product_img ?>" alt="">
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
        <!-- order detail listing ends here -->

        <!-- action portion starts here -->

        <div class="mainCategories d-flex f-column">

            <?php

            // Getting user orders
            $currentId = $_GET['ordid'];
            $getOrder = mysqli_query($conn, "SELECT * FROM e_order WHERE o_id = '$currentId'");

            if (!$getOrder) {
                echo "technical issue while fetching main categories";
            } else {
                $row = mysqli_fetch_assoc($getOrder);
                $my_address = $row['o_proper_address'];
                $my_order_status = $row['o_order_status'];
            }
            ?>

            <p class="f-size"><b>Address:</b>&nbsp;<?php echo $my_address ?></p>
            <p class="f-size" style="margin-top: 12px;"><b>Order Status:</b>&nbsp;<?php echo $my_order_status ?></p>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="d-flex f-column">
                <select name="sel-status" class="f-size" id="sel-status">
                    <option value="default">select order status</option>
                    <option value="pending">pending</option>
                    <option value="processing">processing</option>
                    <option value="shipped">shipped</option>
                    <option value="cancelled">cancelled</option>
                    <option value="complete">complete</option>
                </select>
                <button type="submit" style="margin-top: 8px;" class="btn btn-blue f-size">Change Status</button>
            </form>
            <?php global $update_fail;
            global $update_success;
            if ($update_fail) { ?>
                <p class="notify">technical issue, please try later!</p>
            <?php } else if ($update_success) { ?>
                <p class="notify">order status has been updated successfully</p>
            <?php } ?>
        </div>

    </main>
    <script src="admin.js"></script>
    <script src="../js/main.js"></script>
    <footer>

    </footer>
</body>

</html>