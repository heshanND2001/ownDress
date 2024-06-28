<?php

// echo "ok";
require "connection.php";

session_start();

if(isset($_SESSION["u"])){

    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $mobile = $_POST["m"];
    $addline1 = $_POST["a1"];
    $addline2 = $_POST["a2"];
    $city = $_POST["c"];
    $shnm = $_POST["shnm"];

    if(isset($_FILES["i"])){
        $img = $_FILES["i"]["name"];
       
        $allowed_image_extention = array("image/jpg","image/png","image/svg","image/jpeg");
        $fileex = $img["type"];
        // echo $fileex;

        if(!in_array($fileex,$allowed_image_extention)){
            echo "Please select a valid image.";
        }else{

            $newimageextention;
            if($fileex == "image/jpg"){
                $newimageextention = ".jpg";
            }else if($fileex == "image/jpeg"){
                $newimageextention = ".jpeg";
            }else if($fileex == "image/png"){
                $newimageextention = ".png";
            }else if($fileex == "image/svg"){
                $newimageextention = ".svg";
            }

            $file_name = "resources//profiles//".uniqid().$newimageextention;
            // echo $file_name;

            move_uploaded_file($img["tmp_name"],$file_name);

            $profilers = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='".$_SESSION["u"]["email"]."'");
            $in = $profilers->num_rows;

            if($in == 1){

                //update

                Database::iud("UPDATE `profile_img` SET `code`='".$file_name."' WHERE `user_email`='".$_SESSION["u"]["email"]."'");

                echo "Profile image updated successfully.";

            }else{

                //insert
                Database::iud("INSERT INTO `profile_img` (`code`,`user_email`) VALUES ('".$file_name."','".$_SESSION["u"]["email"]."')");

                echo "New profile image saved successfully";

            }
        }

    }

    // echo $fname;
    // echo $lname;
    // echo $mobile;
    // echo $addline1;
    // echo $addline2;
    // echo $city;
    // echo $img;

    $shopnm = Database::search("SELECT * FROM `pro_shop_name` WHERE `shop_name`='".$shnm."'");
    $sn = $shopnm->num_rows;

    if($sn == 1){

            //update

        Database::iud("UPDATE `pro_shop_name` SET `shop_name`='".$shnm."' WHERE `user_email`='".$_SESSION["u"]["email"]."'");

        echo "Shop Name updated successfully.";

    }else{

            //insert
        Database::iud("INSERT INTO `pro_shop_name` (`shop_name`) VALUES ('".$shnm."')");

        echo "Shop Name saved successfully";

    }

    Database::iud("UPDATE `user` SET `fname`='".$fname."',`lname`='".$lname."',`mobile`='".$mobile."',`shop_name`='".$shnm."' WHERE `email`='".$_SESSION["u"]["email"]."'");

    echo "User has been Updated";

    $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$_SESSION["u"]["email"]."'");
    $nrs = $addressrs->num_rows;

    if($nrs == 1){

        //update
        Database::iud("UPDATE `user_has_address` SET `line1`='".$addline1."',`line2`='".$addline2."',`city_id`='".$city."' WHERE `user_email`='".$_SESSION["u"]["email"]."'");

        echo "Address Updated Successfully";
    }else{

        //save-insert
        Database::iud("INSERT INTO `user_has_address` (`user`,`line1`,`line2`,`city_id`) VALUE ('".$_SESSION["u"]["email"]."','".$addline1."','".$addline2."','".$city."')");

        echo "New Address Added Successfully";
    }

    $_SESSION["u"]["fname"] = $fname;
    $_SESSION["u"]["lname"] = $lname;
    $_SESSION["u"]["mobile"] = $mobile;
    $_SESSION["u"]["shop_name"]=$shnm;

}else{

    echo "error";
}

?>