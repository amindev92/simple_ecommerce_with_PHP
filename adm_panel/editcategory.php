<?php 

global $conn;
$category_id = $_GET["editcategory"];
$deleteCategoryQurey = "DELETE FROM categories WHERE category_id = '$category_id'";
$result = mysqli_query($conn, $deleteCategoryQurey);
if ($result) {
    echo    "<script>alert('Successfully edit)</script>";
} else {
    echo    "<script>alert('Unsuccessfully edit)</script>";
}

?>

<form action="" method="post" class="mt-4 mx-4">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><i class="fa fa-pencil" aria-hidden="true"></i></span>
        <input type="text" class="form-control" placeholder="Insert Category name" name="categoryName">
    </div>
    <div class="d-grid gap-2">
        <button type="submit" name="editcategory" class="btn btn-primary">Submit</button>
    </div>
</form>