<?php
$notLogedIn = false;
if(!isset($_SESSION['userLog']) || $_SESSION['userLog'] != true) {
    $notLogedIn = true;
}
?>