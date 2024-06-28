<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Own Dress | My Profile</title>

        <link rel="icon" href="resources/logo_free-file.png" />
        <link rel="stylesheet" href="animate.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="mbb">
        <div class="container-fluid justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="row">
                        <img src="resources/8.jpg" style="height: 300px; object-fit: cover;" />
                    </div>
                </div>
                <div class="col-12 col-lg-10 offset-lg-1" style="padding-left: 24px; padding-right: 24px;">
                    <div class="row mpn1">
                        <div class="col-6 col-lg-2 offset-lg-1 offset-3" style="margin-top: -100px;">
                            <?php
                            $profileImg = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' ");
                            $pn = $profileImg->num_rows;

                            if ($pn == 1) {
                                $p = $profileImg->fetch_assoc();
                            ?>

                                <img class="rounded-circle border border-4 mt-3" width="150px" height="150px" src="<?php echo $p["code"]; ?>" id="prev0">

                            <?php
                            } else {
                            ?>

                                <img class="rounded-circle border border-4 mt-3" width="150px" height="150px" src="resources/demoProfileImg.jpg" id="prev0">

                            <?php
                            }
                            ?>
                            <!-- <img class="rounded-circle border border-4 mt-3" width="150px" height="150px" src="resources/profileImg/IMG-3221.JPG" id="prev0"> -->
                        </div>
                        <div class="col-12 col-lg-9 mt-3 offset-2 offset-lg-0 mb-3">
                            <span class="fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span><br>
                            <span class="text-black-50 pemail"><b><?php echo $_SESSION["u"]["email"]; ?></b></span><br>
                            <input type="file" class="d-none" id="profileimg" accept="img/*">
                            <label class="btn btn-dark mt-3" for="profileimg" onclick="changeImage();">Update Profile Image</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-8 mb-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-decoration-underline">Profile Settings</h4>
                    </div>

                    <div class="row mt-2">

                        <div class="col-md-6">
                            <label class="form-label fw-bold">First Name</label>
                            <input type="text" id="fname" class="form-control" placeholder="First Name" value="<?php echo $_SESSION["u"]["fname"]; ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Last Name</label>
                            <input type="text" id="lname" class="form-control" placeholder="Last Name" value="<?php echo $_SESSION["u"]["lname"]; ?>">
                        </div>

                    </div>

                    <div class="row mt-3">

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Mobile Number</label>
                            <input type="text" id="mobile" class="form-control" placeholder="Enter Your Mobile Number" value="<?php echo $_SESSION["u"]["mobile"]; ?>">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <div class="row">
                                <div class="input-group">
                                    <input readonly type="password" class="form-control" id="mpid" placeholder="Enter Your Password" aria-label="Enter Your Password" aria-describedby="button-addon2" value="<?php echo $_SESSION["u"]["password"]; ?>">
                                    <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="showMyPassword();"><i class="bi bi-eye-fill"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input readonly type="email" class="form-control" placeholder="Enter Your Email Address" value="<?php echo $_SESSION["u"]["email"]; ?>">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Registered Date</label>
                            <input readonly type="text" class="form-control" placeholder="Enter Your Registered Date" value="<?php echo $_SESSION["u"]["register_date"]; ?>">
                        </div>

                        <?php
                        $usermail = $_SESSION["u"]["email"];
                        $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $usermail . "' ");
                        $n = $address->num_rows;

                        if ($n > 0) {
                            $d = $address->fetch_assoc();

                            $city = Database::search("SELECT * FROM `city` WHERE `id` = '" . $d["city_id"] . "' ");
                            $cf = $city->fetch_assoc();

                            $district = Database::search("SELECT * FROM `district` WHERE `id` = '" . $cf["district_id"] . "' ");
                            $df = $district->fetch_assoc();

                            $province = Database::search("SELECT * FROM `province` WHERE `id` = '" . $df["province_id"] . "' ");
                            $pf = $province->fetch_assoc();
                        ?>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Address Line 01</label>
                                <input type="text" id="addline1" class="form-control" placeholder="Address Line 01" value="<?php echo $d["line1"]; ?>">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Address Line 02</label>
                                <input type="text" id="addline2" class="form-control" placeholder="Address Line 02" value="<?php echo $d["line2"]; ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Province</label>
                                <select class="form-select">
                                    <option value="<?php echo $pf["id"]; ?>"><?php echo $pf["name"]; ?></option>

                                    <?php
                                    $pAll = Database::search("SELECT * FROM `province` WHERE `name` != '" . $pf["name"] . "' ");
                                    $num1 = $pAll->num_rows;

                                    for ($x = 0; $x < $num1; $x++) {
                                        $row1 = $pAll->fetch_assoc();
                                    ?>

                                        <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"]; ?></option>

                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">District</label>
                                <select class="form-select">
                                    <option value="<?php echo $df["id"]; ?>"><?php echo $df["name"]; ?></option>

                                    <?php
                                    $dAll = Database::search("SELECT * FROM `district` WHERE `name` != '" . $df["name"] . "' ");
                                    $num2 = $dAll->num_rows;

                                    for ($x = 0; $x < $num2; $x++) {
                                        $row2 = $dAll->fetch_assoc();
                                    ?>

                                        <option value="<?php echo $row2["id"]; ?>"><?php echo $row2["name"]; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">City</label>
                                <select class="form-select" id="usercity">
                                    <<option value="<?php echo $cf["id"]; ?>"><?php echo $cf["name"]; ?></option>

                                        <?php
                                        $cAll = Database::search("SELECT * FROM `city` WHERE `name` != '" . $cf["name"] . "' ");
                                        $num3 = $cAll->num_rows;

                                        for ($x = 0; $x < $num3; $x++) {
                                            $row3 = $cAll->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $row3["id"]; ?>"><?php echo $row3["name"]; ?></option>

                                        <?php
                                        }
                                        ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Postal Code</label>
                                <input type="text" class="form-control" placeholder="Postal Code" value="<?php echo $cf["postal_code"]; ?>">
                            </div>

                        <?php
                        } else {
                        ?>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Address Line 01</label>
                                <input type="text" id="addline1" class="form-control" placeholder="Address Line 01">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Address Line 02</label>
                                <input type="text" id="addline2" class="form-control" placeholder="Address Line 02">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Province</label>
                                <select class="form-select">
                                    <option value="0">Select Your Province</option>

                                    <?php
                                    $pAll = Database::search("SELECT * FROM `province` ");
                                    $num1 = $pAll->num_rows;

                                    for ($x = 0; $x <= $num1; $x++) {
                                        $row1 = $pAll->fetch_assoc();
                                    ?>

                                        <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"]; ?></option>

                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">District</label>
                                <select class="form-select">
                                    <option value="0">Select Your District</option>
                                    <option>Colombo</option>
                                    <option>Gampaha</option>
                                    <option>Kaluthara</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">City</label>
                                <select class="form-select" id="usercity">
                                    <option value="0">Select Your City</option>
                                    <option>Colombo</option>
                                    <option>Gampaha</option>
                                    <option>Kaluthara</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Postal Code</label>
                                <input type="text" class="form-control" placeholder="Postal Code">
                            </div>

                        <?php
                        }
                        ?>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Gender</label>

                            <?php
                            $gid = $_SESSION["u"]["gender"];
                            $g = Database::search("SELECT * FROM `gender` WHERE `id` = '" . $gid . "' ");
                            $gf = $g->fetch_assoc();
                            ?>

                            <input readonly type="text" class="form-control" placeholder="Gender" value="<?php echo $gf["name"]; ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Your Shop Name</label>
                            <input type="text" id="shnm" class="form-control" placeholder="Your Shop Name" value="<?php echo $_SESSION["u"]["shop_name"]; ?>">
                        </div>

                        <div class="mt-3 text-center">
                            <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                        </div>

                    </div>

                </div>

                <?php

                require "footer.php";

                ?>

            </div>


        </div>


        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <?php
} else {
    ?>

        <script>
            window.location = "index.php";
        </script>

    <?php
}
    ?>
    </body>

    </html>