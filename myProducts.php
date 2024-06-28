<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"];
    $pageno;

?>



    <!DOCTYPE html>
    <html>

    <head>
        <title>Own Dress | My Products</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="icon" href="resources/logo_free-file.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body class="hb1">

        <div class="container-fluid">
            <div class="row">

                <!-- header -->
                <div class="col-12 bg-primary">
                    <div class="row">
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12 col-lg-4 mt-1 text-center">

                                    <?php

                                    $profileImage = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $user["email"] . "'");
                                    $pn = $profileImage->num_rows;

                                    if ($pn == 1) {
                                        $prl = $profileImage->fetch_assoc();
                                    ?>
                                        <img src="<?php echo $prl["code"]; ?>" class="rounded-circle" width="90px" height="90px" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resources/demoProfileImg.jpg" class="rounded-circle" width="90px" height="90px" />
                                    <?php
                                    }

                                    ?>

                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="row">
                                        <div class="col-12 mt-0 mt-lg-3">
                                            <span class="fw-bold"><?php echo $user["fname"] . " " . $user["lname"]; ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-white"><?php echo $user["email"]; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-12 mt-5 my-lg-3">
                                    <h1 class="offset-6 offset-lg-2 fw-bold text-white fs-1">My Products</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- header -->
                <!-- body -->

                <div class="col-12">
                    <div class="row">

                        <!-- products -->

                        <div class="col-12 col-lg-8 offset-2 mt-3 mb-3 bg-white">
                            <div class="row">

                                <div class="col-12 text-center">
                                    <div class="row justify-content-center gap-2">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "'");
                                        $nProducts = $products->num_rows;
                                        $userProduct = $products->fetch_assoc();

                                        $result_per_page = 12;
                                        $number_of_pages = ceil($nProducts / $result_per_page);

                                        $page_first_result = ($pageno - 1) * $result_per_page;
                                        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "");
                                        $srn = $selectedrs->num_rows;

                                        for ($x = 0; $x < $srn; $x++) {
                                            $p = $selectedrs->fetch_assoc();

                                        ?>
                                            <!-- card -->
                                            <div class="card mb-3 mt-3 col-12 col-lg-3 boxshd" style="width: 14rem;">
                                                <div class="row">
                                                    <div class="col-md-12 mt-4">

                                                        <?php

                                                        $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $p["id"] . "'");
                                                        $pir = $pimgrs->fetch_assoc();

                                                        ?>
                                                        <img src="<?php echo $pir["code"]; ?>" class="img-fluid card-img-top rounded-start">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold"><?php echo $p["title"]; ?></h5>
                                                            <span class="card-text text-primary fw-bold">Rs. <?php echo $p["price"]; ?> .00</span>
                                                            <br />
                                                            <span class="card-text text-success fw-bold"><?php echo $p["qty"]; ?> Items Left</span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="changeStatus(<?php echo $p['id']; ?>);" <?php

                                                                                                                                                                                                            if ($p["status_id"] == 1) {
                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                            }

                                                                                                                                                                                                            ?> />
                                                                <label class="form-check-label text-info fw-bold" for="flexSwitchCheckChecked" id="checklLable<?php echo $p['id']; ?>">
                                                                    <?php

                                                                    if ($p["status_id"] == 2) {
                                                                        echo "Make Your product Active.";
                                                                    } else {
                                                                        echo "Make Your product Deactive";
                                                                    }

                                                                    ?>
                                                                </label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row g-1">
                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <a href="#" class="btn btn-success" onclick="sendId(<?php echo $p['id']; ?>);">Update</a>
                                                                        </div>
                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <a href="#" class="btn btn-danger">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- card -->
                                        <?php
                                        }

                                        ?>




                                    </div>

                                </div>
                                <!-- pagination -->

                                <div class="offset-lg-4 col-12 col-lg-4 text-center mb-3">
                                    <div class="pagination">
                                        <a href="
                                        <?php

                                        if ($pageno <= 1) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno - 1);
                                        }

                                        ?>">&laquo;</a>

                                        <?php

                                        for ($page = 1; $page <= $number_of_pages; $page++) {

                                            if ($page == $pageno) {

                                        ?>

                                                <a href="<?php echo "?page=" . ($page) ?>" class="active"><?php echo $page; ?></a>

                                            <?php

                                            } else {
                                            ?>

                                                <a href="<?php echo "?page=" . ($page) ?>"><?php echo $page; ?></a>

                                        <?php
                                            }
                                        }

                                        ?>


                                        <a href="
                                        <?php

                                        if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno + 1);
                                        }

                                        ?>">&raquo;</a>
                                    </div>
                                </div>

                                <!-- pagination -->

                                <!-- products -->
                            </div>
                        </div>

                        <!-- body -->

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

?>

    <script>
        alert("You have to Sign In Or Sign Up First.");
        window.location = "index.php";
    </script>

<?php
}

?>