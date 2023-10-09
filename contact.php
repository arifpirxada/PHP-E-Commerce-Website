<?php include "partials/dbconn.php";
include "partials/chk_user_log.php";
include "partials/add_to_cart_func.php";


if ($notLogedIn) {
    header("location: login.php");
}

// To send message to the admin 

$success = false;
$sendFail = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $userName = safe_value($conn, $_POST['contactName']);
    $userMessage = safe_value($conn, $_POST['contactMessage']);
    $userEmail = $_SESSION['user'];

    $sql = mysqli_query($conn, "SELECT u_phone FROM e_users WHERE u_email = '$userEmail'");
    if (!$sql) {
        global $sendFail;
        $sendFail = true;
    } else {
        $phone = mysqli_fetch_assoc($sql);
        $userPhone = $phone['u_phone'];

        $sql = "INSERT INTO e_contacts (c_name, c_email, c_phone, c_message) VALUES ('$userName','$userEmail','$userPhone' ,'$userMessage')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            global $sendFail;
            $sendFail = true;
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
    <title>Contact Us</title>
</head>
<link rel="stylesheet" href="admin/admin.css">
<link rel="stylesheet" href="css/style.css">

<body class="body-clr">

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
            <li><a class="prItems home-prItem" style="background-color: rgba(0, 0, 0, 0.356) !important;" id="products" href="contact.php">Contact</a></li>
            <?php if ($notLogedIn) { ?>
                <li><a class="prItems home-prItem" id="order" href="login.php">Login</a></li>
            <?php } ?>
            <li><a class="prItems d-flex home-prItem" id="users" href="cart.php">
                    <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt=""><div class="cart-no d-flex"><?php echo total_products() ?></div>
                </a></li>
        </ul>
    </div>

    <!-- navbar end -->

    <div class="container contactContain body-clr">
        <form class="adminLog" action="contact.php" method="post">
            <h2 class="adminLogHead">Contact Us</h2>
            <label class="topLabel" for="contactName">Name</label>
            <input required type="text" id="contactName" name="contactName" placeholder="Email">
            <label for="contactMessage">Comment</label>
            <textarea required name="contactMessage" id="contactMessage" placeholder="Enter a message"></textarea>
            <?php global $sendFail;
            if ($sendFail) { ?>
                <p class="notify">Sorry,some technical issue!</p>
            <?php } ?>
            <button class="btn submit-btn" type="submit" id="messageBtn">Send Message</button>
        </form>
    </div>

    <script src="js/main.js"></script>
    <script src="admin/admin.js"></script>

</body>

</html>