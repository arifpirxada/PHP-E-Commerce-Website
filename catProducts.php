<?php
include "partials/dbconn.php";
include "partials/chk_user_log.php";
include "partials/add_to_cart_func.php";
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
                <?php if ($notLogedIn) { ?>
                    <li><a class="no-underline" href="login.php">Login</a></li>
                <?php } ?>
                <li><a class="d-flex no-underline" href="cart.php">
                        <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt=""><div class="cart-no d-flex"><?php echo total_products() ?></div>
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
                <li><a class="prItems d-flex home-prItem" id="users" href="cart.php">
                        <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt=""><div class="cart-no d-flex"><?php echo total_products() ?></div>
                    </a></li>
            </ul>
        </div>

        <div class="nav-space pro-space"></div>

    </header>
    <main>



        <!-- Nav end  -->

        <!-- Products  -->

        <div class="mainCategories d-flex">

            <?php
            // Get sub categories
            if (isset($_GET['kaid'])) {

                $catId = $_GET['kaid'];
                $getProducts = mysqli_query($conn, "SELECT * FROM e_product WHERE category_id = '$catId' order by id desc");

                $numRows = mysqli_num_rows($getProducts);
                if ($numRows == 0) {
                    echo "No products available right now";
                } else {

                    if (!$getProducts) {
                        echo "technical issue while fetching main categories";
                    } else {
                        while ($row = mysqli_fetch_assoc($getProducts)) {
            ?>
                            <a href="actPro.php?pride=<?php echo $row['id'] ?>" hidden>
                                <div class="mainCat d-flex">
                                    <img class="cartImg" src="img/productImages/<?php echo $row['pr_fimage'] ?>" alt="">
                                    <p class="mainCatType"><?php echo $row['pr_name'] ?></p>
                                    <p class="mainCatDesc shortDesc"><?php echo $row['pr_short_desc'] ?></p>
                                    <p class="mainCatPrice">Price: ₹<?php echo $row['pr_price'] ?></p>
                                </div>
                            </a>

            <?php }
                    }
                }
            } else {
                echo "No category selected";
            } ?>

        </div>

        <div style="margin-top: -1%;" class="mainCategories d-flex">
            <button hidden class="btn btn-showMore Less btn-crimson" onclick="showLess()">Show Less</button>
            <button class="btn btn-showMore More" onclick="showMore()">Show more</button>
        </div>
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