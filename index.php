<!DOCTYPE html>
<html>

<head>
    <title>Own Dress</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo_free-file.png" />
    <link rel="stylesheet" href="animate.css"/>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="body">
    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">
            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <!-- <div class="col-12 logo"></div> -->
                    <div class="col-12">
                        <p class="text-center title1 text-info fw-bold animate__animated animate__fadeInDown">Hi, Welcome to Own Dress Shop</p>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- content -->
            <div class="col-12 p-3">
                <div class="row  offset-lg-4">
                    <div class="col-12 col-lg-6 animate__animated animate__backInLeft" id="signUpBox">
                        <div class="row g-2 align-content-center cnabox">
                            <div class="col-12 text-center">
                                <p class="title02"><b>Create New Account</b></p>
                                <span class="text-danger" id="msg"></span>
                            </div>

                            <div class="col-6">
                                <label class="form-label" style="color: rgb(255, 0, 126, 1);"><b>First Name</b></label>
                                <input class="form-control" type="text" id="fname" placeholder="First Name" />
                            </div>
                            <div class="col-6">
                                <label class="form-label" style="color: rgb(255, 0, 126, 1);"><b>Last Name</b></label>
                                <input class="form-control" type="text" id="lname" placeholder="Last Name" />
                            </div>

                            <div class="col-12">
                                <label class="form-label" style="color: rgb(255, 0, 126, 1);"><b>Email</b></label>
                                <input class="form-control" type="email" id="email1" placeholder="Email Address" />
                            </div>

                            <div class="col-6">
                                <label class="form-label" style="color: rgb(255, 0, 126, 1);"><b>Password</b></label>
                                <input class="form-control" type="password" id="password1" placeholder="Password" />
                            </div>
                            <div class="col-6">
                                <label class="form-label" style="color: rgb(255, 0, 126, 1);"><b>Confirm Password</b></label>
                                <input class="form-control" type="password" id="rpassword1" placeholder="Confirm Password" />
                            </div>

                            <div class="col-6">
                                <label class="form-label" style="color: rgb(255, 0, 126, 1);"><b>Mobile</b></label>
                                <input class="form-control" type="text" id="mobile" placeholder="Mobile Number" />
                            </div>

                            <div class="col-6">
                                <label class="form-label" style="color: rgb(255, 0, 126, 1);"><b>Gender</b></label>
                                <select class="form-select" id="gender">

                                    <?php

                                    require "connection.php";

                                    $r = Database::search("SELECT * FROM `gender`");
                                    $n = $r->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $r->fetch_assoc();
                                    ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>

                                    <?php
                                    }

                                    ?>

                                </select>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark" onclick="changeView();">Sign In</button>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-6 d-none animate__animated animate__backInLeft cnabox" id="signInBox">
                        <div class="row g-2">

                            <div class="col-12">
                                <p class="title02"><b>Sign In to Your Account</b></p>
                                <span class="text-danger" id="msg2"></span>
                            </div>

                            <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>

                            <div class="col-12">
                                <label class="form-label" style="color: rgb(255, 0, 126, 1);"><b>Email</b></label>
                                <input class="form-control" type="email" value="<?php echo $email ?>" id="email2" placeholder="Email Addess" />
                            </div>

                            <div class="col-12">
                                <label class="form-label" style="color: rgb(255, 0, 126, 1);"><b>Password</b></label>
                                <input class="form-control" type="password" value="<?php echo $password ?>" id="password2" placeholder="Password" />
                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-form-check-input" value="1" id="rememberMe" />
                                    <label class="form-check-label" style="color: rgb(255, 0, 126, 1);">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <a href="#" class="link-primary" onclick="forgotpassword();">Forgot Password</a>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signIn();">Sign In</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="changeView();">New to Own Dress? Join Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content -->
            <!-- model -->
            <div class="modal" tabindex="-1" id="forgotpasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np" />
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword();">Show</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">R-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp" />
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="RshowPassword();">Show</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="vc" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- model -->
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>