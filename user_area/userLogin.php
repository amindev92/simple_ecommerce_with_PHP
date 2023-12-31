<?php

if(isset($_POST["userlogin"])){

    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];
    $selectUserQuery = "SELECT * FROM person WHERE user_email LIKE '%$user_email%'";
    $selectUser = mysqli_query($conn, $selectUserQuery);
    $rowCountOfUserData  = mysqli_num_rows($selectUser);
    $fetchUserData = mysqli_fetch_array($selectUser);
    if($rowCountOfUserData > 0){
        if(password_verify($user_password, $fetchUserData["user_password"])){
            $_SESSION["user_name"] = $fetchUserData["user_name"];
            echo "<script>alert('login successfully!')</script>";
            echo "<script>window.open('payment.php', '_self')</script>";
        }else{
            echo "<script>alert('Invalid Credential!')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }else{
        echo "<script>alert('Invalid Credential!')</script>";
    }
}


?>


<form action="" method="post">
    <div class="mb-3">
        <label for="user_email" class="form-label">Email address</label>
        <input type="email" name="user_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="user_password" class="form-label">Password</label>
        <input type="password" name="user_password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" name="userlogin" class="btn btn-primary">Submit</button>
</form>