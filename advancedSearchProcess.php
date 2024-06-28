<?php

// echo "Hello";

require "connection.php";

$search_txt = $_POST["s"];
$category = $_POST["ca"];
$shopN = $_POST["shn"];
$colour = $_POST["c1"];
$price_from = $_POST["p1"];
$price_to = $_POST["p2"];
$sort = $_POST["sort"];

// echo $search_txt;
// echo "<br/>";
// echo $category;
// echo "<br/>";
// echo $shopN;
// echo "<br/>";
// echo $colour;
// echo "<br/>";
// echo $price_from;
// echo "<br/>";
// echo $price_to;
// echo "<br/>";
// echo $sort;

$query = "SELECT * FROM `product`";
$status = 0;
if (!empty($search_txt)) {

    $query .= "WHERE `title` LIKE '%" . $search_txt . "%'";
    $status = 1;
}

// echo $query;

if ($category != "0" && $status == 0) {

    $query .= "WHERE `category`='" . $category . "'";
    $status = 1;
} else if ($category != "0" && $status == 1) {

    $query .= "AND `category`='" . $category . "'";
}

$status2 = 0;

if ($shopN != "0" && $status == 0) {
    $query .= "WHERE `pro_shop_name_id`='" . $shopN . "'";
    $status = 1;
}else if ($shopN != "0" && $status == 1) {

    $query .= "AND `pro_shop_name_id`='" . $shopN . "'";
}

if (!empty($colour) && $status == 0) {

    $query .= "WHERE `color` LIKE '%" . $colour . "%'";
    $status = 1;
}else if (!empty($colour) && $status == 1) {

    $query .= "AND `color` LIKE '%" . $colour . "%'";
}

if ($status == 0) {
    if (!empty($price_from) && empty($price_to)) {

        $query .= "WHERE `price` >= '" . $price_from . "'";
        $status = 1;
    } else if (empty($price_from) && !empty($price_to)) {

        $query .= "WHERE `price` <= '" . $price_from . "'";
        $status = 1;
    } else if (!empty($price_from) && !empty($price_to)) {

        $query .= "WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        $status = 1;
    }
} else if ($status == 1) {
    if (!empty($price_from) && empty($price_to)) {

        $query .= " AND `price` >= '" . $price_from . "'";
        $status = 1;
    } else if (empty($price_from) && !empty($price_to)) {

        $query .= " AND `price` <= '" . $price_from . "'";
        $status = 1;
    } else if (!empty($price_from) && !empty($price_to)) {

        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        $status = 1;
    }
}

if ($sort == 1) {
    $query .= " ORDER BY `price` ASC ";
} else if ($sort == 2) {
    $query .= " ORDER BY `price` DESC ";
} else if ($sort == 3) {
    $query .= " ORDER BY `qty` ASC ";
} else if ($sort == 4) {
    $query .= " ORDER BY `qty` DESC ";
}

$query1 = $query;

// echo $query1;

?>

<div class="row">
    <div class="offset-0 col-12 text-center">
        <div class="row">

            <?php

            if ("0" != ($_POST["page"])) {

                $pageno = $_POST["page"];
            } else {

                $pageno = 1;
            }

            $products = Database::search($query);
            // echo $query;
            $nProducts = $products->num_rows; //total results
            $userProducts = $products->fetch_assoc();

            $results_Per_page = 4;
            $number_of_Pages = ceil($nProducts / $results_Per_page);

            $viewed_result_count = ((int)$pageno - 1) * $results_Per_page;
            $query1 .= "LIMIT " . $results_Per_page . " OFFSET " . $viewed_result_count . " ";
            $selectedrs = Database::search($query1);
            $srn = $selectedrs->num_rows;

            while ($ps = $selectedrs->fetch_assoc()) {

            ?>

                <div class="card col-6 col-lg-12 mt-2 mb-2" style="width: 14rem; background-color: #e3f2fd;margin-left: 20px;" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
                    <?php
                    $pimage = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $ps["id"] . "' ");
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
                        <h5 class="card-title"><?php echo $ps["title"]; ?></h5>
                        <span class="card-text text-primary"><?php echo $ps["price"]; ?></span>
                        <br />
                        <?php
                        if ($ps["qty"] > 0) {
                        ?>
                            <span class="card-text text-warning "><b>In Stock</b></span>
                            <br />
                            <span class="card-text text-dark fw-bold"><?php echo $ps["qty"]; ?> Item In Available</span>
                            <a href='<?php echo "singleProductView.php?id=" . ($ps["id"]) ?>' class="btn btn-primary col-6">Buy Now</a><a href="#" class="btn btn-success col-6" onclick="addToCart(<?php echo $ps['id']; ?>);">Add to cart</a>
                        <?php
                        } else {
                        ?>
                            <span class="card-text text-danger "><b>Out Of Stock</b></span>
                            <br />
                            <span class="card-text text-darkr fw-bold"><?php echo $ps["qty"]; ?> Item In Available</span>
                            <a href="#" class="btn btn-primary col-6 disabled">Buy Now</a><a href="#" class="btn btn-success col-6 mt-1 disabled">Add to cart</a>


                            <?php

                        }

                        if (isset($_SESSION["u"])) {

                            $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $ps["id"] . "' AND `user_email`='" . $_SESSION["u"]["email"] . "'");

                            if ($watchrs->num_rows == 1) {
                            ?>
                                <a onclick='addToWatchlist(<?php echo $ps["id"]; ?>);' class="btn btn-secondary col-12 mt-1"> <i class="bi bi-heart-fill fs-5" style="color: cornflowerblue;" id="heart<?php echo $ps["id"]; ?>"></i></a>
                            <?php
                            } else {
                            ?>
                                <a onclick='addToWatchlist(<?php echo $ps["id"]; ?>);' class="btn btn-secondary col-12 mt-1"> <i class="bi bi-heart-fill fs-5" style="color: white;" id="heart<?php echo $ps["id"]; ?>"></i></a>
                            <?php
                            }
                        } else {
                            ?>


                            <a onclick='addToWatchlist(<?php echo $ps["id"]; ?>);' class="btn btn-secondary col-12 mt-1"> <i class="bi bi-heart-fill fs-5" style="color: white;" id="heart<?php echo $ps["id"]; ?>"></i></a>
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

    <div class="offset-0 offset-lg-4 col-12 col-lg-4 mb-3">
        <div class="row">
            <div class="pagination">
                <a <?php if ($pageno <= 1) {
                        echo "#";
                    } else {

                    ?> onclick="advancedSearch('<?php echo ($pageno - 1); ?>');" <?php

                                                                                } ?>>&laquo;</a>

                <?php

                for ($page = 1; $page <= $number_of_Pages; $page++) {

                    if ($page == $pageno) {
                ?>
                        <a onclick="advancedSearch('<?php echo $page; ?>');" class="active"><?php echo $page; ?></a>
                    <?php
                    } else {
                    ?>
                        <a onclick="advancedSearch('<?php echo $page; ?>');"><?php echo $page; ?></a>
                <?php
                    }
                }

                ?>

                <!-- <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a> -->

                <a <?php if ($pageno >= $number_of_Pages) {
                        echo "#";
                    } else {

                    ?> onclick="advancedSearch('<?php echo ($pageno + 1); ?>');" <?php

                                                                                } ?>>&raquo;</a>
            </div>
        </div>
    </div>

</div>

<?php



?>