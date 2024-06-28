<?php

require "connection.php";

$pid = $_GET["id"];

// echo $pid;

$cartrs = Database::search("SELECT * FROM `cart` WHERE `id`='".$pid."'");
$cart = $cartrs->fetch_assoc();

$id = $cart["product_id"];
$user_mail = $cart["user_email"];

// echo $id;
// echo "<br/>";
// echo $user_mail;

Database::iud("INSERT INTO `recent` (`product_id`,`user_email`) VALUES ('".$id."','".$user_mail."')");

Database::iud("DELETE FROM `cart` WHERE `id`='".$pid."'");

echo "success";

?>