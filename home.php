<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Own Dress</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo_free-file.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="animate.css" />
    <link rel="stylesheet" href="semantic.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="icon.css">
    <link rel="stylesheet" href="icon.min.css">
    <link rel="stylesheet" href="bootstrap.css" />
</head>

<body class="hb1">
    <div class="container-fluid">
        <div class="row" style="margin-top: -5px;">
            <?php

            require "header.php";

            ?>

            <div class="col-12" style="background-color: #e3f2fd; margin-top: -5px;">
                <div class="row justify-content-center mt-2">
                    <div class="col-11 col-lg-6 offset-lg-2">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">
                            <select class="btn btn-outline-primary gap-2" id="basic_search_select">
                                <option readonly>Select Category</option>

                                <?php

                                $rs = Database::search("SELECT * FROM `category`");
                                $n = $rs->num_rows;

                                for ($x = 0; $x < $n; $x++) {
                                    $fa = $rs->fetch_assoc();
                                ?>

                                    <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>

                                <?php
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="col-6 col-lg-2 d-grid">
                        <button class="btn btn-primary mt-0 search-btn" style="width: 100px; height: 50px;" onclick="basicSearch(0);">Search</button>
                    </div>

                    <div class="col-2 col-lg-2 mt-2">
                        <a href="advancedSearch.php" class="link-secondary link-1">Advanced</a>
                    </div>
                </div>
            </div>

            <hr class="hr-break-1" />

            <div class="col-12" id="basicSearchResult">
                <div class="row">
                    <div class="col-12 col-lg-3 border-end mb-3 category mt-2">
                        <div class="row g-2 mx-3">

                            <?php

                            $rs = Database::search("SELECT * FROM `category`");
                            $n = $rs->num_rows;

                            for ($x = 0; $x < $n; $x++) {
                                $cat = $rs->fetch_assoc();

                            ?>


                                <button class="btn btn-dark py-3 animate__animated animate__rollIn boxshd1" style="font-size: 20px;" id="basic_search_select" value="<?php echo $fa["id"]; ?>"><?php echo $cat["name"]; ?></button>


                            <?php

                            }

                            ?>

                        </div>
                    </div>

                    <div class="col-12 col-lg-8 d-lg-block d-none" style="margin-left: 50px;">
                        <div class="row animate__animated animate__jackInTheBox">
                            <!-- <div class="col-lg-8 offset-2"> -->
                            <!-- The video -->
                            <video autoplay muted loop id="myVideo" class="w-100">
                                <source src="resources/video/Kinetic Frames Opener_free.mp4" type="video/mp4">
                            </video>
                            <!-- Optional: some overlay text to describe the video -->
                            <div class="content">
                                <button id="myBtn" onclick="myFunction()" class="ui inverted primary button col-12">Pause</button>
                            </div>
                            <!-- </div> -->

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row justify-content-center gap-2 product">

                            <?php
                            $resultset = Database::search("SELECT * FROM `product` ORDER BY `date_time_added` DESC LIMIT 4 OFFSET 0");
                            $norows = $resultset->num_rows;

                            ?>
                            <!-- produts -->

                            <div class="col-12 mt-2">
                                <div class="row border border-primary">
                                    <div class="col-12 col-lg-12" style="margin-top: 30px; margin-bottom: 20px;">
                                        <div class="row justify-content-center gap-2">
                                            <?php

                                            for ($y = 0; $y < $norows; $y++) {
                                                $product = $resultset->fetch_assoc();

                                            ?>

                                                <div class="card col-6 col-lg-12 mt-2 mb-2 " style="width: 20rem; background-color: #e3f2fd;" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                                                    <?php
                                                    $pimage = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product["id"] . "' ");
                                                    $img = $pimage->fetch_assoc();

                                                    ?>
                                                    <div class="column">
                                                        <div class="ui fluid image">
                                                            <a class="ui left corner label">
                                                                <i class="heart icon"></i>
                                                            </a>
                                                            <img src="<?php echo $img["code"]; ?>" class="card-img-top pbox mt-3">
                                                        </div>
                                                    </div>

                                                    <div class="card-body ms-0 m-0">
                                                        <h5 class="card-title"><?php echo $product["title"]; ?></h5>
                                                        <span class="card-text text-primary"><?php echo $product["price"]; ?></span>
                                                        <br />
                                                        <?php
                                                        if ($product["qty"] > 0) {
                                                        ?>
                                                            <span class="card-text text-warning "><b>In Stock</b></span>
                                                            <br />
                                                            <span class="card-text text-dark fw-bold"><?php echo $product["qty"]; ?> Item In Available</span>
                                                            <a href='<?php echo "singleProductView.php?id=" . ($product["id"]) ?>' class="btn btn-primary col-6">Buy Now</a><a href="#" class="btn btn-success col-6" onclick="addToCart(<?php echo $product['id']; ?>);">Add to cart</a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="card-text text-danger "><b>Out Of Stock</b></span>
                                                            <br />
                                                            <span class="card-text text-darkr fw-bold"><?php echo $product["qty"]; ?> Item In Available</span>
                                                            <a href="#" class="btn btn-primary col-6 disabled">Buy Now</a><a href="#" class="btn btn-success col-6 mt-1 disabled">Add to cart</a>


                                                            <?php

                                                        }

                                                        if (isset($_SESSION["u"])) {

                                                            $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product["id"] . "' AND `user_email`='" . $_SESSION["u"]["email"] . "'");

                                                            if ($watchrs->num_rows == 1) {
                                                            ?>
                                                                <a onclick='addToWatchlist(<?php echo $product["id"]; ?>);' class="btn btn-secondary col-12 mt-1"> <i class="bi bi-heart-fill fs-5" style="color: cornflowerblue;" id="heart<?php echo $product["id"]; ?>"></i></a>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a onclick='addToWatchlist(<?php echo $product["id"]; ?>);' class="btn btn-secondary col-12 mt-1"> <i class="bi bi-heart-fill fs-5" style="color: white;" id="heart<?php echo $product["id"]; ?>"></i></a>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>


                                                            <a onclick='addToWatchlist(<?php echo $product["id"]; ?>);' class="btn btn-secondary col-12 mt-1"> <i class="bi bi-heart-fill fs-5" style="color: white;" id="heart<?php echo $product["id"]; ?>"></i></a>
                                                        <?php

                                                        }
                                                        ?>


                                                    </div>
                                                </div>

                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- produts -->

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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        // Get the video
        var video = document.getElementById("myVideo");

        // Get the button
        var btn = document.getElementById("myBtn");

        // Pause and play the video, and change the button text
        function myFunction() {
            if (video.paused) {
                video.play();
                btn.innerHTML = "Pause";
            } else {
                video.pause();
                btn.innerHTML = "Play";
            }
        }
    </script>

</body>

</html>