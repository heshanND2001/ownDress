<?php

require "connection.php";

if (isset($_GET["id"])) {
    $p_id = $_GET["id"];

    $productrs = Database::search("SELECT * FROM viva.product WHERE id='" . $p_id . "'");

    $pn = $productrs->num_rows;

    if ($pn == 1) {
        $pd = $productrs->fetch_assoc();
    }
    // 
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Own Dress Product View</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css">

        <link rel="icon" href="resources/logo_free-file.png" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

    </head>

    <body  class="hb1">
        <div class="container-fluid">
            <div class="row">
                <?php

                require "header.php";

                ?>

                <hr class="hr-break-1" />

                <div class="col-12 mt-0 singleproduct">
                    <div class="row">

                        <div class="col-5">
                            <div class="row">

                                <div class="col-lg-9 offset-2 order-2 order-lg-1 d-none d-lg-block">
                                    <div class="align-items-center border border-1 border-secondary">

                                        <?php

                                        $title = $pd["title"];
                                        $imagers = Database::search("SELECT * FROM images INNER JOIN product ON product.id = images.product_id WHERE product.title = '" . $title . "'");

                                        $in = $imagers->num_rows;
                                        $img;
                                        $d = $imagers->fetch_assoc();
                                        $img = $d["code"];

                                        if (!empty($in)) {
                                        ?>

                                            <div style="background: url('<?php echo $img; ?>') no-repeat center; background-size: contain; height: 382px;" id="mainimg"></div>
                                        <?php
                                        } else { ?>

                                            <div style="background: url('resources/empty.svg') no-repeat center; background-size: contain; height: 482px;"></div>
                                        <?php
                                        }
                                        ?>


                                        <!-- <div style="background-image: url('resources/mobile images/iphone12.jpg'); background-repeat: no-repeat; background-size: contain; height: 480px;"></div> -->

                                    </div>
                                </div>

                                <div class="col-lg-4 offset-2 order-lg-1 order-2 mt-2">

                                    <ul>
                                        <?php


                                        if (!empty($in)) {
                                            for ($x = 0; $x < $in; $x++) {

                                        ?>

                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="<?php echo $img; ?>" height="150px" class="mt-1 mb-1" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);">
                                                </li>
                                            <?php
                                            }
                                        } else {
                                            ?>

                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                <img src="resources/empty.svg" height="150px" class="mt-1 mb-1">
                                            </li>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                <img src="resources/empty.svg" height="150px" class="mt-1 mb-1">
                                            </li>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="resources/empty.svg" height="150px" class="mt-1 mb-1">
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6 order-3">
                            <div class="row">
                                <div class="col-12">

                                    <nav>
                                        <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                            <li class="breadcrumb-item">
                                                <a href="home.php">Home</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="#" class="text-decoration-none text-black-50 fw-bold">Single Product View</a>
                                            </li>
                                        </ol>
                                    </nav>

                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <span class="badge">
                                            <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                            <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                            <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                            <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                            <i class="fa fa-star-half mt-1 text-warning fs-6"></i>&nbsp;&nbsp;&nbsp;

                                            <label class="text-dark fs-6">4.5 Stars</label>
                                            <label class="text-dark fs-6">35 | 35 Ratings & Reviews</label>
                                        </span>
                                    </div>

                                    <div class="col-12 d-inline-block">
                                        <label class="fw-bold fs-4 mt-1">Rs: <?php echo $pd["price"]; ?>.00</label>&nbsp;&nbsp;&nbsp;
                                        <label class="fw-bold fs-6 mt-1 text-danger"><del>Rs:<?php $n = ($pd["price"] / 100) * 105;
                                                                                                echo $n; ?>.00</del></label>
                                    </div>

                                    <hr class="hr-break-1" />

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-6 mt-5">
                                                <label class="text-primary fs-6 fw-bold">Warrenty : 06 months warrenty</label><br>
                                                <label class="text-primary fs-6"><b>Return Policy : </b> 01 months return policy</label><br>
                                                <label class="text-primary fs-6"><b class="text-success">In Stock : </b> <?php echo $pd["qty"]; ?> items left</label>
                                            </div>
                                            <div class="col-6">
                                                <?php
                                                $userrs = Database::search("SELECT * FROM user WHERE `email` = '" . $pd["user_email"] . "'");
                                                $userd = $userrs->fetch_assoc();
                                                ?>

                                                <label class="text-dark fs-3 fw-bold">Seller's Details</label><br>
                                                <label class="text-success fs-6 fw-bold">Seller's Name : <?php echo $userd["fname"]; ?> <?php echo $userd["lname"]; ?></label><br>
                                                <label class="text-success fs-6 fw-bold">Seller's Email : <?php echo $userd["email"]; ?></label><br>
                                                <label class="text-success fs-6 fw-bold">Seller's Mobile : <?php echo $userd["mobile"]; ?></label><br>
                                            </div>

                                        </div>

                                    </div>

                                    <hr class="hr-break-1" />

                                    <div class="col-12">


                                    </div>

                                    <hr class="hr-break-1" />

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-12" style="margin-top: 15px;">
                                                <div class="row">

                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label class="form-label lbl1 text-info">Product Description</label>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <textarea class="form-control" cols="100" rows="5" id="desc"><?php echo $pd["description"]; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-6 mt-5">
                                                        <div class="row">
                                                            <div class="border border-1 border-secondary rounded overflow-hidden float-start mt-1 position-relative product_qty">
                                                                <div class="col-12">
                                                                    <span>Qty : </span>
                                                                    <input id="qtyinput" type="text" class="border-0 fs-6 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" onkeyup='check_val(<?php echo $pd["qty"]; ?>);' />
                                                                    <div class="position-absolute qty_buttons">
                                                                        <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_inc">
                                                                            <i class="fas fa-chevron-up" onclick='qty_inc(<?php echo $pd["qty"]; ?>);'></i>
                                                                        </div>

                                                                        <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_dec">
                                                                            <i class="fas fa-chevron-down" onclick='qty_dec();'></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mt-3">
                                                                <div class="row">

                                                                    <div class="col-4 col-lg-5 d-grid">
                                                                        <button class="btn btn-primary" onclick='addToCart(<?php echo $p_id; ?>);'>Add to Cart</button>
                                                                    </div>
                                                                    <div class="col-4 col-lg-5 d-grid">
                                                                        <button class="btn btn-success" type="submit" id="payhere-payment" onclick="payNow(<?php echo $p_id; ?>);">Buy Now</button>
                                                                    </div>
                                                                    <div class="col-4 col-lg-2 d-grid">
                                                                    <a onclick='addToWatchlist(<?php echo $p_id; ?>);' class="btn btn-secondary col-12 mt-1"> <i class="bi bi-heart-fill fs-5" style="color: white;" id="heart<?php echo $p_id; ?>"></i></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
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
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>

<?php
} else {
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
?>