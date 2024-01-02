<?php

include_once("../config/database.php");
include_once("../helpers/commonFunction.php");

session_start();
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

        .user_img{
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
                            <a class="nav-link text-light" href="/mobocom/user_area/userRegister.php">Register</a>
                        </li>
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


        <!--  Second Nav -->
        <nav class="navbar navbar-expand-lg bg-warning">
            <div class="container-fluid">
                <?php if (isset($_SESSION["user_name"])) : ?>
                    <p class="text-light mb-0">
                        Welcome <?php echo $_SESSION["user_name"]; ?>
                    </p>
                    <a href="user_area/logout.php" class="nav-link p-0">Logout</a>
                <?php else : ?>
                    <p> Welcome Ghost</p>
                    <a href="user_area/userLogin.php" class="nav-link p-0">Login</a>
                <?php endif; ?>

            </div>
        </nav>
        <!-- End Second nav -->

        <!-- Container Section -->

        <div class="row mt-4">
            <div class="col-md-8 me-auto ">
                <div class="row">


                </div>

            </div>
            <div class="col-md-4 bg-primary-subtle p-0">
                <div class="brands">
                    <h4 class="bg-secondary text-light text-center p-2"><?php echo $_SESSION["user_name"]; ?></h4>
                    <ul class="navbar-nav me-auto mb-2 text-center">
                        <?php
                        $user_name = $_SESSION["user_name"];
                        $selectUserQuery = "SELECT * FROM person WHERE user_name = '$user_name'";
                        $resultUserQuery = mysqli_query($conn, $selectUserQuery);
                        $userInfo = mysqli_fetch_array($resultUserQuery);
                        $user_img = $userInfo["user_img"];
                        echo "
                            <li class='nav-item'>
                              <img src='./userImages/$user_img' class='user_img'>
                            </li>
                            "
                        ?>

                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="profile.php">Pending order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="profile.php?edit_account">Edit account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="profile.php?my_orders">My orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="profile.php?delete_account">Delete account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
                        </li>
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