<?php
include "partials/dbconn.php";
include "partials/chk_user_log.php";
include "partials/add_to_cart_func.php";

if(!$notLogedIn) {
    header("location: index.php");
}

$userExists = false;
$addUserFail = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $userName = safe_value($conn, $_POST['userName']);
    $userEmail = safe_value($conn, $_POST['userSignEmail']);
    $userPass = safe_value($conn, $_POST['userSignPassword']);
    $userPhone = safe_value($conn, $_POST['userSignPhone']);

    $exists = mysqli_query($conn, "SELECT * FROM e_users WHERE u_email = '$userEmail'");
    $num = mysqli_num_rows($exists);

    if ($num > 0) {
        global $userExists;
        $userExists = true;
    } else {

        $sql = "INSERT INTO e_users (u_name, u_email, u_password, u_phone) VALUES ('$userName','$userEmail','$userPass','$userPhone' )";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            global $addUserFail;
            $addUserFail = true;
        } else {
            $_SESSION['userLog'] = true;
            $_SESSION['user'] = $userName;


            header("location: handles/user_email_verify.php");
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
                <li><a class="prItems home-prItem" style="background-color: rgba(0, 0, 0, 0.356) !important;" id="order" href="login.php">Login</a></li>
            <?php } ?>
            <li><a class="prItems d-flex home-prItem" id="users" href="cart.php">
                    <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt=""><div class="cart-no d-flex"><?php echo total_products() ?></div>
                </a></li>
        </ul>
    </div>


    <div class="container body-clr">
        <form class="adminLog" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <h2 class="adminLogHead">Signup</h2>
            <label class="topLabel" for="userName">Name</label>
            <input required id="userName" name="userName" type="text" placeholder="Enter your name">

            <label for="userSignEmail">Email</label>
            <input required id="userSignEmail" name="userSignEmail" type="email" placeholder="Email">
            <!-- <p class="showMessage">No user found</p> -->

            <label for="userSignPassword">Password</label>
            <input required id="userSignPassword" name="userSignPassword" type="password" placeholder="password">

            <label for="signPhone">Phone No.</label>
            <input required id="signPhone" name="userSignPhone" type="number" placeholder="Number">
            <?php global $userExists;
            if ($userExists) { ?>
                <p class="notify notify-photo">user already exists!</p>
            <?php }
            global $addUserFail;
            if ($addUserFail) { ?>
                <p class="notify notify-photo">technical issue, please try later</p>
            <?php } ?>

            <button class="btn submit-btn btn-blue" type="submit" id="userSignSubmit">Signup</button>
            <div class="switchLog d-flex">
                <p>already a member?</p>&nbsp;<a href="login.php">login</a>
            </div>
        </form>
    </div>

    <script src="js/main.js"></script>
    <script src="admin/admin.js"></script>

</body>

</html>