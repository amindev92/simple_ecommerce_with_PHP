
<?php

$user_name = $_SESSION["user_name"];
if(isset($_POST["deleteaccount"])){

    $selectUserQuery = "DELETE FROM person WHERE user_name LIKE '%$user_name%'";
    $resultUserQuery = mysqli_query($conn, $selectUserQuery);
    if($resultUserQuery){

        session_destroy();
        echo "<script>alert('delete successfully')</script>";
        echo "<script>window.open('../index.php','_self')</script>";

    }else{
        echo "<script>alert('delete unsuccessfully')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }

}



?>

<form action="" method="post" >

<input type="submit" value="Delete account" name="deleteaccount" class="btn btn-primary w-100">
<input type="submit" value="Dont't Delete account" name="dontdeleteaccount" class="btn btn-primary w-100">

</form>