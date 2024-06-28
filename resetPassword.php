<?php

require "connection.php";

$e = $_POST["e"];
$np = $_POST["np"];
$rnp = $_POST["rnp"];
$vc = $_POST["vc"];

// echo $e;
// echo "<br/>";
// echo $np;
// echo "<br/>";
// echo $rnp;
// echo "<br/>";
// echo $vc;

if(empty($e)){
    echo "Missing Email Address";
}else if(empty($np)){
    echo "Please enter your new password";
}else if(strlen($np) < 5 || strlen($np) >= 20){
    echo "Please Length should be between 5 to 20.";
}else if(empty($rnp)){
    echo "Please re-enter your new Password.";
}else if($np != $rnp){
    echo "Password & Re-type password dose not match.";
}else if(empty($vc)){
    echo "Please enter your verification code.";
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$e."' AND `verification_code`='".$vc."'");
    if($rs->num_rows == 1){
        Database::iud("UPDATE `user` SET `password`='".$np."' WHERE `email`='".$e."'");
        echo "success";
    }else{
        echo "Password reset feiled";
    }
}

?>