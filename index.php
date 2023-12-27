<?php

include_once("config/database.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Mobocom Store</title>
</head>

<body>

    <div class="container-fluid p-0">
        <!-- Navbar -->

        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="assets/img/mobocom_logo.png" alt="logo" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item ">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/products">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/register">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/register">
                                <i class="fa fa-shopping-cart" aria-hidden="true">
                                    <sup>1</sup>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item border border-light">
                            <a class="nav-link text-light" href="/register">
                                Total Price : <span id="total_price">25000</span>
                            </a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- End of Navbar -->


        <!--  Second Nav -->
        <nav class="navbar navbar-expand-lg bg-warning">
            <div class="container-fluid">
                <p class="text-light mb-0">
                    Welcome ghost
                </p>
                <a href="/login" class="nav-link p-0">Login</a>
            </div>
        </nav>
        <!-- End Second nav -->

        <!-- Container Section -->

        <div class="row mt-4">
            <div class="col-md-10 me-auto ">
                <div class="row">
                    <?php

                    $sqlCommand = "SELECT * FROM products ORDER BY date ASC";
                    $result = mysqli_query($conn, $sqlCommand);
                    while ($item = mysqli_fetch_assoc($result)) {
                        $product_title = $item["product_title"];
                        $product_description = $item["product_description"];
                        $product_keywords = $item["product_keywords"];
                        $category_id = $item["category_id"];
                        $brands_id = $item["brands_id"];
                        $product_image1 = $item["product_image1"];
                        $product_price = $item["product_price"];
                        echo "
                            <div class='col-md-4 mb-2'>
                                <div class='card'>
                                    <img src='./adm_panel/products_image/$product_image1' class='card-img-top product__img' alt='$product_title'>
                                    <div class='card-body'>
                                   <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                  <a href='#' class='btn btn-primary'>Add to Card</a>
                                  <a href='#' class='btn btn-outline-primary'>View more</a>
                            </div>
                        </div>
                    </div>
                            ";
                    }

                    ?>


                </div>

            </div>
            <div class="col-md-2 bg-primary-subtle p-0">
                <div class="brands">
                    <h4 class="bg-secondary text-light text-center p-2">Brands</h4>
                    <ul class="navbar-nav me-auto mb-2 text-center">
                        <?php
                        $allBrandscommand = "SELECT * FROM brands";
                        $brands_result = mysqli_query($conn, $allBrandscommand);
                        while ($row = mysqli_fetch_assoc($brands_result)) {
                            $brandTitle = $row["brand_title"];
                            $brandId = $row["brand_id"];
                            echo "
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php?$brandId'>$brandTitle</a>
                        </li>
                        ";
                        }

                        ?>

                    </ul>

                </div>
                <div class="categories">
                    <h4 class="bg-secondary text-light text-center p-2">Categories</h4>
                    <ul class="navbar-nav me-auto mb-2 text-center">
                        <?php
                        $allCategoriescommand = "SELECT * FROM categories";
                        $categories_result = mysqli_query($conn, $allCategoriescommand);
                        while ($row = mysqli_fetch_assoc($categories_result)) {
                            $categoryTitle = $row["category_title"];
                            $categoryId = $row["category_id"];
                            echo "
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php?$categoryId'>$categoryTitle</a>
                        </li>
                        ";
                        }

                        ?>

                    </ul>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <footer class="bg-primary text-light text-center">
            <p>Made By Amin Ataei with ❤️</p>
        </footer>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>