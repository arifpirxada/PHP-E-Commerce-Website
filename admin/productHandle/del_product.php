<?php
include "../../partials/dbconn.php";
if (!isset($_SESSION['ad_login']) || $_SESSION['ad_login'] != true) {
    header("location: ../adminLog.php");
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $input = file_get_contents('php://input');
    $decode = json_decode($input, true);
    $product_id = $decode['product_id'];

    $getImg = mysqli_query($conn, "SELECT * FROM e_product WHERE id = $product_id");
    if (!$getImg) {
        echo "selection was not possible, try later";
    }
    $row = mysqli_fetch_assoc($getImg);
    $firstImg = $row['pr_fimage'];
    $secondImg = $row['pr_simage'];
    $thirdImg = $row['pr_timage'];
    $fourthImg = $row['pr_fourthImage'];
    $fifthImg = $row['pr_fifthImage'];

    // first image delete 
    if (unlink('../../img/productImages/' . $firstImg)) {
        // second image delete 
        global $secondImg;
        if (unlink('../../img/productImages/' . $secondImg)) {

            // third image delete 
            global $thirdImg;
            if (unlink('../../img/productImages/' . $thirdImg)) {

                // fourth image delete 
                global $fourthImg;
                if (unlink('../../img/productImages/' . $fourthImg)) {

                    // fifth  image delete 
                    global $fifthImg;
                    if (unlink('../../img/productImages/' . $fifthImg)) {

                        $deleteProduct = mysqli_query($conn, "DELETE FROM `e_product` WHERE `e_product`.`id` = $product_id");
                        if (!$deleteProduct) {
                            echo "Delete unsuccessful!";
                        } else {
                            echo "delete success";
                        }

                        // fifth image delete end 
                    } else {
                        echo "Img delete unsuccessful!";
                    }

                    // fourth image delete end 
                } else {
                    echo "Img delete unsuccessful!";
                }

                // third image delete end 
            } else {
                echo "Img delete unsuccessful!";
            }

            // second image delete end 
        } else {
            echo "Img delete unsuccessful!";
        }
        // first image delete end 
    } else {
        echo "Img delete unsuccessful!";
    }
}
