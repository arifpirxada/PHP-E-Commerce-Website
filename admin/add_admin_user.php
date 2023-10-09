<?php
include "../partials/dbconn.php";
include "chk.php";
$success = false;
$adminExists = false;
$additionFail = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $adminEmail = safe_value($conn, $_POST['adminEmail']);
    $adminPass = safe_value($conn, $_POST['adminPassword']);

    $exists = mysqli_query($conn, "SELECT * FROM admin_users WHERE ad_email = '$adminEmail'");
    $num = mysqli_num_rows($exists);

    if ($num > 0) {
        global $catExists;
        $catExists = true;
    } else {

        $sql = "INSERT INTO admin_users (ad_email, ad_password) VALUES ('$adminEmail','$adminPass')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $additionFail = true;
        } else {
            global $success;
            $success = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add category</title>
    <link rel="stylesheet" href="admin.css">

</head>

<body class="body-clr">

    <div class="box">
        <img hidden id="hamburger" onclick="come()" src="../img/Hamburger.png" alt="">
        <a class="btn subCats" id="mainCategories" href="index.php">Main Categories</a>
        <ul class="nav">
            <li><img id="cross" onclick="go()" src="../img/Cross.png" alt=""></li>
            <li><a class="prItems" style="background-color: #FFC300 !important;" id="categories" href="index.php">Categories</a></li>
            <li><a class="prItems" id="products" href="selectCat.php">Products</a></li>
            <li><a class="prItems" id="order" href="Order.php">Orders</a></li>
            <li><a class="prItems" id="users" href="users.php">Users</a></li>
            <li><a class="prItems" id="adminContact" href="adminContact.php">Contact</a></li>
            <li><a class="prItems" id="adminLogout" href="ad_logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="container body-clr">
        <form class="adminLog" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <h2 class="adminLogHead">Add Admin User</h2>

            <?php global $success;
            if ($success) { ?>
                <p class="notify notify-photo">Admin added successfully!</p>
                <a href="adminUsers.php" class="t-center">go back</a>
            <?php } ?>

            <label for="adminEmail">Email</label>
            <input required id="adminEmail" name="adminEmail" type="text" placeholder="Email">
            <label for="adminPassword">Password</label>
            <input required style="margin-bottom: 7%;" id="adminPassword" name="adminPassword" type="Password" placeholder="Email">

            <button class="btn addBtn" type="submit">Add</button>

            <?php global $adminExists;
            if ($adminExists) { ?>
                <p class="notify notify-photo">admin already exists!</p>
            <?php } ?>

        </form>
    </div>

    <script src="admin.js"></script>


</body>

</html>