<?php

include_once("../config/database.php");

if (isset($_POST["updateProduct"])) {

    $product_title = $_POST["productTitle"];
    $product_description = $_POST["productDescription"];
    $product_keywords = $_POST["productKeywords"];
    $category_id = $_POST["productCategory"];
    $brands_id = $_POST["productBrand"];
    $product_image1 = $_FILES["product_image1"]["name"];
    $product_image2 = $_FILES["product_image2"]["name"];
    $product_image3 = $_FILES["product_image3"]["name"];
    $product_price = $_POST["productPrice"];

    $product_image1_temp = $_FILES["product_image1"]["tmp_name"];
    $product_image2_temp = $_FILES["product_image2"]["tmp_name"];
    $product_image3_temp = $_FILES["product_image3"]["tmp_name"];


    if ($product_title == "" || $product_description == "" || $product_keywords == "" || $product_image1 == "" or $product_image2 == "" or $product_image3 == "") {
        echo    "<script>alert('Please Fill input')</script>";
    } else {

        move_uploaded_file($product_image1_temp, "./products_image/$product_image1");
        move_uploaded_file($product_image2_temp, "./products_image/$product_image2");
        move_uploaded_file($product_image3_temp, "./products_image/$product_image3");

        $sqlCommand = "UPDATE `products` SET `product_title` = '$product_title', `product_description` = '$product_description', `product_keywords` = '$product_keywords', 'category_id' = '$category_id', 'brands_id' = '$brands_id', 'product_image1' = '$product_image1' , 'product_image2' = '$product_image2', 'product_image3' = '$product_image3', 'product_price' = '$product_price' WHERE `products`.`product_id` = 1;
        ";

        $result = mysqli_query($conn, $sqlCommand);
        if ($result > 0) {
            echo    "<script>alert('Successfully to insert data on table')</script>";
        } else {
            die(mysqli_error($conn));
        }
    }
}

?>


<div class="container w-75">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="productTitle" class="form-label">product Title</label>
            <input type="text" class="form-control" id="productTitle" name="productTitle" autocomplete="off" required="required">
        </div>
        <div class="mb-3">
            <label for="productDescription" class="form-label">Description:</label>
            <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required="required"></textarea>
        </div>
        <div class="mb-3">
            <label for="productKeywords" class="form-label">Keywords:</label>
            <input type="text" class="form-control" id="productKeywords" name="productKeywords" autocomplete="off" required="required">
        </div>
        <div class="mb-3">
            <select class="form-select mt-3" name="productCategory">
                <option selected>Select Category</option>
                <?php
                $sqlCategoryCommand = "SELECT * FROM categories";
                $result = mysqli_query($conn, $sqlCategoryCommand);
                while ($item = mysqli_fetch_assoc($result)) {
                    $categoryTitle = $item["category_title"];
                    $categoryId = $item["category_id"];
                    echo "
                        <option value='$categoryId'>$categoryTitle</option>
                        ";
                }
                ?>
        </div>
        </select>
        <div class="mb-3">
            <select class="form-select mt-3" name="productBrand">
                <option selected>Select brand</option>
                <?php
                $sqlBrandCommand = "SELECT * FROM brands";
                $result = mysqli_query($conn, $sqlBrandCommand);
                while ($item = mysqli_fetch_assoc($result)) {
                    $brandTitle = $item["brand_title"];
                    $brandId = $item["brand_id"];
                    echo "
                        <option value='$brandId'>$brandTitle</option>
                        ";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="product_image1" class="form-label">Image 1:</label>
            <input class="form-control" type="file" id="product_image1" name="product_image1" required="required" multiple>
        </div>
        <div class="mb-3">
            <label for="product_image2" class="form-label">Image 2:</label>
            <input class="form-control" type="file" id="product_image2" name="product_image2" required="required" multiple>
        </div>
        <div class="mb-3">
            <label for="product_image3" class="form-label">Image 3:</label>
            <input class="form-control" type="file" id="product_image3" name="product_image3" required="required" multiple>
        </div>
        <div class="mb-3">
            <label for="productPrice" class="form-label">Price</label>
            <input type="text" class="form-control" id="productPrice" name="productPrice" autocomplete="off" required="required">
        </div>
        <div class="d-grid gap-2">
            <input type="submit" name="updateProduct" class="btn btn-primary mb-3" value="Add to products">
        </div>
    </form>
</div>