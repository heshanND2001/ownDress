<?php

require "connection.php";

require "SMTP.php";
require "Exception.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

// echo $email;

if (isset($_POST["e"])) {
    $email = $_POST["e"];

    if (empty($email)) {
        
        echo "Please enter your Email Address.";

    } else {
        
        $adminrs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
        $sn = $adminrs->num_rows;

        if ($sn == 1) {
            
            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'heshandanansooriya@gmail.com';
            $mail->Password = 'jumgpmvnzixrrabm';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('heshandanansooriya@gmail.com', 'Own Dress');
            $mail->addReplyTo('heshandanansooriya@gmail.com', 'Own Dress');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Admin Verfivation Code';
            $bodyContent = '<h1 style = "color : green;">Your Verification code is : '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Dicline email sending failed';
            } else {
                echo 'Success';
            }

        }else{
            echo "You are not a valid user.";
        }

    }
    
}

?>