<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Own Dress | Advanced Search</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo_free-file.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="hb1">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-body" style="margin-top: -4px;">
                <?php

                require "header.php";

                ?>
            </div>

            <div class="col-12" style="background-color: #e3f2fd;margin-top: -4px;">
                <div class="row">
                    <div class="offset-0 offset-lg-4 col-12 col-lg-4">
                        <div class="row">

                            <div class="col-2 mt-2">
                                <div class="mb-3 logo-img"></div>
                            </div>

                            <div class="col-10 mb-2" style="margin-top: -20px;">
                                <label class="text-black-50 fw-bold fs-2 mt-4">Advanced Search</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3 bg-white mt-3 mb-3 rounded" style="margin-left: 40px;">
                <div class="row">

                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12 mt-3 mb-2">
                                <input type="text" class="form-control fw-bold" onkeyup="advancedSearch(0);" placeholder="Type keyword to search..." id="s1" />
                            </div>
                            <div class="col-12 mt-3 mb-2 d-grid">
                                <button class="btn btn-primary search-btn1" onclick="advancedSearch(0);">Search</button>
                            </div>

                            <div class="col-12">
                                <hr class="border border-primary border-3" />
                            </div>

                        </div>
                    </div>

                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select" id="ca1" onchange="advancedSearch(0);">
                                            <option value="0">Select Category</option>
                                            <?php

                                            $rs1 = Database::search("SELECT * FROM `category`");
                                            $n1 = $rs1->num_rows;

                                            for ($x = 0; $x < $n1; $x++) {

                                                $fa1 = $rs1->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $fa1["id"]; ?>"><?php echo $fa1["name"]; ?></option>

                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select" id="shn" onchange="advancedSearch(0);">
                                            <option value="0">Select Shop Name</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM `pro_shop_name`");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $d = $rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $d["name_id"]; ?>"><?php echo $d["shop_name"]; ?></option>

                                            <?php

                                            }

                                            ?>
                                        </select>
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <div class="col-12 mb-2">
                                            <input type="text" class="form-control" placeholder="Type Product Color..." id="clr" onkeyup="advancedSearch(0);"/>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Price From..." id="pf1" onkeyup="advancedSearch(0);" />
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Pric To..." id="pt1" onkeyup="advancedSearch(0);" />
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-8 mt-3 mb-3 rounded bg-white" style="margin-left:40px;" id="view_area">
                <div class="row">
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row">

                            <div class="offset-5 col-2 mt-5">
                                <span class="text-black-50 fw-bold h1"><i class="bi bi-search fs-1"></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-5 mb-5">
                                <span class="h1 text-black-50">No Items Searched Yet.</span>
                            </div>

                            <!-- <div class="card mb-3 mt-3 col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-md-4 mt-4">

                                        <img src="resources/mobile images/iphone12.jpg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">

                                            <h5 class="card-title fw-bold">iPhone 12</h5>
                                            <span class="card-text text-primary fw-bold">Rs.500000.00</span>
                                            <br />
                                            <span class="card-text text-success fw-bold fs">10 Items Left</span>

                                            <div class="row">
                                                <div class="col-12">

                                                    <div class="row g-1">
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-success fs">Update</a>
                                                        </div>
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-danger fs">Delete</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 mt-3 col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-md-4 mt-4">

                                        <img src="resources/mobile images/iphone_SE_2.jpg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">

                                            <h5 class="card-title fw-bold">iPhone SE2</h5>
                                            <span class="card-text text-primary fw-bold">Rs.100000.00</span>
                                            <br />
                                            <span class="card-text text-success fw-bold fs">6 Items Left</span>

                                            <div class="row">
                                                <div class="col-12">

                                                    <div class="row g-1">
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-success fs">Update</a>
                                                        </div>
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-danger fs">Delete</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 mt-3 col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-md-4 mt-4">

                                        <img src="resources/mobile images/huawei_p20.png" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">

                                            <h5 class="card-title fw-bold">huawei p20</h5>
                                            <span class="card-text text-primary fw-bold">Rs.60000.00</span>
                                            <br />
                                            <span class="card-text text-success fw-bold fs">9 Items Left</span>

                                            <div class="row">
                                                <div class="col-12">

                                                    <div class="row g-1">
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-success fs">Update</a>
                                                        </div>
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-danger fs">Delete</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 mt-3 col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-md-4 mt-4">

                                        <img src="resources/mobile images/oppo_a95.png" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">

                                            <h5 class="card-title fw-bold">oppo a95</h5>
                                            <span class="card-text text-primary fw-bold">Rs.75000.00</span>
                                            <br />
                                            <span class="card-text text-success fw-bold fs">14 Items Left</span>

                                            <div class="row">
                                                <div class="col-12">

                                                    <div class="row g-1">
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-success fs">Update</a>
                                                        </div>
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-danger fs">Delete</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 mt-3 col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-md-4 mt-4">

                                        <img src="resources/mobile images/samsung_s6.jpg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">

                                            <h5 class="card-title fw-bold">Samsung S6</h5>
                                            <span class="card-text text-primary fw-bold">Rs.500000.00</span>
                                            <br />
                                            <span class="card-text text-success fw-bold fs">10 Items Left</span>

                                            <div class="row">
                                                <div class="col-12">

                                                    <div class="row g-1">
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-success fs">Update</a>
                                                        </div>
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-danger fs">Delete</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 mt-3 col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-md-4 mt-4">

                                        <img src="resources/mobile images/iphone12.jpg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">

                                            <h5 class="card-title fw-bold">iPhone 12</h5>
                                            <span class="card-text text-primary fw-bold">Rs.500000.00</span>
                                            <br />
                                            <span class="card-text text-success fw-bold fs">10 Items Left</span>

                                            <div class="row">
                                                <div class="col-12">

                                                    <div class="row g-1">
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-success fs">Update</a>
                                                        </div>
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-danger fs">Delete</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> -->


                        </div>

                    </div>

                    <!-- <div class="offset-0 offset-lg-4 col-12 col-lg-4 mb-3">
                        <div class="row">
                            <div class="pagination">
                                <a href="#">&laquo;</a>
                                <a href="#" class="active">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a href="#">6</a>
                                <a href="#">&raquo;</a>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>

            <!-- SORT BY -->
            <div class="col-12 col-lg-3 bg-white rounded mb-3" style="margin-left: 40px;">
                <div class="row">
                    <div class="col-6">
                        <select class="form-select border-bottom border-0 border-primary border-3" id="sort" onchange="advancedSearch(0);">
                            <option value="0">SORT BY</option>
                            <option value="1">Price Low to High</option>
                            <option value="2">Price High to Low</option>
                            <option value="3">Quantity Low to High</option>
                            <option value="4">Quantity High to Low</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- SORT BY -->


            <?php

            require "footer.php";

            ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>

</html>