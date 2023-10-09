<?php
include "../partials/dbconn.php";
include "chk.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="admin.css">

</head>

<body class="body-clr">
    <div class="box">
        <img hidden id="hamburger" onclick="come()" src="../img/Hamburger.png" alt="">
        <ul class="nav">
            <li><img id="cross" onclick="go()" src="../img/Cross.png" alt=""></li>
            <li><a class="prItems" id="categories" href="index.php">Categories</a></li>
            <li><a class="prItems" id="products" href="selectCat.php">Products</a></li>
            <li><a class="prItems" id="order" href="Order.php">Orders</a></li>
            <li><a class="prItems" id="users" href="users.php">Users</a></li>
            <li><a class="prItems" id="adminContact" style="background-color: #FFC300 !important;" href="adminContact.php">Contact</a></li>
            <li><a class="prItems" id="adminLogout" href="ad_logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="catHeadContain">
        <div class="catHeading">
            <h2>Contact Us</h2>
        </div>
    </div>

    <div class="mainCatContain">


        <div class="mainCat">

            <table>
                <thead>
                    <th>Sno</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th style="text-align: center;">Actions</th>
                </thead>
                <tbody>
                    <?php
                    $getContacts = mysqli_query($conn, "SELECT * FROM e_contacts");
                    if (!$getContacts) {
                        echo "some problem occured while fetching contacts!";
                    } else {
                        $sno = 1;
                        while ($row = mysqli_fetch_assoc($getContacts)) {

                    ?>
                            <tr>
                                <td><?php echo $sno ?></td>
                                <td><?php echo $row['c_name'] ?></td>
                                <td><?php echo $row['c_email'] ?></td>
                                <td><?php echo $row['c_phone'] ?></td>
                                <td><?php echo $row['c_message'] ?></td>
                                <td><?php echo $row['c_date'] ?></td>
                                <td><button class="btn action-btn btn-red" onclick="delContact(<?php echo $row['sno'] ?>, this)">Delete</button></td>
                            </tr>
                    <?php $sno = $sno + 1; }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>



    <script src="admin.js"></script>

</body>

</html>