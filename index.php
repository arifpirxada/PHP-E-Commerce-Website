<?php
include "partials/dbconn.php";
include "partials/chk_user_log.php";
include "partials/add_to_cart_func.php";

$orders = false;

if (!$notLogedIn) {
    $userEmail = $_SESSION['user'];
    $getNum = mysqli_query($conn, "SELECT * FROM e_order WHERE o_user_email = '$userEmail'");
    $num = mysqli_num_rows($getNum);

    if ($num > 0) {
        global $orders;
        $orders = true;
    }
}
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
        <div class="navbarContain">
            <a class="d-flex no-underline" href="index.php"><img src="img/logo.png" class="siteLogo" alt="">&nbsp;<p class="siteName">Trendzy</p></a>
            <ul>
                <li><a class="no-underline" href="index.php">Home</a></li>
                <li><a class="no-underline" href="contact.php">Contact</a></li>
            </ul>

            <form class="search-form d-flex" action="search.php" method="get">
                <input type="search" class="search" name="search" onfocus="goDark()" onblur="noDark()" placeholder="search">&nbsp;&nbsp;
                <button type="submit" class="s-btn" id="search-Btn"><img src="img/searchIcon.png" width="40px" alt=""></button>
            </form>

            <ul>
                <?php
                if ($notLogedIn) { ?>
                    <li><a class="no-underline" href="login.php">Login</a></li>
                <?php } else { ?>
                    <li><a class="no-underline" href="userLogout.php">Logout</a></li>
                <?php } ?>

                <?php global $orders;
                if ($orders) { ?>
                    <li><a class="no-underline" href="my_orders.php">Orders</a></li>
                <?php } ?>

                <li><a class="d-flex no-underline" href="cart.php">
                        <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt="">
                        <div class="cart-no d-flex"><?php echo total_products() ?></div>
                    </a></li>

            </ul>
        </div>

        <!-- mobile nav  -->

        <div class="searchContain">
            <form class="search-form d-flex" action="search.php" method="get">

                <input type="search" class="search mobile-search" name="search" onfocus="goDark()" onblur="noDark()" placeholder="search">&nbsp;&nbsp;
                <button type="submit" class="s-btn" id="srh-Btn"><img src="img/searchIcon.png" class="srhIcon" width="40px" alt=""></button>
            </form>
        </div>

        <!-- start -->

        <div class="box">
            <img id="hamburger" onclick="come()" src="img/Hamburger.png" alt="">

            <ul class="nav home-nav">
                <li><img id="cross" onclick="go()" src="img/Cross.png" alt=""></li>
                <li><a class="d-flex no-underline siteLogo-Mobile" href="index.php"><img src="img/logo.png" class="siteLogo" alt="">&nbsp;<p class="siteName">Trendzy</p></a></li>
                <li><a class="prItems home-prItem" style="background-color: rgba(0, 0, 0, 0.356);" id="categories" href="index.php">Home</a></li>
                <li><a class="prItems home-prItem" id="products" href="contact.php">Contact</a></li>
                <?php if ($notLogedIn) { ?>
                    <li><a class="prItems home-prItem" id="order" href="login.php">Login</a></li>
                <?php } ?>

                <?php global $orders;
                if ($orders) { ?>
                    <li><a class="prItems home-prItem" id="order" href="my_orders.php">Orders</a></li>
                <?php } ?>

                <li><a class="prItems d-flex home-prItem" id="users" href="cart.php">
                        <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt="">
                        <div class="cart-no d-flex"><?php echo total_products() ?></div>
                    </a></li>

                <?php if ($notLogedIn == false) { ?>
                    <li><a class="prItems home-prItem" href="userLogout.php">Logout</a></li>
                <?php } ?>

            </ul>
        </div>

        <div class="nav-space"></div>


        <!-- Nav end  -->

        <div class="fader">
            <img src="img/slider/slide2.jpg" class="slImg" style="width: 100vw;" alt="">
            <img src="img/slider/slide1.jpg" class="slImg" style="width: 100vw;" alt="">
            <img src="img/slider/slide3.jpg" class="slImg" style="width: 100vw;" alt="">
            <img src="img/slider/slide4.jpg" class="slImg" style="width: 100vw;" alt="">
            <img src="img/slider/slide5.jpg" class="slImg" style="width: 100vw;" alt="">
        </div>

    </header>


    <!-- Main categories Here  -->

    <main>


        <div class="mainCategories d-flex">

            <?php
            // Get main categories
            $getMainCat = mysqli_query($conn, "SELECT * FROM main_categories WHERE m_status = '1'");
            if (!$getMainCat) {
                echo "technical issue while fetching main categories";
            } else {
                while ($row = mysqli_fetch_assoc($getMainCat)) {
            ?>
                    <a href="catProducts.php?kaid=<?php echo $row['m_id'] ?>">
                        <div class="mainCat d-flex">
                            <img class="cartImg" src="img/mainCatImages/<?php echo $row['m_img'] ?>" alt="">
                            <p class="mainCatType"><?php echo $row['m_name'] ?></p>
                            <p class="mainCatPrice">Starting: ₹<?php echo $row['m_start_price'] ?></p>
                        </div>
                    </a>

            <?php }
            } ?>


        </div>

        <!-- Sub categories Here  -->

        <div class="mainCategories d-flex">

            <?php
            // Get sub categories
            $getSubCat = mysqli_query($conn, "SELECT * FROM sub_categories WHERE s_status = '1'");
            if (!$getSubCat) {
                echo "technical issue while fetching main categories";
            } else {
                while ($row = mysqli_fetch_assoc($getSubCat)) {
            ?>
                    <a href="catProducts.php?kaid=<?php echo $row['s_id'] ?>">
                        <div class="mainCat d-flex">
                            <img class="cartImg" src="img/subCatImages/<?php echo $row['s_img'] ?>" alt="">
                            <p class="mainCatType"><?php echo $row['s_name'] ?></p>
                            <p class="mainCatPrice">Starting: ₹<?php echo $row['s_start_price'] ?></p>
                        </div>
                    </a>

            <?php }
            } ?>


        </div>
    </main>


    <!-- footer here  -->
    <footer>

        <div class="mainCategories d-flex aboutus">
            <p>
            <b>Welcome to Trendzy</b>, your ultimate online shopping destination! At Trendzy, we're on a mission to redefine the way you shop, offering an unparalleled e-commerce experience that combines convenience, variety, and top-notch customer service.<br><br>


            <b>Trendzy was born out of a simple yet profound idea:</b> to make online shopping more accessible, enjoyable, and satisfying for everyone. With a team of passionate individuals who are themselves avid shoppers, we set out to create a platform that would cater to the diverse needs and tastes of our customers.
            Our vision is to be the go-to online marketplace for all your shopping needs. Whether you're searching for the latest fashion trends, cutting-edge electronics, home essentials, or unique gifts, we want to be your one-stop destination for it all. We believe in the power of e-commerce to bring people closer to the products they love, and we're committed to making this experience as seamless as possible.<br><br>

            <b>What Sets Us Apart</b>

            Unrivaled Product Selection: We pride ourselves on offering an extensive and ever-expanding range of products. From clothing and accessories to electronics, home decor, beauty products, and beyond, you'll find everything you need under one virtual roof.

            Quality Assurance: We understand that quality matters, and we go to great lengths to source products from reputable brands and sellers. Our rigorous quality control processes ensure that you receive only the best.

            User-Friendly Interface: Our website is designed with you in mind. We've created an intuitive and easy-to-navigate platform that makes your shopping experience a breeze, from search to checkout.

            Personalized Recommendations: Discover products tailored to your preferences with our intelligent recommendation system. Say goodbye to endless scrolling and hello to curated selections that match your style and interests.

            Secure Shopping: We take your online security seriously. Our website employs the latest encryption technology to safeguard your personal and financial information, giving you peace of mind while you shop.

            Dedicated Customer Support: Our customer support team is here to assist you every step of the way. Whether you have questions about products, orders, or returns, our friendly and knowledgeable staff are ready to help.<br><br>

            
            We invite you to join our growing community of satisfied customers who have experienced the joy of shopping at Trendzy. Sign up for our newsletter to stay updated on the latest trends, promotions, and exclusive offers. Follow us on social media to be part of a vibrant and engaged community of shoppers.

            Thank you for choosing Trendzy as your trusted online shopping partner. We look forward to serving you and helping you find the products that bring joy to your life. Happy shopping!</p>
             </div>

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