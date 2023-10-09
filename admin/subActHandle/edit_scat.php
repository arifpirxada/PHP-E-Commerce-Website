<?php
include "../../partials/dbconn.php";
if(!isset($_SESSION['ad_login']) || $_SESSION['ad_login'] != true ) {
    header("location: ../adminLog.php");
}

$onlyType = false;
$pError = false;
$bigSize = false;
$success = false;
$update = false;
$imgDel = false;
$fileExists = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $setName = safe_value($conn,$_POST['updateSubCatName']);
    $cat_id = $_GET['s_cat'];

    if (isset($_FILES['sub-option-photo']) && $_FILES['sub-option-photo']['error'] === UPLOAD_ERR_OK) {
        // if Img selected 
        $photo = $_FILES['sub-option-photo'];

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
                    global $cat_id;
                    $getImg = mysqli_query($conn, "SELECT * FROM sub_categories WHERE s_id = $cat_id");
                    if (!$getImg) {
                        echo "selection was not possible, try later";
                        die();
                    }
                    global $setName;
                    $factname = $setName . "." . $photoExt;
                    $fpath = '../../img/subCatImages/' . $factname;
                    move_uploaded_file($photoTmp, $fpath);
                    $row = mysqli_fetch_assoc($getImg);
                    $img = $row['s_img'];
                    $updateCat = mysqli_query($conn, "UPDATE `sub_categories` SET `s_name` = '$setName', `s_img` = '$factname' WHERE `sub_categories`.`s_id` = $cat_id");
                    if (!$updateCat) {
                        $update = true;
                    }else {
                        global $success;
                        $success = true;
                    }
                    if (unlink('../../img/subCatImages/' . $img)) {

                    } else {
                        $imgDel = true;
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
    } else {
        // if not selected 

        $getName = mysqli_query($conn, "SELECT * FROM sub_categories");
        while ($getRow = mysqli_fetch_assoc($getName)) {
            $rowName = $getRow['s_name'];
            if ($rowName == $setName) {
                $fileExists = true;
            }
        }
        if (!$fileExists) {
            $updateCat = mysqli_query($conn, "UPDATE `sub_categories` SET `s_name` = '$setName' WHERE `sub_categories`.`s_id` = $cat_id");
            if (!$updateCat) {
                $update = true;
            }
            else {
                global $success;
                $success = true;
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../admin.css">
</head>


<body class="body-clr">





    <div class="box">
        <img hidden id="hamburger" onclick="come()" src="../../img/Hamburger.png" alt="">
        <a class="btn subCats" id="subCategories" href="../subCategories.php">Sub Categories</a>
        <a class="btn subCats addCat" id="addCategories" href="../addcategory.php">Add</a>
        <ul class="nav">
            <li><img id="cross" onclick="go()" src="../../img/Cross.png" alt=""></li>
            <li><a class="prItems" style="background-color: #FFC300 !important;" id="categories" href="../categories.php">Categories</a></li>
            <li><a class="prItems" id="products" href="../products.php">Products</a></li>
            <li><a class="prItems" id="order" href="../Order.php">Orders</a></li>
            <li><a class="prItems" id="users" href="../users.php">Users</a></li>
            <li><a class="prItems" id="adminContact" href="../adminContact.php">Contact</a></li>
            <li><a class="prItems" id="adminLogout" href="../ad_logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Modal for editing categories  -->


    <div class="container body-clr">
        <form class="adminLog modal-form" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">

            <h2 class="adminLogHead">Edit Category</h2>
            <?php
            if (isset($_GET['s_cat'])) {
                $m_catId = $_GET['s_cat'];
                $category = mysqli_query($conn, "SELECT * FROM sub_categories WHERE s_id = $m_catId");
                $cateName = mysqli_fetch_assoc($category);
                $categoryName = $cateName['s_name'];
            }
            ?>
            <label for="updateSubCatName">Name</label>
            <input required id="updateSubCatName" <?php echo "value=$categoryName" ?> name="updateSubCatName" type="text">
            <?php global $fileExists;
            if ($fileExists) { ?>
                <p class="notify notify-photo">file name already exists</p>
            <?php } ?>
            <div class="slPhotoContain center-Items">
                <input hidden type="file" name="sub-option-photo" id="sub-option-photo" onchange="checkSelection(this)">
                <label for="sub-option-photo" class="btn center-Items btn-photo">Choose Photo (option)</label>
                <img src="../../img/greenTick.png" class="photo-select" style="right: 2px;" alt="">
            </div>
            <?php global $onlyType;
            if ($onlyType) { ?>
                <p class="notify notify-photo">only photo please</p>
            <?php } ?>
            <?php global $pError;
            if ($pError) { ?>
                <p class="notify notify-photo">try later</p>
            <?php } ?>
            <?php global $bigSize;
            if ($bigSize) { ?>
                <p class="notify notify-photo">photo is too big</p>
            <?php } ?>
            <button class="btn addBtn" type="submit" id="catUpdate">Update</button>
            <?php global $update;
            if ($update) { ?>
                <p class="notify notify-photo">updation unsuccessfull!</p>
            <?php } ?>
            <?php global $success;
            if ($success) { ?>
                <p class="notify notify-photo">updation successfull!</p>
                <a href="../subCategories.php" class="t-center">go back</a>
            <?php } ?>
        </form>
    </div>



    <script src="../admin.js"></script>

</body>

</html>