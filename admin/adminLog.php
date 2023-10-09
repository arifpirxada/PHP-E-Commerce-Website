<?php
include "../partials/dbconn.php";

// Php for admin login 
$noUser = false;
$wrPass = false;

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = safe_value($conn,$_POST['adminEmail']);
    $pass = safe_value($conn,$_POST['adminPassword']);

    $result = mysqli_query($conn,"SELECT * FROM admin_users WHERE ad_email = '$email'");
    if(!$result) {
        echo "selection was unsuccessful!".mysqli_connect_error($result);
    }
    $num = mysqli_num_rows($result);
    if($num == 0) {
        global $noUser;
        $noUser = true;
    }
    else {

        $row = mysqli_fetch_assoc($result);
        if($pass != $row['ad_password']) {
            $wrPass = true;
        }
        else {
            $_SESSION['ad_login'] = true;
            $_SESSION['ad_user'] = $email;
            header("location: index.php");
        }
    }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>
</head>
<link rel="stylesheet" href="admin.css">
<body>
    <div class="container">
        <form class="adminLog" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <h2 class="adminLogHead">Admin Login</h2>
            <label class="topLabel" for="adminEmail">Email</label>
            <input required id="adminEmail" name="adminEmail" type="email" placeholder="Email">
            <?php global $noUser; if($noUser) { ?>
                <p class="notify">no user found</p>
            <?php } ?>
            <label id="adminPasswordLabel" for="adminPassword">Password</label>
            <input required id="adminPassword" name="adminPassword" type="password" placeholder="password">
            <?php global $wrPass; if($wrPass) { ?>
                <p class="notify">wrong password</p>
            <?php } ?>
            <button class="btn submit-btn" type="submit" id="adminSubmit">Login</button>
        </form>
    </div>

    <script src="admin.js"></script>
    
</body>
</html>