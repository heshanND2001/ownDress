<?php

session_start();
require "connection.php";

$recivers_email = $_SESSION["u"]["email"];

$message_rs = Database::search("SELECT * FROM `message` WHERE `from`='" . $recivers_email . "' OR `to`='" . $recivers_email . "'");

$message_num = $message_rs->num_rows;

for ($x = 0; $x < $message_num; $x++) {
    $rowData = $message_rs->fetch_assoc();

    

    $profileImg = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $rowData["from"] . "' ");
    $pn = $profileImg->num_rows;

    if ($pn == 1) {
        $p = $profileImg->fetch_assoc();
    ?>

        <img class="rounded-circle border border-4" width="30px" height="30px" src="<?php echo $p["code"]; ?>" id="prev0">

    <?php
    } else {
    ?>

        <img class="rounded-circle border border-4" width="30px" height="30px" src="resources/demoProfileImg.jpg" id="prev0">

    <?php
    }
  
    $profiledt_f = Database::search("SELECT * FROM `user` WHERE `email` = '" . $rowData["from"] . "' ");
    $from_name = $profiledt_f->fetch_assoc();

    $profiledt_t = Database::search("SELECT * FROM `user` WHERE `email` = '" . $rowData["to"] . "' ");
    $to_name = $profiledt_t->fetch_assoc();

    echo $from_name["fname"];
    echo "->";
    echo $to_name["fname"];
    echo "<br/>";
    echo $rowData["content"];
    echo "<br/>";
    echo $rowData["date_time"];
    echo "<br/>";
    echo "<br/>";
}


?>