<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $uemail = $_SESSION["u"]["email"];
    $pid = $_GET["id"];

    // echo $uemail . " " . $pid;

    $cartProducts = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $uemail . "' AND `product_id` = '" . $pid . "'");
    $cartProductsNum = $cartProducts->num_rows;

    $productqtyrs = Database::search("SELECT `qty` FROM `product` WHERE `id` = '" . $pid . "'");
    $qtyrows = $productqtyrs->fetch_assoc();

    $prodQty = $qtyrows["qty"];

    if ($cartProductsNum == 1) {
        $cartRows = $cartProducts->fetch_assoc();
        $currentqty = $cartRows["qty"];
        $newqty = (int)$currentqty + 1;

        if ($prodQty >= $newqty) {
            Database::iud("UPDATE `cart` SET `qty` = '" . $newqty . "' WHERE `user_email` = '" . $uemail . "' AND `product_id` = '" . $pid . "'");
            echo "Product quantity updated.";
        } else {
            echo "Invalid product quantity.";
        }
    } else {
        Database::iud("INSERT INTO `cart` (`product_id`, `user_email`, `qty`) VALUES ('" . $pid . "', '" . $uemail . "', '1')");
        echo "New product has been added to cart.";
    }
} else {
    echo "Please Sign In first.";
}
