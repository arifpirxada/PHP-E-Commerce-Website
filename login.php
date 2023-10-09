<?php
include "partials/dbconn.php";
include "partials/chk_user_log.php";
include "partials/add_to_cart_func.php";

if(!$notLogedIn) {
    header("location: index.php");
}

// Php for user login 
$noUser = false;
$wrPass = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = safe_value($conn, $_POST['userLogEmail']);
    $pass = safe_value($conn, $_POST['userLogPassword']);

    $result = mysqli_query($conn, "SELECT * FROM e_users WHERE u_email = '$email'");
    if (!$result) {
        echo "selection was unsuccessful!" . mysqli_connect_error();
    }
    $num = mysqli_num_rows($result);
    if ($num == 0) {
        global $noUser;
        $noUser = true;
    } else {

        $row = mysqli_fetch_assoc($result);
        if ($pass != $row['u_password']) {
            $wrPass = true;
        } else {
            $_SESSION['userLog'] = true;
            $_SESSION['user'] = $email;
            header("location: index.php");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>
</head>
<link rel="stylesheet" href="admin/admin.css">
<link rel="stylesheet" href="css/style.css">

<body>

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
                    <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt=""><div class="cart-no d-flex"><?php echo total_products() ?></div>
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
                <li><a class="prItems home-prItem" id="order" style="background-color: rgba(0, 0, 0, 0.356) !important;" href="login.php">Login</a></li>
            <?php } ?>
            <li><a class="prItems d-flex home-prItem" id="users" href="cart.php">
                    <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt=""><div class="cart-no d-flex"><?php echo total_products() ?></div>
                </a></li>
        </ul>
    </div>


    <div class="container body-clr">
        <form class="adminLog" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <h2 class="adminLogHead">Login</h2>
            <label class="topLabel" for="userEmail">Email</label>
            <input required id="userEmail" name="userLogEmail" type="email" placeholder="Email">
            <?php global $noUser;
            if ($noUser) { ?>
                <p class="notify">no user found</p>
            <?php } ?>

            <label for="userPassword">Password</label>
            <input required id="userPassword" name="userLogPassword" type="password" placeholder="password">
            <?php global $wrPass;
            if ($wrPass) { ?>
                <p class="notify">wrong password</p>
            <?php } ?>

            <button class="btn submit-btn btn-blue" type="submit">Login</button>
            <div class="switchLog d-flex">
                <p>no account?</p>&nbsp;<a href="signup.php">signup</a>
            </div>
        </form>
    </div>


    <script src="js/main.js"></script>
    <script src="admin/admin.js"></script>

</body>

</html>