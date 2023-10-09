<?php
include "../../partials/dbconn.php";

if (!isset($_SESSION['ad_login']) || $_SESSION['ad_login'] != true) {
    header("location: ../adminLog.php");
}

$updatefail = false;
$success = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $name = safe_value($conn, $_POST['prUpdateName']);
    $price = safe_value($conn, $_POST['prUpdatePrice']);
    $qty = safe_value($conn, $_POST['prUpdateQty']);
    $shortDesc = safe_value($conn, $_POST['prUpdateShortDesc']);
    $mainDesc = safe_value($conn, $_POST['prUpdateMainDesc']);
    $metaDesc = safe_value($conn, $_POST['prUpdateMetaDesc']);

    $product_id = $_GET['pr_id'];

    $sql = "UPDATE `e_product` SET `pr_name` = '$name', `pr_price` = '$price', `pr_qty` = '$qty', `pr_short_desc` = '$shortDesc', `pr_description` = '$mainDesc', `pr_meta_desc` = '$metaDesc' WHERE `e_product`.`id` = $product_id";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        $updatefail = true;
    } else {
        global $success;
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add category</title>
    <link rel="stylesheet" href="../admin.css">

</head>

<body class="body-clr">

    <div class="box">
        <img hidden id="hamburger" onclick="come()" src="../../img/Hamburger.png" alt="">
        <ul class="nav">
            <li><img id="cross" onclick="go()" src="../../img/Cross.png" alt=""></li>
            <li><a class="prItems" id="categories" href="../categories.php">Categories</a></li>
            <li><a class="prItems" style="background-color: #FFC300" id="products" href="../selectCat.php">Products</a>
            </li>
            <li><a class="prItems" id="order" href="../Order.php">Orders</a></li>
            <li><a class="prItems" id="users" href="../users.php">Users</a></li>
            <li><a class="prItems" id="adminContact" href="../adminContact.php">Contact</a></li>
            <li><a class="prItems" id="adminLogout" href="../ad_logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="container body-clr no-align">
        <form class="adminLog" style="margin-top: 3%" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <h2 class="adminLogHead">Edit Product</h2>

            <?php global $success;
            // check for updation success 
            if ($success) { ?>
                <p class="notify notify-photo">Product updated!</p>
                <a href="../selectCat.php" class="t-center">go back</a>
            <?php } ?>

            <?php
            // for getting the values of product 
            if (isset($_GET['pr_id'])) {
                $prId = $_GET['pr_id'];
                $getProduct = mysqli_query($conn, "SELECT * FROM e_product WHERE id = $prId");
                if (!$getProduct) {
                    echo "there was a problem while selection";
                } else {
                    $row = mysqli_fetch_assoc($getProduct);
            ?>

                    <label for="prUpdateName">Name</label>
                    <input id="prUpdateName" name="prUpdateName" type="text" value="<?php echo $row['pr_name'] ?>">
                    <label for="prUpdatePrice">Price</label>
                    <input id="prUpdatePrice" name="prUpdatePrice" type="number" value="<?php echo $row['pr_price'] ?>">
                    <label for="prUpdateQty">Quantity</label>
                    <input id="prUpdateQty" name="prUpdateQty" type="number" value="<?php echo $row['pr_qty'] ?>">
                    <label for="prUpdateShortDesc">Short Description</label>
                    <textarea id="prUpdateShortDesc" name="prUpdateShortDesc"><?php echo $row['pr_short_desc'] ?></textarea>
                    <label for="prUpdateMainDesc">Main Description</label>
                    <textarea id="prUpdateMainDesc" name="prUpdateMainDesc"><?php echo $row['pr_description'] ?></textarea>
                    <label for="prUpdateMetaDesc">Meta Description</label>
                    <textarea style="margin-bottom: 18px;" id="prUpdateMetaDesc" name="prUpdateMetaDesc"><?php echo $row['pr_meta_desc'] ?></textarea>


                    <!-- Submit button here  -->

                    <button class="btn addBtn" type="submit">Update</button>

            <?php
                }
            } ?>
        </form>
    </div>

    <script src="../admin.js"></script>


</body>

</html>