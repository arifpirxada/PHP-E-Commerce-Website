<?php include "partials/dbconn.php";
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
            <a class="d-flex no-underline" href="index.php"><img src="img/logo.png" class="siteLogo" alt="">&nbsp;<p
                    class="siteName">Trendzy</p></a>
            <ul>
                <li><a class="no-underline" href="index.php">Home</a></li>
                <li><a class="no-underline" href="contact.php">Contact</a></li>
            </ul>

            <form class="search-form d-flex" action="search.php" method="get">
                <input type="search" class="search" name="search" onfocus="goDark()" onblur="noDark()"
                    placeholder="search">&nbsp;&nbsp;
                <button type="submit" class="s-btn"><img src="img/searchIcon.png" width="40px" alt=""></button>
            </form>

            <ul>
                <?php if ($notLogedIn) { ?>
                <li><a class="no-underline" href="login.php">Login</a></li>
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
                <input type="search" class="search mobile-search" name="search" onfocus="goDark()" onblur="noDark()"
                    placeholder="search">&nbsp;&nbsp;
                <button type="submit" class="s-btn mb-s-btn"><img src="img/searchIcon.png" class="srhIcon" width="40px"
                        alt=""></button>
            </form>
        </div>

        <!-- start -->

        <div class="box">

            <img id="hamburger" onclick="come()" src="img/Hamburger.png" alt="">
            <ul class="nav home-nav">
                <li><img id="cross" onclick="go()" src="img/Cross.png" alt=""></li>
                <li><a class="d-flex no-underline siteLogo-Mobile" href="index.php"><img src="img/logo.png"
                            class="siteLogo" alt="">&nbsp;<p class="siteName">Trendzy</p></a></li>
                <li><a class="prItems home-prItem" id="categories" href="index.php">Home</a></li>
                <li><a class="prItems home-prItem" id="products" href="contact.php">Contact</a></li>
                <?php if ($notLogedIn) { ?>
                <li><a class="prItems home-prItem" id="order" href="login.php">Login</a></li>
                <?php } ?>
                <li><a class="prItems d-flex home-prItem" id="users" href="cart.php">
                        <p>Cart</p>&nbsp;<img src="img/cart.png" width="30px" alt="">
                        <div class="cart-no d-flex"><?php echo total_products() ?></div>
                    </a></li>
            </ul>
        </div>

        <div class="nav-space pro-space"></div>

    </header>
    <main>



        <!-- Nav end  -->

        <!-- Products  -->

        <div class="mainCategories d-flex productContain">

            <?php
            if (isset($_GET['pride'])) {
                $product_id = $_GET['pride'];
                $getProduct = mysqli_query($conn, "SELECT * FROM e_product WHERE id = '$product_id'");

                if (!$getProduct) {
                    echo "technical issue while fetching the product, please try another time";
                } else {

                    $product = mysqli_fetch_assoc($getProduct);
            ?>

            <div class="productItem">

                <img style="position: relative; opacity: 0;" class="productDetImg" src="img/productImages/<?php echo $product['pr_fimage'] ?>"
                    alt="">
                <img class="productDetImg moveLeft" id="me" src="img/productImages/<?php echo $product['pr_fimage'] ?>"
                    alt="">
                <img hidden class="productDetImg" id="we" src="img/productImages/<?php echo $product['pr_simage'] ?>"
                    alt="">
                <img hidden class="productDetImg" src="img/productImages/<?php echo $product['pr_timage'] ?>" alt="">
                <img hidden class="productDetImg" src="img/productImages/<?php echo $product['pr_fourthImage'] ?>"
                    alt="">
                <img hidden class="productDetImg" src="img/productImages/<?php echo $product['pr_fifthImage'] ?>"
                    alt="">
                <img class="productDetImg whiteImg" src="img/whiteImg.png" alt="">
                <img onclick="slideLeft()" class="Arrow productRightArrow" src="img/righty.png" alt="">

            </div>

            <div class="mainCat productDesc">
                <h3 class="prHead"><?php echo $product['pr_name'] ?></h3>
                <p class="prPrice">Price: ₹<?php echo $product['pr_price'] ?></p>
                <p class="prShortDesc"><?php echo $product['pr_short_desc'] ?></p>
                <?php
                        $stock = "In Stock";
                        if ($product['pr_qty'] == 0) {
                            $stock = "Not available";
                        }
                        ?>
                <p class="prAvailability">Availability:&nbsp;<i class="availStatus"><?php echo $stock ?></i></p>
                <div>

                    <label for="selQty" id="selQtyLabel">Quantity:</label>
                    <select name="selQty" id="selQty">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <?php
                        if ($stock == "In Stock") {
                        ?>
                <div class="prActions d-flex">
                    <?php $pro_id = $_GET['pride'] ?>
                    <button class="btn btn-product btn-cart"
                        onclick="cart_action(<?php echo $pro_id ?>, 'add', this)">Cart</button>
                    <button class="btn btn-product btn-buy" onclick="cart_action(<?php echo $pro_id ?>, 'add', this)">Buy</button>
                </div>
            </div>
            <?php } ?>

        </div>

        <div class="mainCategories d-flex productLongDesc">
            <p><?php echo $product['pr_description'] ?></p>
        </div>



        <!-- To show the related products  -->

        <div class="mainCategories relatedProducts">
            <?php
                    $categoryId = $product['category_id'];
                    $getRelatedProducts = mysqli_query($conn, "SELECT * FROM e_product WHERE category_id = '$categoryId' LIMIT 10");

                    if (!$getRelatedProducts) {
                        echo "technical issue while fetching the product, please try another time";
                    } else {

                      while($relProduct = mysqli_fetch_assoc($getRelatedProducts)) {

            ?>

            <a href="actPro.php?pride=<?php echo $relProduct['id'] ?>">
                <div class="mainCat d-flex">
                    <img class="cartImg" src="img/productImages/<?php echo $relProduct['pr_fimage'] ?>" alt="">
                    <p class="mainCatType"><?php echo $relProduct['pr_name'] ?></p>
                    <p class="mainCatDesc shortDesc"><?php echo $relProduct['pr_short_desc'] ?></p>
                    <p class="mainCatPrice">Starting: ₹<?php echo $relProduct['pr_price'] ?></p>
                </div>
            </a>
            <?php }
             }
                }
            } else {
                echo "No Product Selected";
            }
    ?>
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