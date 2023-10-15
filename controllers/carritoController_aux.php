<?php
session_start();

if (isset($_SESSION['cart'])) {
    $cartItemCount = count($_SESSION['cart']);
} else {
    $cartItemCount = 0;
}

echo $cartItemCount;
?>
