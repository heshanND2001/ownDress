<?php

session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Own Dress | Admin Panel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="resources/logo_free-file.png" />
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', '%'],
                    ['Shorts', 11],
                    ['Shirts', 2],
                    ['Denim', 2],
                    ['Skirts', 2],
                    ['TShirts', 7]
                ]);

                var options = {
                    title: 'My Daily selling'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
        </script>

    </head>

    <body class="hb1">

        <div class="container-fluid">
            <div class="row" id="mainrow">

                <div class="col-12 bg-dark">
                    <div class="row">

                        <div class="col-12 col-lg-2 text-center mt-3 mb-3">
                            <label class="form-label fs-5 fw-bold text-white">Total Active Time</label>
                        </div>

                        <?php

                        $start_date = new DateTime("2021-06-01 00:00:00");

                        $tdate = new DateTime();
                        $tz = new DateTimeZone("Asia/Colombo");
                        $tdate->setTimezone($tz);

                        $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                        $difference = $end_date->diff($start_date);

                        ?>

                        <div class="col-12 col-lg-10 text-end mt-3 mb-3">
                            <label class="form-label fs-5 fw-bold text-white boxshd">
                                <?php

                                echo $difference->format('%Y') . " Year " . $difference->format('%m') . " Months " .
                                    $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " . $difference->format('%i') . " Minutes " .
                                    $difference->format('%s') . " Seconds ";

                                ?>
                            </label>
                        </div>

                    </div>
                </div>

                <div class="col-12 mt-2">
                    <div class="row">

                        <div class="align-items-lg-start bg-dark col-12 col-lg-3">
                            <div class="row g-1 text-center">

                                <div class="col-12 mt-5">
                                    <h4 class="text-white"><?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"] ?></h4>
                                    <hr class="border border-1 border-white" />
                                </div>

                                <div class="col-12 nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                    <nav class="nav flex-column">
                                        <a class="nav-link active fs-5" aria-current="page" href="#">Dashboard</a>
                                        <a class="nav-link fs-5" href="manageusers.php">Manage Users</a>
                                        <a class="nav-link fs-5" href="manageproducts.php">Manage Products</a>
                                    </nav>
                                </div>


                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div id="piechart" style="width: 900px; height: 450px;"></div>
                            </div>
                        </div>

                        <div class="align-items-lg-start bg-dark col-12 col-lg-3">
                            <div class="row g-1 text-center">

                                <div class="col-12 mt-3">
                                    <hr class="border border-1 border-white" />
                                    <h4 class="text-white">Selling History</h4>
                                    <hr class="border border-1 border-white" />
                                </div>

                                <div class="col-12 mt-3 d-grid">
                                    <h5 class="text-white fw-bold">From Date</h5>
                                    <input type="date" class="form-control">
                                    <h5 class="text-white mt-2 fw-bold">To Date</h5>
                                    <input type="date" class="form-control">
                                    <a href="#" class="btn btn-primary fw-bold mt-2">View Selling</a>
                                    <hr class="border border-1 border-white" />
                                    <hr class="border border-1 border-white" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="row">

                        <div class="col-12 text-white fw-bold mb-3 text-center">
                            <h2 class="fw-bold">Dashboard</h2>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12">
                            <div class="row g-1">

                                <div class="col-6 col-lg-4 px-1 boxshd">
                                    <div class="row g-1">

                                        <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily Ernings</span>
                                            <br />
                                            <?php

                                            $today = date("Y-m-d");
                                            $this_month = date("m");
                                            $this_year = date("Y");

                                            // echo $today;
                                            // echo ",";
                                            // echo $this_month;
                                            // echo ",";
                                            // echo $this_year;

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $d = "0";
                                            $e = "0";

                                            $invoice_rs = Database::search("SELECT * FROM invoice");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                $e = $e + $invoice_data["qty"];

                                                $f = $invoice_data["date"];
                                                $split_date = explode(" ", $f);
                                                $pdate = $split_date[0];

                                                // echo $pdate;

                                                if ($pdate == $today) {
                                                    $a = $a + $invoice_data["total"];
                                                    $c = $c + $invoice_data["qty"];
                                                }

                                                $split_result = explode("-", $pdate);
                                                $pyear = $split_result[0];
                                                $pmonth = $split_result[1];

                                                if ($pyear == $this_year) {
                                                    if ($pmonth == $this_month) {
                                                        $b = $b + $invoice_data["total"];
                                                        $d = $d + $invoice_data["qty"];
                                                    }
                                                }
                                            }

                                            ?>
                                            <span class="fs-5">Rs. <?php echo $a; ?> .00</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1 boxshd">
                                    <div class="row g-1">

                                        <div class="col-12 bg-light text-dark text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Ernings</span>
                                            <br />
                                            <span class="fs-5">Rs. <?php echo $b; ?> .00</span>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-6 col-lg-4 px-1 boxshd">
                                    <div class="row g-1">

                                        <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Selling</span>
                                            <br />
                                            <span class="fs-5"><?php echo $e; ?> Items</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1 boxshd">
                                    <div class="row g-1">

                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Selling</span>
                                            <br />

                                            <span class="fs-5"><?php echo $d; ?> Items</span>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-6 col-lg-4 px-1 boxshd">
                                    <div class="row g-1">

                                        <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Selling</span>
                                            <br />
                                            <span class="fs-5"><?php echo $e; ?> Items</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1 boxshd">
                                    <div class="row g-1">

                                        <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Engagements</span>
                                            <br />

                                            <?php

                                            $user_rs = Database::search("SELECT * FROM `user`");
                                            $user_num = $user_rs->num_rows;

                                            ?>

                                            <span class="fs-5"><?php echo $user_num; ?> Requests</span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>



                        <div class="offset-2 col-10 col-lg-3 mt-3 mb-3 rounded boxshd" style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">
                            <div class="row">

                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold">Mostly Sold Item</label>
                                </div>

                                <?php

                                $freq_rs = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurence` FROM `invoice`
                                WHERE `date` GROUP BY `product_id` ORDER BY `value_occurence` DESC LIMIT 1");

                                // $freq_rs = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurence` FROM `invoice`
                                // WHERE `date` LIKE '&" . $today . "&' GROUP BY `product_id` ORDER BY `value_occurence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;

                                if ($freq_num > 0) {

                                    $freq_date = $freq_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `images` ON product.id=images.product_id WHERE `id`='" . $freq_date["product_id"] . "'");

                                    $product_data = $product_rs->fetch_assoc();

                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS total FROM `invoice` WHERE `product_id`='" . $freq_date["product_id"] . "'");

                                    // $qty_rs = Database::search("SELECT SUM(`qty`) AS total FROM `invoice` WHERE `product_id`='" . $freq_date["product_id"] . "'
                                    // AND `date` LIKE '&" . $otday . "&'");

                                    $qty_date = $qty_rs->fetch_assoc();
                                }

                                ?>

                                <div class="col-12 text-center">
                                    <img src="<?php echo $product_data["code"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                    <hr />
                                </div>

                                <div class="col-12 text-center">
                                    <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span><br>
                                    <span class="fs-6"><?php echo $qty_date["total"]; ?> Items</span><br>
                                    <span class="fs-6">RS. <?php echo $product_data["price"]; ?> .00</span>
                                </div>

                                <div class="col-12 mb-2">
                                    <div class="first_plase"></div>
                                </div>

                            </div>
                        </div>

                        <div class="offset-2 col-10 col-lg-3 mt-3 mb-3 rounded boxshd" style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">
                            <div class="row">

                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold">Mostly Famouse Seller</label>
                                </div>

                                <?php

                                $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON user.email=profile_img.user_email
                                WHERE `email`='" . $product_data["user_email"] . "'");

                                ?>

                                <div class="col-12 text-center">
                                    <img src="resources/profiles/IMG-3221.JPG" class="img-fluid rounded-top" style="height: 250px;" />
                                    <hr />
                                </div>

                                <div class="col-12 text-center">
                                    <span class="fs-5 fw-bold">Heshan Danansooriya</span><br>
                                    <span class="fs-6">heshan@gmail.com</span><br>
                                    <span class="fs-6">071 8701011</span>
                                </div>

                                <div class="col-12 mb-2">
                                    <div class="first_plase"></div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
    </body>

    </html>

<?php

} else {

?>

    <script>
        alert("Please SignIn first.");
        window.location = "adminsignin.php";
    </script>

<?php

}


?>