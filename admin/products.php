<?php
include "../partials/dbconn.php";
include "chk.php";
?>
<?php include "chk.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage products</title>
    <link rel="stylesheet" href="admin.css">

</head>

<body class="body-clr">

    <div class="box">
        <img hidden id="hamburger" onclick="come()" src="../img/Hamburger.png" alt="">
        <?php
        if (isset($_GET['caid'])) {
        ?>
            <a class="btn subCats center-Items" style="padding: 0% 1%;" href="productHandle/addProduct.php?pr_caid=<?php echo $_GET['caid'] ?>">Add product</a>
        <?php } ?>
        <ul class="nav">
            <li><img id="cross" onclick="go()" src="../img/Cross.png" alt=""></li>
            <li><a class="prItems" id="categories" href="index.php">Categories</a></li>
            <li><a class="prItems" id="products" style="background-color: #FFC300 !important;" href="selectCat.php">Products</a></li>
            <li><a class="prItems" id="order" href="Order.php">Orders</a></li>
            <li><a class="prItems" id="users" href="users.php">Users</a></li>
            <li><a class="prItems" id="adminContact" href="adminContact.php">Contact</a></li>
            <li><a class="prItems" id="adminLogout" href="ad_logout.php">Logout</a></li>
        </ul>
    </div>


    <div class="catHeadContain">
        <div class="catHeading">
            <h2>Products</h2>
        </div>
    </div>

    <div class="mainCatContain">
        <div class="mainCat">
            <table>
                <thead>
                    <th>Sno</th>
                    <th>Categories</th>
                    <th style="text-align: end;">Actions</th>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['caid'])) {

                        $categoryId = $_GET['caid'];
                        $res = mysqli_query($conn, "SELECT * FROM `e_product` WHERE category_id = $categoryId");
                        if (!$res) {
                            echo "selection was unsuccesful!";
                        } else {

                            $sno = 1;
                            while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                                <tr>
                                    <td><?php echo $sno ?></td>
                                    <td><?php echo $row['pr_name'] ?></td>
                                    <td style="text-align: end;"><a class="btn action-btn" href="productHandle/edit_product.php?pr_id=<?php echo $row['id'] ?>">Edit</a><button class="btn action-btn btn-red" onclick="delProduct(<?php echo $row['id'] ?>,this)">Delete</button></td>
                                </tr>
                    <?php $sno += 1;
                            }
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="admin.js"></script>

</body>

</html>