<?php
include "../partials/dbconn.php";
include "chk.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>


<body class="body-clr">

    <div class="box">
        <img hidden id="hamburger" onclick="come()" src="../img/Hamburger.png" alt="">
        <a class="btn subCats" id="subCategories" href="subCategories.php">Sub Categories</a>
        <a class="btn subCats addCat" id="addCategories" href="addcategory.php">Add</a>
        <ul class="nav">
            <li><img id="cross" onclick="go()" src="../img/Cross.png" alt=""></li>
            <li><a class="prItems" style="background-color: #FFC300 !important;" id="categories" href="index.php">Categories</a></li>
            <li><a class="prItems" id="products" href="selectCat.php">Products</a></li>
            <li><a class="prItems" id="order" href="Order.php">Orders</a></li>
            <li><a class="prItems" id="users" href="users.php">Users</a></li>
            <li><a class="prItems" id="adminContact" href="adminContact.php">Contact</a></li>
            <li><a class="prItems" id="adminLogout" href="ad_logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="catHeadContain">
        <div class="catHeading">
            <h2>Main Categories</h2>
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
                    $res = mysqli_query($conn, "SELECT * FROM main_categories");
                    if (!$res) {
                        echo "selection was unsuccesful!";
                    }
                    $sno = 1;
                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr>
                            <td><?php echo $sno ?></td>
                            <td><?php echo $row['m_name'] ?></td>
                            <td style="text-align: end;"><button class="btn action-btn <?php if($row['m_status'] == 0) {echo 'btn-red';}?>" onclick="status_chng(<?php echo $row['m_id'] ?>,this)"><?php if($row['m_status'] == 1) {echo 'Active';} else { echo 'Deactive';}?></button><a class="btn action-btn" href="mainActHandle/edit_mcat.php?m_cat=<?php echo $row['m_id'] ?>">Edit</a><button class="btn action-btn btn-red cat-red-btn" onclick="delMainCat(<?php echo $row['m_id'] ?>,this)">Delete</button></td>
                        </tr>
                    <?php $sno += 1;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>




    <script src="admin.js"></script>

</body>

</html>