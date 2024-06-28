<?php

require "connection.php";

// echo "ok";
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password1 = $_POST["password1"];
$rpassword1 = $_POST["rpassword1"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];


// echo $fname;
// echo "<br/>";
// echo $lname;
// echo "<br/>";
// echo $email;
// echo "<br/>";
// echo $password1;
// echo "<br/>";
// echo $mobile;
// echo "<br/>";
// echo $gender;

if(empty($fname)){
    echo "Please enter your First Name...";
}else if(strlen($fname) > 50){
    echo "First Name must be less than 50 characters...";
}else if(empty($lname)){
    echo "Please enter your Last Name...";
}else if(strlen($lname) > 50){
    echo "Last Name must be less than 50 characters...";
}else if(empty($email)){
    echo "Please enter your Email Address...";
}else if(strlen($email) > 100){
    echo "Email Address must be less than 100 characters...";
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "Invalid Email Address...";
}else if(empty($password1)){
    echo "Please enter your Password...";
}else if(strlen($password1) < 5 || strlen($password1) > 20){
    echo "Password Length Should be between 5 to 20...";
}else if(empty($rpassword1)){
    echo "Please re-enter your new Password.";
}else if($password1 != $rpassword1){
    echo "Password & Re-type password dose not match.";
}else if(empty($mobile)){
    echo "Please enter your Mobile Number...";
}else if(strlen($mobile) != 10){
    echo "mobile number should contain 10 characters...";
}else if(preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0){
    echo "Inalid Mobile Number.";
}else{
    $r = Database::search("SELECT * FROM `user` WHERE email = '".$email."' OR mobile = '".$mobile."'");
    $n = $r->num_rows;

    // echo $n;
    if($n > 0){
        echo "User with the same Email address or Phone Number alreads.";
    }else{

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        // echo $date;
        Database::iud("INSERT INTO `user` (`email`,`fname`,`lname`,`password`,`mobile`,`gender`,`register_date`) VALUES ('".$email."','".$fname."','".$lname."','".$password1."','".$mobile."','".$gender."','".$date."')");

        echo "success";
    }
}

?>