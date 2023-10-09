<?php
include "../../partials/dbconn.php";

if (!isset($_SESSION['ad_login']) || $_SESSION['ad_login'] != true) {
    header("location: ../adminLog.php");
}

$pError = false;
$success = false;
$notUploaded = false;
$insertFail = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // First image here 
    $photo = $_FILES['prFirstImg'];

    $photoName = $photo['name'];
    $photoTmp = $photo['tmp_name'];
    $photoError = $photo['error'];

    $photoEx = explode(".", $photoName);
    $photoExt = strtolower(end($photoEx));


    if ($photoError == 0) {

        $firstImgName = uniqid('', true) . "." . $photoExt;
        $fpath = '../../img/productImages/' . $firstImgName;

        if (move_uploaded_file($photoTmp, $fpath)) {
            // Second image here 


            $photo = $_FILES['prSecondImg'];

            $photoName = $photo['name'];
            $photoTmp = $photo['tmp_name'];
            $photoError = $photo['error'];

            $photoEx = explode(".", $photoName);
            $photoExt = strtolower(end($photoEx));


            if ($photoError == 0) {

                $secondImgName = uniqid('', true) . "." . $photoExt;
                $fpath = '../../img/productImages/' . $secondImgName;

                if (move_uploaded_file($photoTmp, $fpath)) {
                    // Third image here 



                    $photo = $_FILES['prThirdImg'];

                    $photoName = $photo['name'];
                    $photoTmp = $photo['tmp_name'];
                    $photoError = $photo['error'];

                    $photoEx = explode(".", $photoName);
                    $photoExt = strtolower(end($photoEx));


                    if ($photoError == 0) {

                        $thirdImgName = uniqid('', true) . "." . $photoExt;
                        $fpath = '../../img/productImages/' . $thirdImgName;

                        if (move_uploaded_file($photoTmp, $fpath)) {
                            // Fourth image here 




                            $photo = $_FILES['prFourthImg'];

                            $photoName = $photo['name'];
                            $photoTmp = $photo['tmp_name'];
                            $photoError = $photo['error'];

                            $photoEx = explode(".", $photoName);
                            $photoExt = strtolower(end($photoEx));


                            if ($photoError == 0) {

                                $fourthImgName = uniqid('', true) . "." . $photoExt;
                                $fpath = '../../img/productImages/' . $fourthImgName;

                                if (move_uploaded_file($photoTmp, $fpath)) {
                                    // Fifth image here 




                                    $photo = $_FILES['prFifthImg'];

                                    $photoName = $photo['name'];
                                    $photoTmp = $photo['tmp_name'];
                                    $photoError = $photo['error'];

                                    $photoEx = explode(".", $photoName);
                                    $photoExt = strtolower(end($photoEx));


                                    if ($photoError == 0) {

                                        $fifthImgName = uniqid('', true) . "." . $photoExt;
                                        $fpath = '../../img/productImages/' . $fifthImgName;

                                        if (move_uploaded_file($photoTmp, $fpath)) {
                                            // Product insertion here right here
                                            $productName = safe_value($conn, $_POST['prName']);
                                            $productPrice = safe_value($conn, $_POST['prPrice']);
                                            $productQty = safe_value($conn, $_POST['prQty']);
                                            $productShortDesc = safe_value($conn, $_POST['prShortDesc']);
                                            $productMainDesc = safe_value($conn, $_POST['prMainDesc']);
                                            $productMetaDesc = safe_value($conn, $_POST['prMetaDesc']);

                                            $category_id = safe_value($conn, $_GET['pr_caid']);
                                            // image names 

                                            global $firstImgName;
                                            global $secondImgName;
                                            global $thirdImgName;
                                            global $fourthImgName;
                                            global $fifthImgName;

                                            $sql = "INSERT INTO `e_product` (`category_id`, `pr_name`, `pr_price`, `pr_qty`, `pr_short_desc`, `pr_description`, `pr_fimage`, `pr_simage`, `pr_timage`, `pr_fourthImage`, `pr_fifthImage`, `pr_meta_desc`) VALUES ('$category_id', '$productName', '$productPrice', '$productQty', '$productShortDesc', '$productMainDesc', '$firstImgName', '$secondImgName', '$thirdImgName', '$fourthImgName', '$fifthImgName', '$productMetaDesc')";
                                            $insert = mysqli_query($conn, $sql);

                                            if (!$insert) {
                                                global $insertFail;
                                                $insertFail = true;
                                            } else {
                                                global $success;
                                                $success = true;
                                            }
                                        } else {
                                            global $notUploaded;
                                            $notUploaded = true;
                                        }
                                    } else {
                                        global $pError;
                                        $pError = true;
                                    }

                                    // Fifth image end 


                                } else {
                                    global $notUploaded;
                                    $notUploaded = true;
                                }
                            } else {
                                global $pError;
                                $pError = true;
                            }

                            // fourth image end 



                        } else {
                            global $notUploaded;
                            $notUploaded = true;
                        }
                    } else {
                        global $pError;
                        $pError = true;
                    }

                    // third image end 



                } else {
                    global $notUploaded;
                    $notUploaded = true;
                }
            } else {
                global $pError;
                $pError = true;
            }

            // second image end 
        } else {
            global $notUploaded;
            $notUploaded = true;
        }
    } else {
        global $pError;
        $pError = true;
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
            <h2 class="adminLogHead">Add Product</h2>
            <?php global $success;
            if ($success) { ?>
                <p class="notify notify-photo">Product has been added!</p>
                <a href="../products.php?caid=<?php echo $_GET['pr_caid'] ?>" class="t-center">go back</a>
            <?php } ?>

            <label for="prName">Name</label>
            <input required id="prName" name="prName" type="text" placeholder="Product Name">
            <label for="prPrice">Price</label>
            <input required id="prPrice" name="prPrice" type="number" placeholder="Product Price">
            <label for="prQty">Quantity</label>
            <input required id="prQty" name="prQty" type="number" placeholder="Product Quantity">
            <label for="prShortDesc">Short Description</label>
            <textarea required id="prShortDesc" name="prShortDesc" placeholder="write short description"></textarea>
            <label for="prMainDesc">Main Description</label>
            <textarea required id="prMainDesc" name="prMainDesc" placeholder="write long description"></textarea>
            <label for="prMetaDesc">Meta Description</label>
            <textarea required id="prMetaDesc" name="prMetaDesc" placeholder="Meta Desc"></textarea>

            <div class="slPhotoContain center-Items f-column">
                <label for="prFirstImg" class="center-Items">First Picture</label>
                <input required type="file" name="prFirstImg" id="prFirstImg" class="prImages" accept="image/jpg, image/jpeg, image/png" onchange="checkSelection(this)">
                <img style="bottom: 30px;" src="../../img/greenTick.png" class="photo-select" alt="">
            </div>


            <div class="slPhotoContain center-Items f-column">
                <label for="prSecondImg" class="center-Items">Second Picture</label>
                <input required type="file" name="prSecondImg" id="prSecondImg" class="prImages" accept="image/jpg, image/jpeg, image/png" onchange="checkSelection(this)">
                <img style="bottom: 30px;" src="../../img/greenTick.png" class="photo-select" alt="">
            </div>


            <div class="slPhotoContain center-Items f-column">
                <label for="prThirdImg" class="center-Items">FirstThird Picture</label>
                <input required type="file" name="prThirdImg" id="prThirdImg" class="prImages" accept="image/jpg, image/jpeg, image/png" onchange="checkSelection(this)">
                <img style="bottom: 30px;" src="../../img/greenTick.png" class="photo-select" alt="">
            </div>


            <div class="slPhotoContain center-Items f-column">
                <label for="prFourthImg" class="center-Items">Fourth Picture</label>
                <input required type="file" name="prFourthImg" id="prFourthImg" class="prImages" accept="image/jpg, image/jpeg, image/png" onchange="checkSelection(this)">
                <img style="bottom: 30px;" src="../../img/greenTick.png" class="photo-select" alt="">
            </div>


            <div class="slPhotoContain center-Items f-column">
                <label for="prFifthImg" class="center-Items">Fifth Picture</label>
                <input required type="file" name="prFifthImg" id="prFifthImg" class="prImages" accept="image/jpg, image/jpeg, image/png" onchange="checkSelection(this)">
                <img style="bottom: 30px;" src="../../img/greenTick.png" class="photo-select" alt="">
            </div>

            <?php global $pError;
            if ($pError) { ?>
                <p class="notify notify-photo">error, try later</p>
            <?php }
            global $notUploaded;
            if ($notUploaded) { ?>
                <p class="notify notify-photo">transfer failed, try later</p>
            <?php } ?>

            <!-- Submit button here  -->

            <button class="btn addBtn" type="submit" id="adminSubmit">Add</button>

            <?php global $insertFail;
            if ($insertFail) { ?>
                <p class="notify notify-photo">some insertion issue occured</p>
            <?php }?> 
            
        </form>
    </div>

    <script src="../admin.js"></script>


</body>

</html>