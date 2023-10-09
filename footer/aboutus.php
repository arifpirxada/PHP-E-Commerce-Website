<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendzy</title>
    <link rel="stylesheet" href="../admin/admin.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="body-clr">


    <div hidden class="dark-body"></div>

    <!-- main nav  -->
    <div class="navbarContain">
        <a class="d-flex no-underline" href="../index.php"><img src="img/logo.png" class="siteLogo" alt="">&nbsp;<p
                class="siteName">Trendzy</p></a>
        <ul>
            <li><a class="no-underline" href="../index.php">Home</a></li>
            <li><a class="no-underline" href="../contact.php">Contact</a></li>
        </ul>

        <ul id="right-ul">
            <li><a class="no-underline" href="../login.php">Login</a></li>
            <li><a class="d-flex no-underline" href="../cart.php">
                    <p>Cart</p>&nbsp;<img src="../img/cart.png" width="30px" alt="">
                </a></li>
        </ul>
    </div>

    <!-- mobile nav  -->

    <div class="searchContain">
        <div class="search-form d-flex">
        </div>
    </div>

    <!-- start -->

    <div class="box">

        <img id="hamburger" onclick="come()" src="../img/Hamburger.png" alt="">
        <ul class="nav home-nav">
            <li><img id="cross" onclick="go()" src="../img/Cross.png" alt=""></li>
            <li><a class="d-flex no-underline siteLogo-Mobile" href="../index.php"><img src="img/logo.png"
                        class="siteLogo" alt="">&nbsp;<p class="siteName">Trendzy</p></a></li>
            <li><a class="prItems home-prItem" id="categories" href="../index.php">Home</a></li>
            <li><a class="prItems home-prItem" id="products" href="../contact.php">Contact</a></li>
            <li><a class="prItems home-prItem" id="order" href="../login.php">Login</a></li>
            <li><a class="prItems d-flex home-prItem" id="users" href="../cart.php">
                    <p>Cart</p>&nbsp;<img src="../img/cart.png" width="30px" alt="">
                </a></li>
        </ul>
    </div>

    <div class="nav-space pro-space"></div>


    <!-- Nav end  -->

    <!-- about starts -->


    <script src="../js/main.js"></script>
    <script src="../admin/admin.js"></script>
</body>

</html>