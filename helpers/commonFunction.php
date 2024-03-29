<?php
include_once("../config/database.php");

function displayProducts()
{

    global $conn;
    $selectProductQuery = "SELECT * FROM products";
    $resultProductQuery = mysqli_query($conn, $selectProductQuery);
    while ($rowProduct = mysqli_fetch_array($resultProductQuery)) {
        $product_id = $rowProduct["product_id"];
        $product_name = $rowProduct["product_title"];
        $product_price = $rowProduct["product_price"];
        $product_img = $rowProduct["product_image1"];
        $status = $rowProduct["status"];
        echo "<tr>
        <td>$product_id</td>
        <td>$product_name</td>
        <td>$product_price</td>
        <td>
            <img src='products_image/$product_img' alt='$product_name' class='productImg'>
        </td>
        ";
        $selectProductOrderQuery = "SELECT * FROM `order_pending` WHERE product_id = '$product_id'";
        $resultOrderQuery = mysqli_query($conn, $selectProductOrderQuery);
        $rowCountOrder = mysqli_num_rows($resultOrderQuery);
        echo "
        <td>$rowCountOrder</td>
        <td>$status</td>
        <td>
        <a href='index.php?editproduct' class='fa-pen-to-square'>Edit</a>
        </td>
        <td>
        <a href='index.php?removeproduct=$product_id' class='fa-pen-to-square'>Remove</a>
        </td>
        ";
    };
}

function get_user_orders()
{

    global $conn;
    $user_name = $_SESSION["user_name"];
    $selectUserQuery = "SELECT * FROM person WHERE user_name = '$user_name'";
    $resultSelectUserQuery = mysqli_query($conn, $selectUserQuery);
    $userInfo = mysqli_fetch_array($resultSelectUserQuery);
    $user_id = $userInfo["user_id"];

    $selectOrderQuery = "SELECT * FROM order_pending WHERE user_id = '$user_id'";
    $resultSelectOrderQuery = mysqli_query($conn, $selectOrderQuery);
    $orderItem = mysqli_fetch_array($resultSelectOrderQuery);
    $numberOfOrderItems = mysqli_num_rows($resultSelectOrderQuery);
    if ($numberOfOrderItems > 0) {
        echo "<p>you have $numberOfOrderItems order.</p>";
    } else {
        echo "<p>you dont have any order - $user_id .</p>";
    }
}

function getCartItem()
{

    global $conn;
    $userIp_address = getIPAddress();
    $selectCartItems = "SELECT * FROM cart_details WHERE user_ip_address = '$userIp_address'";
    $result_products = mysqli_query($conn, $selectCartItems);
    while ($item = mysqli_fetch_array($result_products)) {
        $productId = $item["product_id"];
        $selectProductQuery = "SELECT * FROM products WHERE product_id = '$productId'";
        $result = mysqli_query($conn, $selectProductQuery);
        $product = mysqli_fetch_array($result);
        // while ($product = mysqli_fetch_array($result)) {
        $productId = $product["product_id"];
        $productTitle = $product["product_title"];
        $productImg = $product["product_image1"];
        $productPrice = $product["product_price"];
        echo "
                <tr>
                    <td>$productTitle</td>
                    <td>
                        <img src='./adm_panel/products_image/$productImg' alt='$productTitle' class='productImg'>
                    </td>
                    <td>
                        <input type='text' class='form-control' id='productQuantity' name='qty[]'>
                    </td>
                    <td>+$productPrice</td>
                    <td>
                        <input type='checkbox' name='removeItem[]' value='$productId'>
                    </td>
                    <td>
                        <button type='submit' name='updateCartItem' value='$productId' class ='btn btn-primary'>Update Cart</button>
                        <button  type='submit' name='removeCartItem' class ='btn btn-primary'>Remove</button>
                        
                    </td>
                </tr>
    ";
    }
    // }

}

function getTotalPrice()
{

    global $conn;
    $totalPrice = 0;
    $userIp_address = getIPAddress();
    $selectCartItems = "SELECT * FROM cart_details WHERE user_ip_address = '$userIp_address'";
    $result = mysqli_query($conn, $selectCartItems);
    while ($item = mysqli_fetch_array($result)) {

        $product_id = $item["product_id"];
        $product_quantity = $item["quantities"];
        $selectProductQuery = "SELECT * FROM products WHERE product_id = '$product_id'";
        $productResult = mysqli_query($conn, $selectProductQuery);
        $product = mysqli_fetch_array($productResult);
        // while ($product = mysqli_fetch_array($productResult)) {
        $productPrice = $product["product_price"] * $product_quantity;
        $totalPrice += $productPrice;
        // }
    }
    echo $totalPrice;
}

function getNumberOfProduct()
{

    global $conn;
    $userIp_address = getIPAddress();
    $selectProducts = "SELECT * FROM cart_details WHERE user_ip_address = '$userIp_address'";
    $result = mysqli_query($conn, $selectProducts);
    $numberOfRows = mysqli_num_rows($result);
    echo $numberOfRows;
}

function addToCart()
{
    global $conn;
    if (isset($_GET["product_id"]) && is_numeric($_GET["product_id"]) && $_GET["product_id"] > 0) {

        $product_id = $_GET["product_id"];
        $userIp_address = getIPAddress();
        $selectProducts = "SELECT * FROM cart_details WHERE product_id = '$product_id' and user_ip_address = '$userIp_address'";
        $result = mysqli_query($conn, $selectProducts);
        $numberOfRows = mysqli_num_rows($result);
        if ($numberOfRows > 0) {
            echo "<script>alert('already exist in table')</script>";
            echo "<script>window.open('index.php')</script>";
        } else {
            $insertProductQuery = "INSERT INTO cart_details (product_id, user_ip_address, quantities) VALUES ('$product_id', '$userIp_address', 1)";
            $result = mysqli_query($conn, $insertProductQuery);
            echo "<script>alert('added product to cartList')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}


function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;

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
                                    <p class='card-text'>$$product_price</p>
                                  <a href='index.php?product_id=$product_id' class='btn btn-primary'>Add to Card</a>
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
                                    <p class='card-text'>$$product_price</p>
                                  <a href='index.php?product_id=$product_id' class='btn btn-primary'>Add to Card</a>
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
                                <div class='card  product_cart'>
                                    <img src='./adm_panel/products_image/$product_image1' class='card-img-top product__img' alt='$product_title'>
                                    <div class='card-body'>
                                   <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>$$product_price</p>
                                  <a href='index.php?product_id=$product_id' class='btn btn-primary'>Add to Card</a>
                                  <a href='product_details.php?product_id=$product_id' class='btn btn-outline-primary'>View more</a>
                            </div>
                        </div>
                    </div>
                            ";
        }
    }
}
