<?php
include "../partials/dbconn.php";
include "../partials/chk_user_log.php";
include "../partials/add_to_cart_func.php";

if ($notLogedIn) {
    header("location: ../login.php");
}


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $userEmail = safe_value($conn, $_POST['userEmailOtp']);
   
}




// Api code ends here 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>
</head>
<link rel="stylesheet" href="../admin/admin.css">
<link rel="stylesheet" href="../css/style.css">

<body>

    <!-- main navbar  -->
    <div class="navbarContain nav-color">
        <a class="d-flex no-underline" href="../index.php"><img src="../img/logo.png" class="siteLogo" alt="">&nbsp;<p class="siteName">Trendzy</p></a>
        <ul>
            <li><a class="no-underline" href="../index.php">Home</a></li>
            <li><a class="no-underline" href="../contact.php">Contact</a></li>
        </ul>

        <ul>
            <?php if ($notLogedIn) { ?>
                <li><a class="no-underline" href="../login.php">Login</a></li>
            <?php } ?>
            <li><a class="d-flex no-underline" href="../cart.php">
                    <p>Cart</p>&nbsp;<img src="../img/cart.png" width="30px" alt="">
                    <div class="cart-no d-flex"><?php echo total_products() ?></div>
                </a></li>
        </ul>
    </div>

    <!-- mobile navbar  -->
    <div class="box">

        <img id="hamburger" onclick="come()" src="../img/Hamburger.png" alt="">
        <ul class="nav home-nav">
            <li><img id="cross" onclick="go()" src="../img/Cross.png" alt=""></li>
            <li><a class="d-flex no-underline siteLogo-Mobile" href="index.php"><img src="../img/logo.png" class="siteLogo" alt="">&nbsp;<p class="siteName">Trendzy</p></a></li>
            <li><a class="prItems home-prItem" id="categories" href="index.php">Home</a></li>
            <li><a class="prItems home-prItem" id="products" href="contact.php">Contact</a></li>
            <?php if ($notLogedIn) { ?>
                <li><a class="prItems home-prItem" style="background-color: rgba(0, 0, 0, 0.356) !important;" id="order" href="login.php">Login</a></li>
            <?php } ?>
            <li><a class="prItems d-flex home-prItem" id="users" href="cart.php">
                    <p>Cart</p>&nbsp;<img src="../img/cart.png" width="30px" alt="">
                    <div class="cart-no d-flex"><?php echo total_products() ?></div>
                </a></li>
        </ul>
    </div>


    <div class="container body-clr">
        <form class="adminLog" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <h2 class="adminLogHead">Verify Phone Number</h2>
            <p style="padding: 2% 10%;color: #878474;">We have sent an otp to your phone no.</p>
            <input required id="userEmailOtp" name="userEmailOtp" type="number" placeholder="Enter otp">

            <button class="btn submit-btn btn-blue" type="subPhoneOtp">Verify</button>
        </form>
    </div>

    <script src="../js/main.js"></script>
    <script src="../admin/admin.js"></script>

</body>

</html>