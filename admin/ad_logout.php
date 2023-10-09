<?php
session_start();
unset($_SESSION['ad_login']);
unset($_SESSION['ad_user']);

header("location: adminLog.php");
?>