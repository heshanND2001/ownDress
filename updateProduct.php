<?php

require "connection.php";

session_start();

$product = $_SESSION["p"];

if (isset($product)) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Own Dress | Update Product~</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo_free-file.png" />
        <link rel="stylesheet" href="animate.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="hb1">
        <div class="container-fluid justify-content-center">
            <div class="row">
                <div class="col-12">
                    <div class="col-12 mb-2 mt-3">
                        <h3 class="h2 text-center text-primary">Product update</h3>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="col-9 offset-3">
                                <label class="form-label lbl1 text-info">Add Product Image</label>
                            </div>
                            <div class="col-10 offset-2">
                                <?php
                                $rs6 = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'  ");
                                $n6 = $rs6->num_rows;
                                $imge = $rs6->fetch_assoc();
                                if ($n6 == 1) {
                                ?>
                                    <img src="<?php echo $imge["code"]; ?>" class="col-10 col-lg-8 ms-2 mt-2 img-thumbnail border-primary" id="prev" />
                                <?php
                                } else {
                                ?>
                                    <img src="resources/addproductimg.svg" class="col-10 col-lg-8 ms-2 mt-2 img-thumbnail border-primary" id="prev" />
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-12 col-lg-10 mt-3 text-center">
                                <input type="file" class="d-none" accept="img/*" id="imageUploader" />
                                <label for="imageUploader" class="col-5 col-lg-4 btn btn-primary" onclick="changeProductImg();">Upload</label>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1 text-info">Product Description</label>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" cols="100" rows="10" id="desc" placeholder="enter the details your product dress" ><?php echo $product["description"] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 mt-3">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="col-12">
                                        <label class="form-lable lbl1 text-info">Select Product Category</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="ca" disabled>
                                            <option value="0">Select Category</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM `category`");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $d = $rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>

                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="col-12">
                                        <label class="form-lable lbl1 text-info">Enter Your Shop Name</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <?php

                                        // $pd = Database::search("SELECT * FROM `user`");
                                        // $sn = $pd->fetch_assoc();



                                        if (isset($_SESSION["u"])) {

                                            $data = $_SESSION["u"];

                                        ?>
                                            <input class="form-control" type="text" id="psn" value="<?php echo $data["shop_name"]; ?>" disabled />
                                        <?php

                                        } else {
                                        ?>

                                            <input class="form-control" type="text" placeholder="Update Your Shop name First." disabled />
                                        <?php
                                        }


                                        ?>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="col-12">
                                        <label class="form-lable lbl1 text-info">Add a Title to your Product</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <input class="form-control" type="text" id="ti" value="<?php echo $product["title"]; ?>" />
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="col-12">
                                        <label class="form-lable lbl1 text-info">Add a Product Colour</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <input class="form-control" type="text" disabled id="cl" placeholder="Dress Colour" value="<?php echo $product["color"]; ?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="col-12">
                                        <label class="form-lable lbl1 text-info">Add Product Quantity</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <input class="form-control" type="number" value="<?php echo $product["qty"] ?>" min="0" id="qty" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="col-12">
                                        <label class="form-lable lbl1 text-info">Cost per Item</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["price"] ?>" id="cost">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="col-12">
                                        <label class="form-lable lbl1 text-info">Approved Payment Methods</label>
                                    </div>

                                    <div class="col-12 mb-3 rounded" style="background-color: white;">
                                        <div class="row">
                                            <div class="offset-2 col-2 pm1"></div>
                                            <div class="col-2 pm2"></div>
                                            <div class="col-2 pm3"></div>
                                            <div class="col-2 pm4"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="col-12">
                                        <label class="form-lable lbl1 text-info">Delivery Costs Within Colombo</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_colombo"] ?>" id="dwc">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="col-12">
                                        <label class="form-lable lbl1 text-info">Delivery Costs Outof Colombo</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_other"] ?>" id="doc">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 offset-lg-4 d-grid mb-2 mt-4">
                                    <button class="btn btn-primary search-btn mt-1" onclick="pudateProduct();">Update Product</button>
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
    </body>

    </html>

<?php
} else {

?>

    <script>
        alert("You have to Sign In or Register First.");
        window.location = "index.php";
    </script>

<?php
}

?>