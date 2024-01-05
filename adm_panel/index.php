<?php

include_once("../config/database.php");
include_once("../helpers/commonFunction.php");

if (isset($_POST["categoryName"]) && strlen($_POST["categoryName"]) > 0) {
    $categoryTitle = $_POST["categoryName"];
    $allCategorycommand = "SELECT * FROM categories WHERE category_title = '$categoryTitle'";
    $result = mysqli_query($conn, $allCategorycommand);
    $numbers =  mysqli_num_rows($result);
    if ($numbers > 0) {
        echo "<script>alert(New record created successfully)</script>";
    } else {
        $sqlCommand = "INSERT INTO categories (category_title) VALUES ('$categoryTitle')";
        if (mysqli_query($conn, $sqlCommand)) {
            echo "<script>alert(New record created successfully)</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}


if (isset($_POST["brandName"]) && strlen($_POST["brandName"]) > 0) {
    $brandTitle = $_POST["brandName"];
    $allBrandscommand = "SELECT * FROM brands WHERE brand_title = '$brandTitle'";
    $result = mysqli_query($conn, $allBrandscommand);
    $numbers =  mysqli_num_rows($result);
    if ($numbers > 0) {
        echo "<script>alert(New record created successfully)</script>";
    } else {
        $sqlCommand = "INSERT INTO brands (brand_title) VALUES ('$brandTitle')";
        if (mysqli_query($conn, $sqlCommand)) {
            echo "<script>alert(New record created successfully)</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Mobocom store_Admin Panel</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            overflow-x: hidden;
        }

        .logo {
            height: 50px;
            width: 50px;
        }

        .profile_img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .productImg {
            width: 50px;
            height: 50px;
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

        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/mobocom/">
                    <img src="../assets/img/mobocom_logo.png" alt="logo" class="logo">
                </a>

            </div>
        </nav>

        <div class="row vh-100">

            <div class="col-md-8">
                <?php
                if (isset($_GET["insert_categories"])) {
                    include_once("insertCategories.php");
                }
                if (isset($_GET["insert_brands"])) {
                    include_once("insertBrands.php");
                }
                if (isset($_GET["view_products"])) {
                    include_once("viewProducts.php");
                }
                if (isset($_GET["view_categories"])) {
                    include_once("viewCategories.php");
                }
                if (isset($_GET["editproduct"])) {
                    include_once("editProduct.php");
                }
                if (isset($_GET["editcategory"])) {
                    include_once("editcategory.php");
                }
                if (isset($_GET["editbrand"])) {
                    include_once("editbrand.php");
                }
                if (isset($_GET["view_brands"])) {
                    include_once("viewBrands.php");
                }
                if (isset($_GET["removeproduct"])) {
                    $product_id = $_GET["removeproduct"];
                    $deleteProductQuery = "DELETE FROM products WHERE product_id = '$product_id'";
                    $result = mysqli_query($conn, $deleteProductQuery);
                    if($result){
                        echo "<script>alert('Delete successfully')</script>";
                    }else{
                        echo "<script>alert('Error in delete products')</script>";
                    }
                };
                if (isset($_GET["removeCategory"])) {
                    $category_id = $_GET["removeCategory"];
                    $deleteProductQuery = "DELETE FROM categories WHERE category_id = '$category_id'";
                    $result = mysqli_query($conn, $deleteProductQuery);
                    if($result){
                        echo "<script>alert('Delete successfully')</script>";
                    }else{
                        echo "<script>alert('Error in delete products')</script>";
                    }
                };
                if (isset($_GET["removebrand"])) {
                    $brand_id = $_GET["removebrand"];
                    $deleteProductQuery = "DELETE FROM brands WHERE brand_id = '$brand_id'";
                    $result = mysqli_query($conn, $deleteProductQuery);
                    if($result){
                        echo "<script>alert('Delete successfully')</script>";
                    }else{
                        echo "<script>alert('Error in delete products')</script>";
                    }
                };
                ?>

            </div>

            <div class="col-md-4 bg-primary-subtle p-0">
                <h4 class="bg-secondary text-light text-center p-2 mb-0">Menu</h4>
                <div class=" me-auto text-center ">
                    <img src="../assets/img/user.jpg" alt="profile_image" class="profile_img rounded-5 ">
                </div>
                <ul class="navbar-nav me-auto mb-2 mt-0 text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="productForm.php">Insert products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?view_products">View Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?insert_categories">Insert Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?view_categories">View Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?insert_brands">Insert Brands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?view_brands">View Brands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">All orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">All payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">List user</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">logout</a>
                    </li>
                </ul>
            </div>

        </div>


        <!-- Footer -->
        <footer class="bg-primary text-light text-center">
            <p>Made By Amin Ataei with ❤️</p>
        </footer>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>