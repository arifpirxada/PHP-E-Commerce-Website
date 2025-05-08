<?php
include "../partials/dbconn.php";
include "chk.php";

$onlyType = false;
$pError = false;
$bigSize = false;
$success = false;
$catExists = false;
$noImg = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (isset($_FILES['subCatImg']) && $_FILES['subCatImg']['error'] === UPLOAD_ERR_OK) {

        $photo = $_FILES['subCatImg'];

        $photoName = $photo['name'];
        $photoTmp = $photo['tmp_name'];
        $photoSize = $photo['size'];
        $photoError = $photo['error'];
        $photoType = $photo['type'];

        $photoEx = explode(".", $photoName);
        $photoExt = strtolower(end($photoEx));

        $only = array('jpg', 'jpeg', 'png');

        if (in_array($photoExt, $only)) {
            if ($photoError == 0) {
                if ($photoSize < 5242880) {
                    $catName = safe_value($conn, $_POST['subCatName']);
                    $startPrice = safe_value($conn, $_POST['subCatStartPrice']);

                    $fileNam = stripslashes($_POST['subCatName']);
                    $fileNam = str_replace('"', '', $fileNam);
                    $fileNam = str_replace("'", '', $fileNam);
                    $factname = $fileNam . "." . $photoExt;
                    $fpath = '../img/subCatImages/' . $factname;

                    if (move_uploaded_file($photoTmp, $fpath)) {
                        $exists = mysqli_query($conn, "SELECT * FROM sub_categories WHERE s_name = '$catName'");
                        $num = mysqli_num_rows($exists);

                        if ($num > 0) {
                            global $catExists;
                            $catExists = true;
                        } else {

                            $sql = "INSERT INTO sub_categories (s_name, s_img, s_start_price, s_status) VALUES ('$catName','$factname','$startPrice',1)";
                            $result = mysqli_query($conn, $sql);
                            if (!$result) {
                                $insertfail = "Sorry category insertion failed!";
                            }

                            global $success;
                            $success = true;
                        }
                    } else {
                        echo("failed to upload photo");
                    }
                } else {
                    global $bigSize;
                    $bigSize = true;
                }
            } else {
                global $pError;
                $pError = true;
            }
        } else {
            global $onlyType;
            $onlyType = true;
        }
    }
    else {
        global $noImg;
        $noImg = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add sub category</title>
    <link rel="stylesheet" href="admin.css">

</head>

<body class="body-clr">
    <div class="box">
        <img hidden id="hamburger" onclick="come()" src="../img/Hamburger.png" alt="">
        <a class="btn subCats" id="subCategories" href="subCategories.php">Sub Categories</a>
        <ul class="nav">
            <li><img id="cross" onclick="go()" src="../img/Cross.png" alt=""></li>
            <li><a class="prItems" style="background-color: #FFC300 !important;" href="index.php">Categories</a></li>
            <li><a class="prItems" id="products" href="selectCat.php">Products</a></li>
            <li><a class="prItems" id="order" href="Order.php">Orders</a></li>
            <li><a class="prItems" id="users" href="users.php">Users</a></li>
            <li><a class="prItems" href="adminContact.php">Contact</a></li>
            <li><a class="prItems"href="ad_logout.php">Logout</a></li>
        </ul>
    </div>
 
    <div class="container body-clr">
        <form class="adminLog" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <h2 class="adminLogHead">Sub Category</h2>
            <label id="subCatName" for="subCatName">Name</label>
            <input required id="subCatName" name="subCatName" type="text" placeholder="Category Name">
            <label id="subCatStartPrice" for="subCatStartPrice">Starting Price</label>
            <input required id="subCatStartPrice" name="subCatStartPrice" type="number" placeholder="set starting price">

            <div class="slPhotoContain center-Items">
                <input hidden type="file" name="subCatImg" id="subCatImg" class="catImg" onchange="checkSelection(this)">
                <label for="subCatImg" class="btn center-Items btn-photo">Choose a Photo</label>
                <img src="../img/greenTick.png" class="photo-select" alt="">
            </div>

            <?php global $onlyType;
            if ($onlyType) { ?>
                <p class="notify notify-photo">only photo please</p>
            <?php } ?>
            <?php global $noImg;
            if ($noImg) {?>
                <p class="notify notify-photo">image required</p>
            <?php } ?>
            <?php global $pError;
            if ($pError) { ?>
                <p class="notify notify-photo">try later</p>
            <?php } ?>
            <?php global $bigSize;
            if ($bigSize) { ?>
                <p class="notify notify-photo">photo is too big</p>
            <?php } ?>

            <button class="btn addBtn" type="submit" id="adminSubSubmit">Add</button>

            <?php global $catExists;
            if ($catExists) { ?>
                <p class="notify notify-photo">Category already exists!</p>
            <?php } ?>
            <?php global $success;
            if ($success) { ?>
                <p class="notify notify-photo">Category added successfully!</p>
                <a href="subCategories.php" class="t-center">go back</a>
            <?php } ?>

        </form>
    </div>

    <script src="admin.js"></script>

</body>

</html>