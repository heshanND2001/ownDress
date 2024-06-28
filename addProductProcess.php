<?php
session_start();
require "connection.php";

$category = $_POST["c"];
$proShopName = $_POST["psn"];
$title = $_POST["t"];
$color = $_POST["col"];
$qty = $_POST["qty"];
$price = $_POST["p"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$description = $_POST["desc"];
$imagefile = $_FILES["img"];

// echo $proShopName;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;
$usermail = $_SESSION["u"]["email"];

if ($category == "0") {
    echo "Please select a category.";
} else if (empty($proShopName)) {
    echo "Please select a brand.";
} else if (empty($title)) {
    echo "Please add a title to your product.";
} else if (strlen($title) > 100) {
    echo "Please enter a title containing 100 characters or lower.";
} else if (empty($color)) {
    echo "Please add a color to your product.";
} else if (strlen($color) > 50) {
    echo "Please enter a color containing 50 characters or lower.";
}else if ($qty == "0" || $qty == "e" || $qty < 0) {
    echo "Please enter a valid quantity";
} else if (empty($qty)) {
    echo "Quantity field must be not be empty";
} else if (empty($price)) {
    echo "Please enter a price to your product.";
} else if (!ctype_digit($price)) {
    echo "Please enter a valid price.";
} else if (empty($dwc)) {
    echo "Please enter the delivery cost within Colombo.";
} else if (!ctype_digit($dwc)) {
    echo "Please enter a valid price for delivery cost within Colombo.";
} else if (empty($doc)) {
    echo "Please enter the delivery cost outside Colombo.";
} else if (!ctype_digit($doc)) {
    echo "Please enter a valid price for delivery cost outside Colombo.";
} else if (empty($description)) {
    echo "Please enter a description to your product.";
} else {
    $shopNames = Database::search("SELECT `name_id` FROM `pro_shop_name` WHERE `shop_name`='" . $proShopName . "'");

    if ($shopNames->num_rows == 0) {
        echo "This product does not exist.";
    } else {
        $f = $shopNames->fetch_assoc();
        $shopNamesDt = $f["name_id"];

        // echo $shopNamesDt;

        Database::iud("INSERT INTO `product` (`description`,`category`,`pro_shop_name_id`,`title`,`color`,`qty`,`price`,
        `delivery_fee_colombo`,`delivery_fee_other`,`date_time_added`,`user_email`,`status_id`) VALUES ('" . $description . "','" . $category . "',
        '".$shopNamesDt."',  '" . $title . "','" . $color . "', '" . $qty . "', '" . $price . "',
        '" . $dwc . "', '" . $doc . "','" . $date . "', '" . $usermail. "','" . $status . "')");

        // echo "Product added successfully.";

        $last_id = Database::$connection->insert_id;

        // echo $last_id;

        $allowed_image_extension = array("image/jpg", "image/jpeg", "image/png", "image/svg");

        if (isset($imagefile)) {
            $file_extension = $imagefile["type"];

            if (in_array($file_extension, $allowed_image_extension)) {
                $newimageextension;
                if ($file_extension == "image/jpg") {
                    $newimageextension = ".jpg";
                } else if ($file_extension == "image/jpeg") {
                    $newimageextension = ".jpeg";
                } else if ($file_extension == "image/png") {
                    $newimageextension = ".png";
                } else if ($file_extension == "image/svg") {
                    $newimageextension = ".svg";
                }

                $fileName = "resources//product//" . uniqid() . $imagefile["name"] . $newimageextension;
                move_uploaded_file($imagefile["tmp_name"], $fileName);

                Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES ('" . $fileName . "','" . $last_id . "')");
            } else {
                echo "Please select a valid image.";
            }
        } else {
            echo "Please select an image.";
        }
    }

    echo "Success";
}

// echo ($category . " " . $brand . " " . $model . " " . $title . " " . $condition . " " . $color . " " . $qty . " " . $price .
//     " " . $dwc . " " . $doc . " " . $desc . " " . $imagefile);
