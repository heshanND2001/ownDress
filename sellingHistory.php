<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Own Dress | Selling History</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="hb1" style="min-height: 100vh;">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center mb-3">
                <label class="form-label fs-1 fw-bold text-primary">Selling History</label>
            </div>

            <div class="col-12 bg-white mt-3 mb-3">
                <div class="row">

                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5">Search by Invoice ID : </label>
                        <input type="text" class="form-control fs-5" placeholder="Invoice ID...">
                    </div>
                    <div class="col-12 col-lg-2 mt-3 mb-3"></div>
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5">From Date : </label>
                        <input type="date" class="form-control fs-5" />
                    </div>
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5">To Date : </label>
                        <input type="date" class="form-control fs-5" />
                    </div>
                    <div class="col-12 col-lg-1 mt-3 mb-3 d-grid">
                        <button class="btn btn-primary fw-bold fs-5">Find</button>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <div class="row">

                    <div class="col-1 bg-secondary text-end">
                        <label class="form-label fs-5 fw-bold text-white">Invoice ID</label>
                    </div>
                    <div class="col-3 bg-body text-end">
                        <label class="form-label fs-5 fw-bold text-black">Product</label>
                    </div>
                    <div class="col-3 bg-secondary text-end">
                        <label class="form-label fs-5 fw-bold text-white">Buyer</label>
                    </div>
                    <div class="col-2 bg-body text-end">
                        <label class="form-label fs-5 fw-bold text-black">Amount</label>
                    </div>
                    <div class="col-1 bg-secondary text-end">
                        <label class="form-label fs-5 fw-bold text-white">Quantity</label>
                    </div>
                    <div class="col-2 bg-white"></div>

                </div>
            </div>

            <?php

            $page_no;

            if (isset($_GET["page"])) {
                $page_no = $_GET["page"];
            } else {
                $page_no = 1;
            }

            $product_rs = Database::search("SELECT * FROM `invoice`");
            $product_num = $product_rs->num_rows;
            $results_per_page = 8;
            $number_of_pages = ceil($product_num / $results_per_page);
            $page_first_result = ((int)$page_no - 1) * $results_per_page;
            $view_product_rs = Database::search("SELECT * FROM `invoice` LIMIT " . $results_per_page . " OFFSET " . $page_first_result);
            $view_results_num = $view_product_rs->num_rows;

            $c = 0;

            ?>

            <?php

            while ($product_data = $view_product_rs->fetch_assoc()) {
                $c += 1;
            ?>

                <div class="col-12 mt-1">
                    <div class="row">
                        <div class="col-12" id="loadResults">
                            <div class="row" id="box">

                                <div class="col-1 bg-secondary text-end">
                                    <label class="form-label fs-5 fw-bold text-white"><?php echo $product_data["order_id"]; ?></label>
                                </div>
                                <div class="col-3 bg-body text-end">
                                    <?php

                                    $prode = Database::search("SELECT * FROM `product` WHERE `id` = '" . $product_data["product_id"] . "'");
                                    $pro_data = $prode->fetch_assoc();

                                    ?>
                                    <label class="form-label fs-5 fw-bold text-black"><?php echo $pro_data["title"]; ?></label>
                                </div>
                                <div class="col-3 bg-secondary text-end">
                                    <?php

                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $product_data["user_email"] . "'");
                                    $user_data = $user_rs->fetch_assoc();

                                    ?>
                                    <label class="form-label fs-5 fw-bold text-white"><?php echo $user_data["fname"]; ?></label>
                                </div>
                                <div class="col-2 bg-body text-end">
                                    <label class="form-label fs-5 fw-bold text-black"><?php echo $product_data["total"]; ?></label>
                                </div>
                                <div class="col-1 bg-secondary text-end">
                                    <label class="form-label fs-5 fw-bold text-white"><?php echo $product_data["qty"]; ?></label>
                                </div>
                                <div class="col-2 bg-white d-grid">
                                    <button class="btn btn-success mb-2 mt-2 fw-bold">Confirm Order</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }

            ?>

            <!-- Pagination -->
            <div class="col-12 text-center d-flex justify-content-center align-items-center p-3">
                <div class="pagination">
                    <a href="<?php if ($page_no <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no - 1);
                                } ?>">&laquo;</a>

                    <?php

                    for ($page = 1; $page <= $number_of_pages; $page++) {

                        if ($page == $page_no) {
                    ?>
                            <a href="<?php echo "?page=" . ($page); ?>" class="active"><?php echo $page; ?></a>
                        <?php
                        } else {
                        ?>
                            <a href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                    <?php
                        }
                    }

                    ?>
                    <a href="<?php if ($page_no >= $number_of_pages) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no + 1);
                                } ?>">&raquo;</a>
                </div>
            </div>
            <!-- Pagination -->




        </div>
    </div>

    <script src="script.js"></script>
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