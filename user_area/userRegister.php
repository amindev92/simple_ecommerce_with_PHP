<?php

include_once("../config/database.php");
include_once("../helpers/commonFunction.php");

if (isset($_POST["registerUser"])) {
    $user_name = $_POST["user_name"];
    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];
    $user_img = $_FILES["user_img"]["name"];
    $user_img_tmp = $_FILES["user_img"]["tmp_name"];
    $user_ip = getIPAddress();
    $user_address = $_POST["user_address"];
    $user_mobile = $_POST["user_mobile"];

    move_uploaded_file($user_img_tmp, "./userImages/$user_img");
    $hass_password = password_hash($user_password, PASSWORD_DEFAULT);

    $selectUserQuery = "
        SELECT * FROM person WHERE user_name LIKE '%$user_name%' or user_email LIKE '%$user_email%' 
    ";
    $resultSelectUserQuery = mysqli_query($conn, $selectUserQuery);
    $numberRowOfResultSelectUser = mysqli_num_rows($resultSelectUserQuery);
    if ($numberRowOfResultSelectUser > 0) {
        echo "<script>alert('Already user exist.')</script>";
    } else {

        $insetUserDataQuery = "
    INSERT INTO `person` (`user_name`, `user_email`, `user_password`, `user_img`, `user_ip`, `user_address`, `user_mobile`) VALUES ('$user_name', '$user_email', '$hass_password', '$user_img', '$user_ip', '$user_address', '$user_mobile');
    ";
        $resultInsertUserData = mysqli_query($conn, $insetUserDataQuery);
        if ($resultInsertUserData) {
            echo "<script>alert('successfully register user')</script>";
            header("Location:../index.php");
        }
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
            /* bottom: 0; */
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
                        <li class="nav-item ">
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
                            <a class="nav-link text-light" href="../cartTable.php">
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
                <p class="text-light mb-0">
                    Welcome ghost
                </p>
                <a href="userLogin.php" class="nav-link p-0">Login</a>
            </div>
        </nav>
        <!-- End Second nav -->

        <div class="container my-4">

            <div class="row">

                <form action="" method="post" class="mb-6 h-100" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="user_name" class="form-label">Username</label>
                        <div class="input-group ">
                            <span class="input-group-text" id="basic-addon1">@</span>

                            <input type="text" name="user_name" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="user_email" class="form-label">Email address</label>
                        <input type="email" name="user_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" name="user_password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Default file input example</label>
                        <input class="form-control" name="user_img" type="file" id="formFile">
                    </div>
                    <div class="input-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">Address</label>
                        <div class="input-group ">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" name="user_address" class="form-control" placeholder="Address" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
                        <div class="input-group ">
                            <span class="input-group-text" id="basic-addon1">@</span>

                            <input type="number" name="user_mobile" class="form-control" placeholder="Phone number" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <p class="form-check-label" for="exampleCheck1">Already have an account? <a href="userLogin.php">Login</a></p>
                    </div>
                    <button type="submit" name="registerUser" class="btn btn-primary">Submit</button>
                </form>

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