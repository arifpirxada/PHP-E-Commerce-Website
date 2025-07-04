<?php
function add_product ($pid, $qty) {
    $_SESSION['cart'][$pid]['qty'] = $qty;
}

function update_product ($pid, $qty) {
    if (isset($_SESSION['cart'][$pid])) {
        $_SESSION['cart'][$pid]['qty'] = $qty;
    }
}

function remove_product ($pid) {
    if (isset($_SESSION['cart'][$pid])) {
        unset($_SESSION['cart'][$pid]);
    }
}

function empty_cart () {
    unset($_SESSION['cart']);
}

function total_products () {
    if(isset($_SESSION['cart'])) {
        return count($_SESSION['cart']);
    } else {
        return 0;
    }
}
?>