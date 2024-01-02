<?php 

$user_name = $_SESSION["user_name"];
$selectUserQuery = "SELECT * FROM person WHERE user_name = '$user_name'";
$resultUserQuery = mysqli_query($conn, $selectUserQuery);
$userInfo = mysqli_fetch_array($resultUserQuery);
$user_email = $userInfo["user_email"];
$user_img = $userInfo["user_img"];
$user_mobile = $userInfo["user_mobile"];

if(isset($_POST["updateUser"])){

    $new_user_name = $_POST["user_name"];
    $new_user_email = $_POST["user_email"];
    $new_user_img = $_FILES["user_img"]["name"];
    $new_tmp_user_img = $_FILES["user_img"]["tmp_name"];
    $new_user_mobile = $_POST["user_mobile"];

    if(empty($new_user_name)){
        $new_user_name = $user_name;
    }
    if(empty($new_user_email)){
        $new_user_email = $user_email;
    }
    if(!empty($new_user_img)){
        move_uploaded_file($new_tmp_user_img, "./userImages/$new_user_img");
        $user_img = $new_user_img;
    }
    if (empty($new_user_mobile)){
        $new_user_mobile = $user_mobile;
    }

    $updateUserQuery = "UPDATE person SET user_name = '$new_user_name', user_email = '$new_user_email', user_img = '$user_img', user_mobile = '$new_user_mobile'";
    $resultUpdateUserQuery = mysqli_query($conn, $updateUserQuery);
    if ($resultUpdateUserQuery) {
        echo "<script>alert('successfully update user')</script>";
    }else{
        echo "<script>alert('unsuccessfully update user')</script>";
    }

    


}
?>


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
        <label for="formFile" class="form-label">Default file input example</label>
        <input class="form-control" name="user_img" type="file" id="formFile">
    </div>
    <div class="input-group mb-3">
        <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
        <div class="input-group ">
            <span class="input-group-text" id="basic-addon1">@</span>

            <input type="number" name="user_mobile" class="form-control" placeholder="Phone number" aria-label="Username" aria-describedby="basic-addon1">
        </div>
    </div>
    <button type="submit" name="updateUser" class="btn btn-primary">Submit</button>
</form>