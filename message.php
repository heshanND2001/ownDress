<?php require "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Own Dress | Messages</title>

    <link rel="shortcut icon" href="resources/logo_free-file.png" type="image/x-svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>

<body class="hb1" onload="loadChat();">
    <div class="container-fluid">
        <div class="row">

            <?php require "header.php"; ?>

            <div class="col-12">
                <div class="row">

                    <div class="col-12 col-lg-4 offset-lg-2">
                        <div class="row mt-2" style="margin-left: 20px;height: 520px;">
                            <div class="box1" id="box1"></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 offset-lg-1 mt-4">
                        <span class="sp text-info fw-bold">Recipient</span>
                        <div class="col-12">
                            <select class="form-select" id="email">
                                <option value="0">Select Recipient</option>
                                <?php

                                $rs = Database::search("SELECT * FROM `user`");
                                $n = $rs->num_rows;

                                for ($x = 0; $x < $n; $x++) {

                                    $d = $rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $d["email"]; ?>"><?php echo $d["email"]; ?></option>

                                <?php

                                }

                                ?>
                            </select>
                        </div>

                        <br /></br />

                        <span class="in text-info fw-bold">Message</span>
                        <input class="form-control" type="text" id="m" />

                        <br /><br />

                        <button class="btn1 btn btn-primary" onclick="sendMsg();">Send</button>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>