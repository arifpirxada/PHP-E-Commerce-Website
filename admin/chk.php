<?php 
if(!isset($_SESSION['ad_login']) || $_SESSION['ad_login'] != true ) {
    header("location: adminLog.php");
}
?>