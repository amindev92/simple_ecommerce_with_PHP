<?php

include_once("../config/database.php");
include_once("../helpers/commonFunction.php");

session_start();

if (isset($_GET["order_id"]) and is_numeric($_GET["order_id"])) {
    $order_id = $_GET["order_id"];
    $selectOrderQuery = "SELECT * FROM user_orders WHERE order_id = '$order_id'";
    $fetchOrderQuery = mysqli_query($conn, $selectOrderQuery);
    $orderInfo = mysqli_fetch_array($fetchOrderQuery);
    $amount_due = $orderInfo["amount_due"];
    $totalProducts = $orderInfo["total_products"];
    $invoiceNumber = $orderInfo["invoice_number"];
}

if (isset($_POST["submitFactor"])) {
    $insertPaymentQuery = "INSERT INTO `user_payment` (`order_id`, `invoice_number`, `amount`, `date`) VALUES ($order_id , $invoiceNumber, $amount_due, NOW())";
    $resultPaymentQuery = mysqli_query($conn, $insertPaymentQuery);
    if($resultPaymentQuery){
        $updateOrderStatus = "UPDATE `user_orders` SET `order_status` = 'complete' WHERE `user_orders`.`order_id` = $order_id";
        echo "<script>alert('successful payment')</script>";
        echo "<script>window.open('profile.php')</script>";
    }else{
        echo "<script>alert('Unsuccessful payment')</script>";
        echo "<script>window.open('profile.php')</script>";
    }


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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Profile <?php echo $_SESSION["user_name"]; ?></title>
    <style>
        .logo {
            width: 48px;
            height: 48px;
        }

        .user_img {
            width: 100px;
            height: 100px;
            object-fit: contain;
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
                    <img src="../assets/img/mobocom_logo.png" alt="logo" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/mobocom">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Products</a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION["user_name"])) {
                                echo " <a class='nav-link text-light' href='/mobocom/user_area/profile.php'>My Account</a>";
                            } else {
                                echo " <a class='nav-link text-light' href='/mobocom/user_area/userRegister.php'>Register</a>";
                            }
                            ?> </li>
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

            <form action="" method="post">
                <div class="form-group">
                    <label for="invoiceNumber">Amount Bill:</label>
                    <input type="text" value="<?php echo $amount_due; ?>" class="form-control" id="invoiceNumber" disabled>
                </div>
                <div class="form-group">
                    <label for="totalProducts">Total Products</label>
                    <input type="text" value="<?php echo $totalProducts; ?>" class="form-control" id="totalProducts" disabled>
                </div>
                <div class="form-group">
                    <label for="amount_due">Invoice Number</label>
                    <input type="text" value="<?php echo $invoiceNumber ?>" class="form-control" id="$amount_due" disabled>
                </div>

                <button type="submit" name="submitFactor" class="btn btn-primary">Submit</button>
            </form>

        </div>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>