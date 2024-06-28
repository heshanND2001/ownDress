<!DOCTYPE html>
<html>

<head>
    <title>Own Dress</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo_free-file.png" />
    <link rel="stylesheet" href="animate.css" />
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
                    <div class="col-12 col-lg-6 animate__animated animate__backInLeft">
                        <div class="row g-2 align-content-center cnabox">


                            <div class="col-12">
                                <p class="title02">Sign In To Your Account</p>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="e">
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="adminVerification();">send verification code to Log In</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger">Back to Customer Log In</button>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <!-- content -->
            <!-- model -->
            <div class="modal" tabindex="-1" id="verification_model">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter the verification code You got by an Email</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
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