<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Own Dress | Admin | Users</title>

    <link rel="icon" href="resources/logo_free-file.png" />
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="hb1">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <h2 class="text-primary fw-bold">Manage All Users</h2>
            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning">Search User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Profile Image</span>
                    </div>
                    <div class="col-3 col-lg-2 bg-primary py-2">
                        <span class="fs-4 fw-bold text-white">User Name</span>
                    </div>
                    <div class="col-3 col-lg-2 bg-light py-2 d-lg-block">
                        <span class="fs-4 fw-bold">Email</span>
                    </div>
                    <div class="col-2 bg-primary py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Mobile</span>
                    </div>
                    <div class="col-3 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-4 col-lg-1 bg-white"></div>
                </div>
            </div>

            <?php

            $page_no;

            if (isset($_GET["page"])) {
                $page_no = $_GET["page"];
            } else {
                $page_no = 1;
            }

            $product_rs = Database::search("SELECT * FROM `user`");
            $product_num = $product_rs->num_rows;
            $results_per_page = 10;
            $number_of_pages = ceil($product_num / $results_per_page);
            $page_first_result = ((int)$page_no - 1) * $results_per_page;
            $view_product_rs = Database::search("SELECT * FROM `user` LIMIT " . $results_per_page . " OFFSET " . $page_first_result);
            $view_results_num = $view_product_rs->num_rows;

            $c = 0;

            ?>

            <?php

            while ($product_data = $view_product_rs->fetch_assoc()) {
                $c += 1;
            ?>

                <div class="col-12 mb-3 boxshd1">
                    <div class="row">

                        <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                            <span class="fs-6 fw-bold text-white">*</span>
                        </div>
                        <?php

                        $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $product_data["email"] . "'");
                        $image_data = $image_rs->fetch_assoc();

                        ?>
                        <div class="col-2 col-lg-2 bg-light py-2 d-none d-lg-block" onclick="viewmsgmodel();">
                            <img src="<?php echo $image_data["code"]; ?>" style="height: 40px; margin-left: 80px;">
                        </div>
                        <div class="col-4 col-lg-2 bg-primary py-2">
                            <span class="fs-6 fw-bold text-white"><?php echo $product_data["fname"]; ?></span>
                        </div>
                        <div class="col-4 col-lg-2 bg-light py-2 d-lg-block">
                            <span class="fs-6 fw-bold"><?php echo $product_data["email"]; ?></span>
                        </div>
                        <div class="col-2 bg-primary py-2 d-none d-lg-block">
                            <span class="fs-6 fw-bold text-white"><?php echo $product_data["mobile"]; ?></span>
                        </div>
                        <div class="col-2 bg-light py-2 d-none d-lg-block">
                            <span class="fs-6 fw-bold"><?php $row = $product_data["register_date"];
                                                        $splitted = explode(" ", $row);
                                                        echo $splitted[0]; ?></span>
                        </div>
                        <div class="col-2 col-lg-1 bg-white py-2 d-grid">
                            <button class="btn btn-danger">Block</button>
                        </div>

                    </div>
                </div>

            <?php
            }

            ?>

            <!-- model -->

            <div class="modal" tabindex="-1" id="viewmsgmodel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">My Messages</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- receved -->

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-8 rounded bg-success">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="text-white fs-4">Hello there!!!</span>
                                            </div>
                                            <div class="col-12 text-end pb-2">
                                                <span class="text-white fs-6">2022-06-11 | 08:00:00</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-12 mt-2">
                                <div class="row">

                                    <div class="col-8 rounded bg-primary">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="text-white fs-4">How are you!!!</span>
                                            </div>
                                            <div class="col-12 text-end pb-2">
                                                <span class="text-white fs-6">2022-06-11 | 08:05:00</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- receved -->
                        </div>
                        <div class="modal-footer">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-8">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-4 d-grid">
                                        <button class="btn btn-primary">Send</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- model -->

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
    <script src="bootstrap.js"></script>
</body>

</html>