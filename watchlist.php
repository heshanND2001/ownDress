<?php

require "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist | Own Dress</title>

    <link rel="icon" href="resources/logo_free-file.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="hb1">

    <div class="container-fluid">
        <div class="row">
            <?php

            require "header.php";

            if (isset($_SESSION["u"])) {
                $mail = $_SESSION["u"]["email"];

            ?>

            <div class="col-12">
                <div class="row">
                    <div class="col-12 border border-1 border-secondary rounded mb-3 mt-3">
                        <div class="row">


                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="form-label fs-1 text-info fw-bold">Watchlist &hearts;</label>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <input type="text" class="form-control" placeholder="Search in watchlist..." id="basic_search_txt">
                                    </div>
                                    <div class="col-12 col-lg-2 mt-3">
                                        <button class="btn btn-outline-info fw-bold" onclick="basicSearch(0);">Search</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="hr-break-1" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">

                <div class="col-12 col-lg-10 offset-1 mt-3 mb-3 bg-white" style="border-radius: 5px;">
                    <div class="row">

                    <?php

                                $products = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $mail . "'");
                                $productCount = $products->num_rows;

                                if ($productCount == 0) {

                                ?>
                                    <!-- no items -->

                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 emptyview"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bolder mb-3">
                                                    You have no Items in your Watchlist yet.
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- no items -->
                                <?php

                                } else {

                                ?>
                                    <!-- item -->

                                    <!-- <div > -->
                                        <div class="col-12 col-lg-11 mt-2" id="basicSearchResult">
                                            <div class="row g-2">

                                                <?php

                                                for ($x = 0; $x < $productCount; $x++) {
                                                    $product = $products->fetch_assoc();
                                                    $prod_id = $product["product_id"];
                                                    $prod_details = Database::search("SELECT * FROM `product` WHERE `id`='" . $prod_id . "'");
                                                    $pn = $prod_details->num_rows;
                                                    if ($pn) {
                                                        $pf = $prod_details->fetch_assoc();
                                                        $pid = $pf["id"];

                                                ?>

                                                        <div class="card mb-3 mx-0 mx-lg-2  col-12 boxshd">
                                                            <div class="row g-0">
                                                                <div class="col-md-2">

                                                                    <?php
                                                                    $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "' ");
                                                                    $img = $pimage->fetch_assoc();

                                                                    ?>

                                                                    <img src="<?php echo $img["code"]; ?>" class="img-fluid rounded-start">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title text-primary"><?php echo $pf["title"]; ?></h5>


                                                                        <!-- <span class="fw-bold text-black-50">Colour : Pacific Blue</span>&nbsp; -->

                                                                        <br />
                                                                        
                                                                        &nbsp;<span class="fw-bold text-black-50">Quantity : <?php echo $pf["qty"]; ?></span>

                                                                        <br />
                                                                        <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                                                                        <span class="fw-bold text-black-50 fs-5">Rs. <?php echo $pf["price"]; ?>.00</span>
                                                                        <br />
                                                                        <?php
                                                                        $userrs = Database::search("SELECT * FROM user WHERE `email` = '" . $product["user_email"] . "'");
                                                                        $userd = $userrs->fetch_assoc();
                                                                        ?>
                                                                        <span class="fw-bold text-dark fs-5">Seller :</span>&nbsp;
                                                                        <br />
                                                                        <span class="fw-bold text-black-50 fs-5"><?php echo $userd["fname"]; ?></span>&nbsp;
                                                                        <br />
                                                                        <span class="fw-bold text-black-50 fs-5"><?php echo $userd["email"]; ?></span>&nbsp;


                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mt-4">
                                                                    <div class="card-body d-grid">
                                                                        <a href="#" class="btn btn-outline-success mb-2">Buy now</a>
                                                                        <a href="#" class="btn btn-outline-warning mb-2">Add Cart</a>
                                                                        <a href="#" class="btn btn-outline-danger mb-2" onclick="deleteFromWatchlist(<?php echo $product['id']; ?>);">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                <?php
                                                    }
                                                }

                                                ?>



                                            </div>
                                        </div>
                                    <!-- </div> -->

                                    <!-- item -->
                                <?php

                                }

                                ?>

                    </div>
                </div>

                </div>
            </div>

            <?php

            require "footer.php";

            ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>

<?php

            } else {
                echo "You have to sign in first.";
            }

?>