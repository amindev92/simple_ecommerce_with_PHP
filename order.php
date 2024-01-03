<?php

include_once("config/database.php");
include_once("helpers/commonFunction.php");

if (isset($_GET["user_id"]) and is_numeric($_GET["user_id"])) {
    $user_id = $_GET["user_id"];
}

$userIp_address = getIPAddress();
$totalPrice = 0;
$selectCartQuery = "SELECT * FROM cart_details WHERE user_ip_address = '$userIp_address'";
$resultCartQuery = mysqli_query($conn, $selectCartQuery);
$countProductOfCartQuery = mysqli_num_rows($resultCartQuery);
$invoice_number = mt_rand();
$status = "pending";
while ($CartItems = mysqli_fetch_array($resultCartQuery)) {
    $quantitiesProduct = $CartItems["quantities"];
    $product_id = $CartItems["product_id"];
    $selectProductQuery = "SELECT * FROM products WHERE product_id = '$product_id'";
    $resultProductQuery = mysqli_query($conn, $selectProductQuery);
    $prodcutItem = mysqli_fetch_array($resultProductQuery);
    $productPrice = $prodcutItem["product_price"];
    $totalPrice += $productPrice * $quantitiesProduct;
    $invoiceNumber_product = mt_rand();
    $insertOrderPendingQuery = "
    INSERT INTO `order_pending` (`user_id`, `invoice_number`, `product_id`, `quantities`, `order_status`) VALUES ('$user_id', '$invoiceNumber_product', '$product_id', '$quantitiesProduct', '$status');
    ";
    $resultOrderPendingQuery = mysqli_query($conn, $insertOrderPendingQuery);
};


// $selectAllCartQuery = "SELECT * FROM cart_details";
// $resultAllCartQuery = mysqli_query($conn, $selectAllCartQuery);
// $cartItem = mysqli_fetch_array($resultAllCartQuery);
// $qunatityCartItem = $cartItem["quantities"];
// if ($qunatityCartItem == 1) {
//     $subTotalPrice = $totalPrice;
// } else {
//     $subTotalPrice = $totalPrice * $qunatityCartItem;
// };


$insertOrderQuery = "INSERT INTO `user_orders` (`user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES ('$user_id', '$totalPrice', '$invoice_number', '$countProductOfCartQuery', NOW(), '$status')";
$resultInsertOrderQuery = mysqli_query($conn, $insertOrderQuery);
if ($resultInsertOrderQuery) {
    echo "<script>alert('order submit successfully)</script>";
    echo "<script>window.open('index.php', '_self');</script>";
}

$truncateCartDetails = "TRUNCATE TABLE `mobocom_store`.`cart_details`";
$runTruncateCartTable = mysqli_query($conn, $truncateCartDetails);



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
    <title>checkout</title>
    <style>
        .logo {
            width: 48px;
            height: 48px;
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
                <a class="navbar-brand" href="/mobocom">
                    <img src="assets/img/mobocom_logo.png" alt="logo" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item ">
                            <a class="nav-link active" aria-current="page" href="/mobocom">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Products</a>
                        </li>
                        <li class="nav-item">
                        <?php 
                            if (isset($_SESSION["user_name"])) {
                                echo " <a class='nav-link text-light' href='/mobocom/user_area/profile.php'>My Account</a>";
                            }else{
                                echo " <a class='nav-link text-light' href='/mobocom/user_area/userRegister.php'>Register</a>";
                            }
                           ?>                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="cartTable.php">
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
                        <input class="form-control" me-2" type="search" placeholder="Search" aria-label="Search" name="search_product">
                        <input class="btn btn-outline-light" type="submit" value="search" name="search_product_data">
                    </form>
                </div>
            </div>
        </nav>
        <!-- End of Navbar -->

        <div class="container">



        </div>



        <!-- Footer -->
        <footer class="bg-primary text-light text-center">
            <p>Made By Amin Ataei with ❤️</p>
        </footer>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>