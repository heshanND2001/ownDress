<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="col-12">
        <div class="row mt-1 mb-1 justify-content-center">
            <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                <!-- Navbar content -->
                <div class="col-12 col-lg-6 offset-lg-0 align-align-self-start">

                    <img src="resources/Own Dress_free-file.png" class="il  animate__animated animate__heartBeat" />

                    <span class="text-lg-start offset-lg-1 lable1"><b>Welcome</b>

                        <?php

                        session_start();

                        if (isset($_SESSION["u"])) {
                            $data = $_SESSION["u"];
                        ?>

                            <?php echo $data["fname"] ?>
                        <?php
                        } else {
                        ?>

                            <a href="index.php">Sign In Or Register</a>

                        <?php
                        }

                        ?>

                    </span> |
                    <span class="text-lg-start lable2">Help and Contact</span> |
                    <span class="text-lg-start lable2" onclick="SignOut();">Sign Out</span>

                </div>

                <div class="col-12 col-lg-2 offset-lg-4 align-self-and" style="text-align: center;">
                    <div class="row">

                        <div class="col-1 col-lg-3 mt-2">
                            <span class="text-start lable2"><a href="addProduct.php">Sell</a></span>
                        </div>

                        <div class="col-1 col-lg-6 dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Own Dress
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="myProfilenew.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="sellingHistory.php">Selling History</a></li>
                                <li><a class="dropdown-item" href="myProducts.php">My Products</a></li>
                                <li><a class="dropdown-item" href="watchlist.php">Watch List</a></li>
                                <li><a class="dropdown-item" href="purchasingHistory.php">Purchase History</a></li>
                                <li><a class="dropdown-item" href="message.php">Messages</a></li>
                                <li><a class="dropdown-item" href="#">Saved</a></li>
                            </ul>
                        </div>

                        <a href="cart.php" class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1">
                            <div class="cart-icon"></div>
                        </a>
                    </div>

                </div>

            </nav>

        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>