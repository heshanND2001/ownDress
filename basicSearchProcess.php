<?php

// echo "Hello..";
require "connection.php";

$sText = $_POST["st"];
$sSelect = $_POST["ss"];

// echo $sText;
// echo $sSelect;
$query = "SELECT * FROM `product` ";

$status = 0;

if ($status == 0) {

    if (!empty($sText) && $sSelect == "0") {

        $query .= "WHERE `title` LIKE '%" . $sText . "%'";
        $status = 1;
    } else if (empty($sText) && $sSelect != "0") {

        $query .= "WHERE `category`='" . $sSelect . "'";
        $status = 1;
    } else if (!empty($sText) && $sSelect != "0") {

        $query .= "WHERE `title` LIKE '%" . $sText . "%' AND `category`='" . $sSelect . "'";
        $status = 1;
    }
} else if ($status == 1) {
    if (!empty($sText) && $sSelect == "0") {

        $query .= " AND `title` LIKE '%" . $sText . "%'";
        $status = 1;
    } else if (empty($sText) && $sSelect != "0") {

        $query .= " AND `category`='" . $sSelect . "'";
        $status = 1;
    }
}

$query1 = $query;

?>

<div class="row">
    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

            <?php

            if ("0" != ($_POST["page"])) {

                $pageno = $_POST["page"];
            } else {

                $pageno = 1;
            }

            $products = Database::search($query);
            $nProducts = $products->num_rows; //total results
            $userProducts = $products->fetch_assoc();

            $results_Per_page = 6;
            $number_of_Pages = ceil($nProducts / $results_Per_page);

            $viewed_result_count = ((int)$pageno - 1) * $results_Per_page;
            $query1 .= "LIMIT " . $results_Per_page . " OFFSET " . $viewed_result_count . " ";
            $selectedrs = Database::search($query1);
            $srn = $selectedrs->num_rows;

            while ($ps = $selectedrs->fetch_assoc()) {

            ?>

                <div class="card mb-3 mt-3 col-12 col-lg-3 boxshd" style="width: 14rem;">
                    <div class="row">
                        <div class="col-md-12 mt-4">

                            <?php

                            $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $ps["id"] . "'");
                            $pir = $pimgrs->fetch_assoc();

                            ?>
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid card-img-top rounded-start">
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $ps["title"]; ?></h5>
                                <span class="card-text text-primary fw-bold">Rs. <?php echo $ps["price"]; ?> .00</span>
                                <br />
                                <span class="card-text text-success fw-bold"><?php echo $ps["qty"]; ?> Items Left</span>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="row g-1">
                                            <div class="col-12 col-lg-6 d-grid">
                                                <a href="#" class="btn btn-success">BuyNow</a>
                                            </div>
                                            <div class="col-12 col-lg-6 d-grid">
                                                <a href="#" class="btn btn-danger">Add Card</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                    ?> onclick="basicSearch('<?php echo ($pageno - 1); ?>');" <?php

                                                                            } ?>>&laquo;</a>

                <?php

                for ($page = 1; $page <= $number_of_Pages; $page++) {

                    if ($page == $pageno) {
                ?>
                        <a onclick="basicSearch('<?php echo $page; ?>');" class="active"><?php echo $page; ?></a>
                    <?php
                    } else {
                    ?>
                        <a onclick="basicSearch('<?php echo $page; ?>');"><?php echo $page; ?></a>
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

                    ?> onclick="basicSearch('<?php echo ($pageno + 1); ?>');" <?php

                                                                            } ?>>&raquo;</a>
            </div>
        </div>
    </div>

</div>

<?php



?>