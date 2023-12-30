<?php

include_once("config/database.php");
include_once("helpers/commonFunction.php");

if (isset($_POST["updateCartItem"]) and is_numeric($_POST["updateCartItem"])) {

    global $conn;
    $userIp_address = getIPAddress();
    $productQuantities = $_POST["qty"];
    $productId = $_POST["updateCartItem"];
    $updateQuantityProductQuery = "UPDATE cart_details SET quantities = '$productQuantities' WHERE user_ip_address = '$userIp_address' and product_id = '$productId'";
    $updateQuantityProductResult = mysqli_query($conn, $updateQuantityProductQuery);
}

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cart Table</title>
    <style>
        .logo {
            width: 48px;
            height: 48px;
        }

        .productImg {
            width: 80px;
            height: 80px;
        }

        footer {
            position: absolute;
            left: 0;
            right: 0;
            height: 5rem;
            bottom: 0;
        }
    </style>
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
                                    <sup><?php getNumberOfProduct(); ?></sup>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item border border-light">
                            <a class="nav-link text-light" href="/register">
                                Total Price : <span id="total_price"><?php getTotalPrice(); ?></span>
                            </a>
                        </li>
                    </ul>
                    <form action="search_product.php" method="get" class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_product">
                        <input class="btn btn-outline-light" type="submit" value="search" name="search_product_data">
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

            <div class="container px-5 me-auto">
                <div class="row">

                    <form action="" method="post">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">product Title</th>
                                    <th scope="col">product Image</th>
                                    <th scope="col">Quantities</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Remove</th>
                                    <th scope="col">Operations</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                getCartItem();
                                ?>
                            </tbody>
                        </table>

                        <div class="container">
                            <div class="d-flex">

                                <h4 class="px-4">
                                    Total price: <strong><?php getTotalPrice(); ?></strong>
                                </h4>
                                <a class="btn btn-primary" href="index.php">
                                    countinue Shopping
                                </a>
                                <a class="btn btn-primary" href="#">
                                    Checkout
                                </a>
                            </div>
                        </div>
                    </form>

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