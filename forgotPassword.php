<?php

require "connection.php";

require "SMTP.php";
require "Exception.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){
    $email = $_GET["e"];

    if(empty($email)){
        echo "Please enter an valid Email.";
    }else{
        $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."'");
        if($rs->num_rows == 1){
            $code = uniqid();
            // echo $code;
            Database::iud("UPDATE `user` SET `verification_code` = '".$code."' WHERE `email` = '".$email."'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'heshandanansooriya@gmail.com';
            $mail->Password = 'Heshan2001';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('heshandanansooriya@gmail.com', 'Own Dress');
            $mail->addReplyTo('heshandanansooriya@gmail.com', 'Own Dress');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'eShop Forget Password Verfivation Code';
            $bodyContent = '<h1 style = "color : green;">Your Verification code is : '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

        }else{
            echo "Email address not found";
        }
    }
}else{
    echo "Please enter your Email Address...";
}

// echo $email;

?>