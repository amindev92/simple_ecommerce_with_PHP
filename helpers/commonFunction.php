<?php

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
        <a class='nav-link' href='index.php?$categoryId'>$categoryTitle</a>
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
                            <a class='nav-link' href='index.php?$brandId'>$brandTitle</a>
                        </li>
                        ";
    }
}

function getProducts()
{
    global $conn;
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
}
