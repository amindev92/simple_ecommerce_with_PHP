<?php

function viewProduct()
{
    if (isset($_GET["product_id"]) && is_numeric($_GET["product_id"])) {
        global $conn;
        $productId = $_GET["product_id"];
        $sqlCommand = "SELECT * FROM products WHERE product_id = '$productId'";
        $result = mysqli_query($conn, $sqlCommand);
        $item = mysqli_fetch_assoc($result);
        $product_id = $item["product_id"];
        $product_title = $item["product_title"];
        $product_description = $item["product_description"];
        $product_keywords = $item["product_keywords"];
        $category_id = $item["category_id"];
        $brands_id = $item["brand_id"];
        $product_image1 = $item["product_image1"];
        $product_image2 = $item["product_image2"];
        $product_image3 = $item["product_image3"];
        $product_price = $item["product_price"];
        echo "
        <div class='col-md-4'>
            <div class='card'>
                 <img src='./adm_panel/products_image/$product_image1' class='card-img-top product__img' alt='$product_title'>
                 <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                   <p class='card-text'>$product_description</p>
                  <a href='#' class='btn btn-primary'>Add to Card</a>
                   <a href='product_details.php?product_id=$product_id' class='btn btn-outline-primary'>View more</a>
                  </div>
             </div>
         </div>
        <div class='col-md-8 px-8'>
             <div class='row'>
               <div class='col-md-10 mb-4'>
                  <h4>Related Images</h4>
                  </div>
            <div class='col-md-6'>
                <img src='./adm_panel/products_image/$product_image2' class='card-img-top product__img' alt='$product_title'>
            </div>
            <div class='col-md-6'>
                <img src='./adm_panel/products_image/$product_image3' class='card-img-top product__img' alt='$product_title'>
            </div>
        </div>
    </div>
                            ";
    }
}


function searchProducts()
{

    if (isset($_GET["search_product"]) && !empty($_GET["search_product"])) {
        global $conn;
        $searchProductKeyword = $_GET["search_product"];
        $sqlCommand = "SELECT * FROM products WHERE product_keywords LIKE '%$searchProductKeyword%'";
        $result = mysqli_query($conn, $sqlCommand);
        if (mysqli_num_rows($result) <= 0) {
            echo "<p>Not Product for this search</p>";
        } else {
            while ($item = mysqli_fetch_assoc($result)) {
                $product_id = $item["product_id"];
                $product_title = $item["product_title"];
                $product_description = $item["product_description"];
                $product_keywords = $item["product_keywords"];
                $category_id = $item["category_id"];
                $brands_id = $item["brand_id"];
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
                                  <a href='product_details.php?product_id=$product_id' class='btn btn-outline-primary'>View more</a>
                            </div>
                        </div>
                    </div>
                            ";
            }
        }
    }
}

function get_uniqe_category()
{
    if (isset($_GET["category"]) && is_numeric($_GET["category"])) {
        global $conn;
        $cat_id = $_GET["category"];
        $sqlCommand = "SELECT * FROM products WHERE category_id = $cat_id";
        $result = mysqli_query($conn, $sqlCommand);
        if (mysqli_num_rows($result) <= 0) {
            echo "<p>Not Product for this category</p>";
        } else {
            while ($item = mysqli_fetch_assoc($result)) {
                $product_id = $item["product_id"];
                $product_title = $item["product_title"];
                $product_description = $item["product_description"];
                $product_keywords = $item["product_keywords"];
                $category_id = $item["category_id"];
                $brands_id = $item["brand_id"];
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
                                  <a href='product_details.php?product_id=$product_id' class='btn btn-outline-primary'>View more</a>
                            </div>
                        </div>
                    </div>
                            ";
            }
        }
    }
}

function get_uniqe_brand()
{
    if (isset($_GET["brand"]) && is_numeric($_GET["brand"])) {
        global $conn;
        $brand_id = $_GET["brand"];
        $sqlCommand = "SELECT * FROM products WHERE brand_id = $brand_id";
        $result = mysqli_query($conn, $sqlCommand);
        if (mysqli_num_rows($result) <= 0) {
            echo "<p>Not Product for this category</p>";
        } else {
            while ($item = mysqli_fetch_assoc($result)) {
                $product_id = $item["product_id"];
                $product_title = $item["product_title"];
                $product_description = $item["product_description"];
                $product_keywords = $item["product_keywords"];
                $category_id = $item["category_id"];
                $brands_id = $item["brand_id"];
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
                                  <a href='product_details.php?product_id=$product_id' class='btn btn-outline-primary'>View more</a>
                            </div>
                        </div>
                    </div>
                            ";
            }
        }
    }
}

function getCategories()
{
    global $conn;
    $allCategoriescommand = "SELECT * FROM categories";
    $categories_result = mysqli_query($conn, $allCategoriescommand);
    while ($row = mysqli_fetch_assoc($categories_result)) {
        $categoryTitle = $row["category_title"];
        $categoryId = $row["category_id"];
        echo "
    <li class='nav-item'>
        <a class='nav-link' href='index.php?category=$categoryId'>$categoryTitle</a>
    </li>
    ";
    }
}

function getBrands()
{

    global $conn;
    $allBrandscommand = "SELECT * FROM brands";
    $brands_result = mysqli_query($conn, $allBrandscommand);
    while ($row = mysqli_fetch_assoc($brands_result)) {
        $brandTitle = $row["brand_title"];
        $brandId = $row["brand_id"];
        echo "
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php?brand=$brandId'>$brandTitle</a>
                        </li>
                        ";
    }
}

function getProducts()
{
    if (!isset($_GET["category"]) and !isset($_GET["brand"])) {

        global $conn;
        $sqlCommand = "SELECT * FROM products ORDER BY date ASC";
        $result = mysqli_query($conn, $sqlCommand);
        while ($item = mysqli_fetch_assoc($result)) {
            $product_id = $item["product_id"];
            $product_title = $item["product_title"];
            $product_description = $item["product_description"];
            $product_keywords = $item["product_keywords"];
            $category_id = $item["category_id"];
            $brands_id = $item["brand_id"];
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
                                  <a href='product_details.php?product_id=$product_id' class='btn btn-outline-primary'>View more</a>
                            </div>
                        </div>
                    </div>
                            ";
        }
    }
}
